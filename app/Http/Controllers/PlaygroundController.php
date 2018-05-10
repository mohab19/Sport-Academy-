<?php

namespace App\Http\Controllers;

use App\models\Playground;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class PlaygroundController extends Controller
{
    public $playground_fields = [
        'Name',
        'Place',
        'Notes',
    ];

    public function GetPlaygroundsFields()
    {
        return $this->playground_fields;
    }
    public function GetPlaygrounds()
    {
        $playground = Playground::get();
        return $playground;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $data = $request->except('_token');
        $playground = Playground::create($data);
        if($playground)
            return 1;
        else
            return 0;
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $playground = Playground::find($request->id);
        $data = $request->except('_token');
        if($playground->update($data))
            return 1;
        else
            return 0;

    }
    public function delete(Request $request)
    {
        $playground = Playground::find($request->id);
        if($playground->forcedelete())
            return 1;
        else
            return 0;
    }
}
