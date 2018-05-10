<?php

namespace App\Http\Controllers;

use App\models\Sponsor;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class SponsorsController extends Controller
{
    public $app_url;
    public $photo_directory;
    public function __construct()
    {
        $this->app_url = url()->to('/');
        $this->photo_directory = 'Sponsors';
    }
    public function GetSponsors()
    {
        $sponsors = Sponsor::get();
        return $sponsors;
    }
    public function AddImage(Request $request,$id)
    {
            $logo = $request->file('picture');
            $upload_to = app_path() . '/../public/images/'.$this->photo_directory."/".$id;
            $extension = $logo->getClientOriginalExtension();
            $file_name = "main" . ".$extension";
            $success = $logo->move($upload_to, $file_name);
            if ($success)
                return $this->app_url."/images/".$this->photo_directory."/".$id."/".$file_name;
            else
                return 0;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'picture' => 'required'
        ]);
        $data = $request->except('_token');
        $sponsor = Sponsor::create($data);
        $sponsor->picture = $this->AddImage($request,$sponsor->id);
        if($sponsor->save())
            return 1;
        else
            return 0;
    }
    public function delete($id)
    {
        $sponsor = Sponsor::find($id);
        if($sponsor->forcedelete())
            return 1;
        else
            return 0;
    }
}
