<?php

namespace App\Http\Controllers;

use App\models\AdminReports;
use App\models\Employee;
use App\models\Level;
use App\models\Place;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PlaceRequest;

class AdminsController extends Controller
{
    public $admins_fields = [
        'Picture',
        'Name',
        'Birthdate',
        'Address',
        'Phone',
        'Email',
        'SocialMedia',
    ];
    public function GetAdminsFields()
    {
        return $this->admins_fields;
    }
    public function GetAdmins()
    {
        $users = User::where('role_id',1)->get();
        return $users;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'birthdate' => 'required',
            'email' => 'email|unique:users',
            'username' => 'unique:users|regex:/^[a-z]+[0-9]*$/u',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $data = $request->except('_token');
        $data['password'] = bcrypt($request->phone);
        $data['role_id'] = 1;
        $user = User::create($data);
        if($user)
        {
            $data['user_id'] = $user->id;
            if($request->reports_id)
            foreach ($request->reports_id as $report_id)
            {
                $data['report_id'] = $report_id;
                AdminReports::create($data);
            }
            if(!$request->username)
                $data["username"]="admin".$user->id;
            if(!$request->password)
                $data["password"] = bcrypt("admin".$user->id);
            else
                $data["password"] = bcrypt($request->password);
            if(!$request->email)
                $data["email"] ="admin".$user->id."@example.com";
            if($user->update($data))
                return 1;
            else
                return 0;
            return 1;
        }
        else
            return 0;
    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->email = $user->id+1;
        $user->save();
        if($user->delete())
            return 1;
        else
            return 0;
    }
}
