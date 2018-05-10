<?php

namespace App\Http\Controllers;


use App\models\Roles;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RouteController extends Controller
{

    public $user;
    public $role;
    public $home;
        public $sponsors;
        public $news;
        public $levels;
        public $places;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->role = Roles::class;
        $this->home = new HomeController();
        $this->sponsors = new SponsorsController();
        $this->news = new NewsController();
        $this->levels = new LevelsController();
        $this->places = new PlacesController();
    }

    public function index()
    {
        $user = Auth::user();
        if(isset($user))
            return view('pages.index',[
                'user' => $user,
                'sponsors' => $this->sponsors->GetSponsors(),
                'news' => $this->news->GetNews(),
                'levels' => $this->levels->GetLevels(),
                'places' => $this->places->GetPlaces(),
            ]);
        else
            return view('pages.index',[
                'user' => $user,
                'sponsors' => $this->sponsors->GetSponsors(),
                'news' => $this->news->GetNews(),
                'levels' => $this->levels->GetLevels(),
                'places' => $this->places->GetPlaces(),
            ]);
    }
    public function invoice()
    {
            return view('invoices.master',[
                "invoice_num"=>1366,
                "invoice_issue" => "Buy Product"
            ]);
    }

    public function Dashboard()
    {
        if(Gate::allows('Admin',$this->role)) {
            return redirect('/adminpanel');
        }
        else if(Gate::allows('Coach',$this->role)) {
            return redirect('/coachpanel');
        }
        else if (Gate::allows('Player',$this->role)) {
            return redirect('/playerpanel');
        }
        else if (Gate::allows('Employee',$this->role)) {
            return redirect('/employeepanel');
        }
        else {
            return redirect('/');
        }
    }
}
