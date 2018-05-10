<?php

namespace App\Http\Controllers;

use App\models\Employees;
use App\models\Level;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class LevelsController extends Controller
{

    public $levels_fields = [
        'Name',
        'Price',
        'Package',
        'Maximum Number',
    ];

    public function GetLevelsFields()
    {
        return $this->levels_fields;
    }
    public function GetLevels()
    {
        $levels = Level::get();
        return $levels;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|',
            'price' => 'required|numeric',
            'max' => 'required|numeric',
        ]);
        $data = $request->except('_token');
        $level = Level::create($data);
        if($level)
            return 1;
        else
            return 0;
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|',
            'price' => 'required|numeric',
            'max' => 'required|numeric',
        ]);
        $level = Level::find($request->id);
        $data = $request->except('_token');
        if($level->update($data))
            return 1;
        else
            return 0;

    }
    public function delete(Request $request)
    {
        $level = Level::find($request->id);
        if($level->forcedelete())
            return 1;
        else
            return 0;
    }
}
