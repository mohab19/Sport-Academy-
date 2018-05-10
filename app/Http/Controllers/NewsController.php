<?php

namespace App\Http\Controllers;

use App\models\Employees;
use App\models\News;
use App\models\Sponsor;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsController extends Controller
{
    public $app_url;
    public $photo_directory;
    public function __construct()
    {
        $this->app_url = url()->to('/');
        $this->photo_directory = 'News';
    }
    public function GetNews()
    {
        $news = News::orderBy('id','desc')->get();
        return $news;
    }

    public function AddImages(Request $request , $news_id,$file)
    {
        $pictures = array();
        $counter = 0;
        if($request->pictures[0]!="")
        {
            foreach ($request->file('pictures') as $item) {
                $counter++;
                $logo = $item;
                $upload_to = app_path() . '/../public/images/' . $this->photo_directory . "/" . $news_id;
                $extension = $logo->getClientOriginalExtension();
                $file_name = $file . "-" . $counter . ".$extension";
                $success = $logo->move($upload_to, $file_name);
                if ($success)
                    $pictures[] = $this->app_url . "/images/" . $this->photo_directory . "/" . $news_id . "/" . $file_name;
                else
                    return 0;
            }
            $pictures_str = implode("||", $pictures);
            return $pictures_str;
        }
        else
            return 0;

    }
    public function AddImage(Request $request , $news_id,$file)
    {

                $logo = $request->file('cover');
                $upload_to = app_path() . '/../public/images/' . $this->photo_directory . "/" . $news_id;
                $extension = $logo->getClientOriginalExtension();
                $file_name = "main" . ".$extension";
                $success = $logo->move($upload_to, $file_name);
                if ($success)
                    return $this->app_url . "/images/" . $this->photo_directory . "/" . $news_id . "/" . $file_name;
                else
                    return 0;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover' => 'required',
        ]);
//        return "a7a".$request->pictures[0]."awi";
        $data = $request->except('_token');
        $news = new News();
        $news->save();
        $data['cover'] = $this->AddImage($request,$news->id,"main");
        if($request->pictures)
        {
            $data['pictures'] = $this->AddImages($request,$news->id,$news->id);
        }
        if($news->update($data))
            return 1;
        else
            return 0;
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'picture' => 'required',
        ]);
        $news = News::find($request->id);
        $data = $request->except('_token');
        if($news->update($data))
            return 1;
        else
            return 0;

    }
    public function delete(Request $request)
    {
        $news = News::find($request->id);
        if($news->forcedelete())
            return 1;
        else
            return 0;
    }
    public function profile($id,$title)
    {
        $news = News::find($id);
        if ($news) {
            return view('pages.newspage',
                [
                    'news' => $news,
                    'sponsors' => Sponsor::get(),
                ]);
        } else
            return view('errors.404');
    }
}
