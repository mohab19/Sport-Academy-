<?php

namespace App\Http\Controllers;

use App\models\Extra;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class ExtraController extends Controller
{
    public $extra_fields = [
        'Extra Name',
        'Extra Price',
    ];

    public function GetExtraFields()
    {
        return $this->extra_fields;
    }
    public function GetExtra()
    {
        $extra = Extra::get();
        return $extra;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|',
            'price' => 'required|numeric',
        ]);
        $data = $request->except('_token');
        $extra = Extra::create($data);
        if($extra)
            return 1;
        else
            return 0;
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|',
            'price' => 'required|numeric',
        ]);
        $extra = Extra::find($request->id);
        $data = $request->except('_token');
        if($extra->update($data))
            return 1;
        else
            return 0;

    }
    public function delete(Request $request)
    {
        $extra = Extra::find($request->id);
        if($extra->forcedelete())
            return 1;
        else
            return 0;
    }
}
