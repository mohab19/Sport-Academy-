<?php

namespace App\Http\Controllers;
use App\models\InCome;
use App\models\Invoice;
use App\models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class InComesController extends Controller
{
    public function GetExtraInComes()
    {
        $incomes = InCome::where('incomes_type_id',3)->get();
        return $incomes;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'place_id' => 'required',
            'title' => 'required',
            'value' => 'required|numeric'
        ]);
        $data = $request->except('_token');
        $data['incomes_type_id'] = 3;
        $data['receiver_id'] = Auth::user()->id;
        $income = InCome::create($data);
        if($income)
        {
            $max = Invoice::max('id');
            return view('invoices.incomes.extra',[
                "invoice_id"=>$max+1,
                "invoice_issue"=>"Extra InCome",
                'income'=>$income,
                "type" => "income",
                "id" => $income->id,
                "discount" => 0,
                "total" => 0,
                "remaining_debt" => 0,
                "paid" => $income->value,
                "client" =>$income->client_name,
                "places"=>Place::get(),
                "read_only"=>0,
            ]);
        }
        else
            return 0;
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'value' => 'required|numeric'
        ]);
        $income = InCome::find($request->id);
        $data = $request->except('_token');
        if($income->update($data))
            return 1;
        else
            return 0;

    }
    public function delete(Request $request)
    {
        $income = InCome::find($request->id);
        if($income->forcedelete())
            return 1;
        else
            return 0;
    }
    public function invoice($id)
    {
        $income = InCome::find($id);
        $max = InCome::max('invoice_num');
        $income->invoice_num = $max+1;
        $income->save();
    }
}
