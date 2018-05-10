<?php

namespace App\Http\Controllers;

use App\models\Debt;
use App\models\InCome;
use App\models\Invoice;
use App\models\OutCome;
use App\models\Place;
use App\models\Product;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    protected  $sponsors;
    public function __construct()
    {
        $this->sponsors = new SponsorsController();
    }
    public function GetUsers()
    {
        return User::where('role_id','<>',1)->where('role_id','<>','3')->get();

    }
    public function GetProducts()
    {
        $products = Product::get();
        return $products;
    }
    public function GetTotal(Request $request)
    {
        return $request->price * $request->quantity();
    }
    public function AddProductImage(Request $request,$id, $file)
    {
        $app_url = url()->to('/');
        $success = 0;
        $file_name = '';
        if ($request->picture) {

            $logo = $request->file('picture');
            $upload_to = app_path() . '/../public/images/' . "Products/" . $id;
            $extension = $logo->getClientOriginalExtension();
            $file_name = $file . ".$extension";
            $success = $logo->move($upload_to, $file_name);
        }
        if ($success)
            return $app_url . "/images/Products/" . $id . "/" . $file_name;
        else
            return $success;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'paid' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);
        $data = $request->except('_token');
        $data['user_id'] =  Auth::user()->id;
        $product = Product::create($data);
        $product->picture = $this->AddProductImage($request,$product->id,"main");
        $product->save();
        if($product)
        {
            $data['outcomes_type_id'] = 2;
            $data['product_id'] = $product->id;
            $data['value'] = $request->paid;
            if(OutCome::create($data))
                return 1;
        }
        else
            return 0;
    }
    public function calculate(Request $request)
    {
        $product = Product::find($request->id);
        if($product)
        {
            if($product->quantity<$request->quantity)
                return -1;
            else
                return ($request->quantity * $product->price) - $request->discount;
        }
    }
    public function sell(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required_if:user_id,"outside"',
            'quantity' => 'required|numeric',
            'paid' => 'required|numeric',
        ]);
        $client = 0;
        if($request->paid > $this->calculate($request))
            return 2;
        else
        {
            $product = Product::find($request->id);
            if($product)
            {
                $data = $request->except('_token');
                $data['incomes_type_id'] = 2;
                $data['receiver_id'] = Auth::user()->id;
                $data['product_id'] = $product->id;
                $data['place_id'] = $product->place_id;
                $data['price_per_unit'] = $product->price;
                $data['title'] = "Buy ".$product->name;
                $data['value'] = $request->paid;
                if($request->user_id == "outside")
                {
                    $client = $request->name;
                    $data['title'] = $request->name;
                    $data['user_id'] = null;
                }
                $income = InCome::create($data);
                if($income)
                {
                    if($request->user_id != "outside")
                        $client = $income->user->name;
                    $product->quantity -= $request->quantity;
                    $product->save();
                    $max = Invoice::max('id');
                    return view('invoices.products.sell',[
                        "invoice_id"=>$max+1,
                        "invoice_issue"=>"Buy Product",
                        'income'=>$income,
                        "type" => "incomes",
                        "id" => $income->id,
                        "discount" => $request->discount,
                        "total" => $income->total,
                        "paid" => $income->value,
                        "remaining_debt" =>$income->debt , //$income->debt
                        "client" =>$client,
                        "places"=>Place::get(),
                        "read_only"=>0
                    ]);
                }
            }
            else
                return 0;
        }

    }
    public function profile($id,$name)
    {
        $product = Product::find($id);
        if ($product) {
            return view('pages.product',
                [
                    'product' => $product,
                    'sponsors'=>$this->sponsors->GetSponsors()
                ]);
        } else
            return view('errors.404');
    }
    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        if($product->delete())
            return 1;
        else
            return 0;
    }
    public function UpdateQuantity(Request $request)
    {
        $this->validate($request, [
            'paid' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);
        $product = Product::find($request->id);
        if($product)
        {
            $product->quantity += $request->quantity;
            $product->save();
            $outcome = new OutCome();
            $outcome->outcomes_type_id = 6;
            $outcome->receiver_id = Auth::user()->id;
            $outcome->product_id = $product->id;
            $outcome->value = $request->paid;
            $outcome->quantity = $request->quantity;
            $outcome->save();
            return 1;
        }
    }
    public function UpdateInformation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        $product = Product::find($request->id);
        $data = $request->except('_token','id');
        if($product->update($data))
        {
            return 1;
        }
    }
    public function UpdatePicture(Request $request)
    {
        $this->validate($request, [
            'picture' => 'required',
        ]);
        $product = Product::find($request->id);
        $data = $request->except('_token','id');
        $data['picture'] = $this->AddProductImage($request,$request->id,"main");
        if($product->update($data))
        {
            return 1;
        }
    }
    public function PayDebt(Request $request,$income_id)
    {
        $this->validate($request, [
            'paid' => 'required|numeric',
        ]);
        $income = InCome::find($income_id);
        if($income)
        {
            $remaining_debts = $income->debt;
            if($request->paid<=$income->debt)
            {
                $max = Invoice::max('id');
                $data['income_id'] = $income->id;
                $data['receiver_id'] = Auth::user()->id;
                $data['value'] = $request->paid;
                $debt = Debt::create($data);
                $total_debts = $income->debt;
                return view('invoices.products.debt',[
                    "invoice_id"=>$max+1,
                    "invoice_issue"=>"Pay Product's Debt",
                    'debt'=>$debt,
                    "type" => "debts",
                    "id" => $debt->id,
                    "discount" => 0,
                    "total" => $total_debts,
                    "paid" => $request->paid,
                    "remaining_debt" =>$total_debts - $request->paid ,
                    "client" =>$income->user->name,
                    "places"=>Place::get(),
                    "read_only"=>0
                ]);
            }
            else
                return 2;
        }
        else
            return  555;
    }
}
