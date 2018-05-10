<?php

namespace App\Http\Controllers;

use App\Http\Utils\Utils;
use App\models\CoachesTypes;
use App\models\Extra;
use App\models\Levels;
use App\models\Coaches;
use App\models\Payings;
use App\models\Players;
use App\models\Prices;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\PlayerRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class SettingsController extends Controller
{
    protected $role;
    protected $role_id;
    protected $utils;
    public $app_url;
    public $photo_directory;

    /**
     * Create a new controller instance.
     *
     */

    public function __construct()
    {
        $this->utils = new Utils();
        $this->app_url = url()->to('/');
        $this->photo_directory = 'images/Users';
    }

    public function AddUserImage(Request $request,$id, $file)
    {
        $success = 0;
        $file_name = '';
        if ($request->picture) {

            $logo = $request->file('picture');
            $upload_to = app_path() . '/../public/' . $this->photo_directory . "/" . $id;
            $extension = $logo->getClientOriginalExtension();
            $file_name = $file . ".$extension";
            $success = $logo->move($upload_to, $file_name);
        }
        if ($success)
            return $this->app_url . "/" . $this->photo_directory . "/" . $id . "/" . $file_name;
        else
            return $success;
    }

    public function UpdateInfo(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $this->validate($request, [
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email, '.$user->id,
            'username' => 'required|regex:/^[a-z]+[0-9]*$/u|unique:users,username, '.$user->id
        ]);
            $data = $request->except('_token');
        if(Auth::user()->role->name=="Player")
        {
            $this->validate($request, [
                'school' => 'required',
            ]);
            $user->player->update($data);
        }
        if($user->update($data))
            return 1;
        else
            return 0;
    }
    public function UpdatePicture(Request $request)
    {
        $this->validate($request, [
            'picture' => 'required',
        ]);
        $user = User::find(Auth::user()->id);
            $data = $request->except('_token');
            $data['picture'] = $this->AddUserImage($request,$request->id, "main");
        if($user->update($data))
            return 1;
        else
            return 0;
    }
    public function UpdatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $user = User::find(Auth::user()->id);
        if(!password_verify($request->old_password,$user->password))
        {
            return 2;
        }
        else
        $data = $request->except('_token');
        $data['password'] = bcrypt($request->password);
        if($user->update($data))
            return 1;
        else
            return 0;
    }


}
