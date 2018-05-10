<?php

namespace App\Http\Controllers;
use App\models\Debt;
use App\models\InCome;
use App\models\Invoice;
use App\models\OutCome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class InvoiceController extends Controller
{
    public function search(Request $request)
    {
        $this->validate($request, [
            'invoice_id' => 'required|numeric|min:1'
        ]);
        $outcome = OutCome::where('invoice_id',$request->invoice_id)->first();
        $income = InCome::where('invoice_id',$request->invoice_id)->first();
        if($outcome)
        {
            return view('invoices.outcomes.extra',[
                "invoice_id"=>$request->invoice_id,
                "invoice_issue"=>"Extra OutCome",
                'outcome'=>$outcome,
                "type" => "outcome",
                "id" => $outcome->id,
                "discount" => 0,
                "total" => 0,
                "remaining_debt" => 0,
                "paid" => $outcome->value,
                "client" =>0,
                "read_only"=>1
            ]);
        }
        else if($income)
        {
            $view = "";
            $invoice_issue = "";
            $total = 0;
            $debt = 0;
            $discount = 0;
            $client = 0;
            switch ($income->incomes_type_id)
            {
                case 1:
                    $view = "invoices.subscriptions.new";
                    $invoice_issue = "New Subscription";
                    $total = $income->subscription->total;
                    $debt = $income->subscription->debt;
                    $client = 1;
                    $discount = $income->subscription->discount;
                    break;
                case 2:
                    $view = "invoices.subscriptions.debt";
                    $invoice_issue = "Pay Subscription's Debt";
                    break;
                case 3:
                    $view = "invoices.products.sell";
                    $invoice_issue = "Buy Product";
                    break;
                case 4:
                    $view = "invoices.incomes.extra";
                    $invoice_issue = "Extra InCome";
                    break;
                case 5:
                    $view = "invoices.subscriptions.renew";
                    $invoice_issue = "Renew Subscription";
                    break;
            }
            return view($view,[
                "invoice_id"=>$request->invoice_id,
                "invoice_issue"=>$invoice_issue,
                'income'=>$income,
                "type" => "income",
                "id" => $income->id,
                "discount" =>$discount==0? $income->discount : $discount,
                "total" => $total==0? $income->total : $total,
                "remaining_debt" =>$debt==0? $income->debt : $debt,
                "paid" => $income->value,
                "client" =>$income->player->user->name,
                "read_only"=>1
            ]);
        }
        else
            return 2;
    }
    public function add($type,$id)
    {
            $invoice = new Invoice();
        $invoice->table = $type;
        $invoice->save();
        switch ($type)
        {
            case "incomes":
                $income = InCome::find($id);
                $income->invoice_id = $invoice->id;
                $income->save();
                break;
            case "outcomes":
                $outcome = OutCome::find($id);
                $outcome->invoice_id = $invoice->id;
                $outcome->save();
                break;
            case "debts":
                $debt = Debt::find($id);
                $debt->invoice_id = $invoice->id;
                $debt->save();
                break;
        }
    }
}
