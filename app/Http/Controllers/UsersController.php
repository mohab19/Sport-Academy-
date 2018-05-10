<?php

namespace App\Http\Controllers;

use App\Http\Utils\Utils;
use App\models\Attachment;
use App\models\CoachesTypes;
use App\models\CoachesPlaces;
use App\models\InCome;
use App\models\Level;
use App\models\Coach;
use App\models\OutCome;
use App\models\Place;
use App\models\Roles;
use App\models\Subscription;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public $app_url;
    public $photo_directory;
    public function __construct()
    {
        $this->app_url = url()->to('/');
        $this->photo_directory = 'Users';
    }
    public function AddPenalty(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required',
            'value' => 'required|numeric',
        ]);
        $data = $request->except('_token');
        $data['outcomes_type_id'] = 4;
        $data['user_id'] = $id;
        if(OutCome::create($data))
            return 1;
        else
            return 0;
    }
    public function UpdatePenalty(Request $request,$id)
    {
        $outcome = OutCome::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
            'value' => 'required|numeric',
        ]);
        $data = $request->except('_token');
        if($outcome->update($data))
            return 1;
        else
            return 0;
    }
    public function DeletePenalty($id)
    {
        $outcome = OutCome::findOrFail($id);
        $outcome->forcedelete();
        return 1;
    }
    public function AddExtra(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required',
            'value' => 'required|numeric',
        ]);
        $data = $request->except('_token');
        $data['outcomes_type_id'] = 5;
        $data['user_id'] = $id;
        if(OutCome::create($data))
            return 1;
        else
            return 0;
    }
    public function UpdateExtra(Request $request,$id)
    {
        $outcome = OutCome::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
            'value' => 'required|numeric',
        ]);
        $data = $request->except('_token');
        if($outcome->update($data))
            return 1;
        else
            return 0;
    }
    public function DeleteExtra($id)
    {
        $outcome = OutCome::findOrFail($id);
        $outcome->forcedelete();
        return 1;
    }
    public function AddUserImage(Request $request , $user_id,$file)
    {
        $success = 0;
        $file_name = '';
        if($request->picture) {
            if(is_array($request->picture))
            {
                $pictures = array();
                $counter = 0;
                foreach ($request->file('picture') as $item) {
                    $counter++;
                    $logo = $item;
                    $upload_to = app_path() . '/../public/images/'.$this->photo_directory."/".$user_id;
                    $extension = $logo->getClientOriginalExtension();
                    $file_name = $file."-".$counter. ".$extension";
                    $success = $logo->move($upload_to, $file_name);
                    if($success)
                        $pictures[] = $this->app_url."/images/".$this->photo_directory."/".$user_id."/".$file_name;
                    else
                        return 0;
                }
                $pictures_str  = implode("||", $pictures);
                return $pictures_str;
            }
            else
            {
                $logo = $request->file('picture');
                $upload_to = app_path() . '/../public/images/'.$this->photo_directory."/".$user_id;
                $extension = $logo->getClientOriginalExtension();
                $file_name = $file . ".$extension";
                $success = $logo->move($upload_to, $file_name);
                if ($success)
                    return $this->app_url."/images/".$this->photo_directory."/".$user_id."/".$file_name;
                else
                    return 0;
            }
        }
    }
    public function AddAttachment(Request $request,$user_id)
    {
        $this->validate($request,[
            'title' => 'required',
            'picture'=>'required'
        ]);
        $data = $request->except('_token');
        $attachment = new Attachment();
        $attachment->save();
        $data['user_id'] = $user_id;
        $data['value'] = $this->AddUserImage($request,$user_id,$request->title."-".$attachment->id);
        if($attachment->update($data))
            return 1;
    }
}
