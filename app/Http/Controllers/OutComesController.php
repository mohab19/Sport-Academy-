<?php

namespace App\Http\Controllers;
use App\models\Invoice;
use App\models\OutCome;
use App\models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OutComesController extends Controller
{
    public function GetExtraOutComes()
    {
        $outcomes = OutCome::where('outcomes_type_id',6)->get();
        return $outcomes;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'place_id' => 'required',
            'title' => 'required',
            'value' => 'required|numeric'
        ]);
        $data = $request->except('_token');
        $data['outcomes_type_id'] = 6;
        $data['user_id'] = Auth::user()->id;
        $outcome = OutCome::create($data);
        if($outcome)
        {
            $max = Invoice::max('id');
            return view('invoices.outcomes.extra',[
                "invoice_id"=>$max+1,
                "invoice_issue"=>"Extra OutCome",
                'outcome'=>$outcome,
                "type" => "outcomes",
                "id" => $outcome->id,
                "discount" => 0,
                "total" => 0,
                "remaining_debt" => 0,
                "paid" => $request->value,
                "client" =>0,
                "places"=>Place::get(),
                "read_only"=>0
            ]);
        }
        else
            return 0;
    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required',
            'value' => 'required|numeric'
        ]);
        $outcome = OutCome::find($id);
        $data = $request->except('_token');
        if($outcome->update($data))
            return 1;
        else
            return 0;

    }
    public function delete($id)
    {
        $outcome = OutCome::find($id);
        if($outcome->forcedelete())
            return 1;
        else
            return 0;
    }
}
