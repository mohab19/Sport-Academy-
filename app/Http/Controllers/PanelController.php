<?php

namespace App\Http\Controllers;

use App\models\Attendance;
use App\models\CaptainsTypes;
use App\models\Group;
use App\models\Notification;
use App\models\PostType;
use App\models\Report;
use App\models\Roles;
use App\models\ScheduleSubscriptions;
use App\models\ScheduleTimesSubscriptions;
use App\models\Subscription;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class PanelController extends Controller
{

    public $user;
    public $role;
    public $levels;
    public $playgrounds;
    public $places;
    public $extra;
    public $products;
    public $coaches;
    public $employees;
    public $coaches_types;
    public $players;
    public $admins;
    public$schedules;
    public$teams_schedules;
    public $subscriptions;
    public $subscriptions_schedules;
    public $posts;
    public $groups;
    public $days;
    public $sponsors;
    public $news;
    public $outcomes;
    public $incomes;
    public function __construct()
    {
        $this->user = Auth::user();
        $this->role = Roles::class;
        $this->levels = new LevelsController();
        $this->playgrounds = new PlaygroundController();
        $this->places = new PlacesController();
        $this->extra = new ExtraController();
        $this->products = new ProductsController();
        $this->coaches = new CoachesController();
        $this->employees = new EmployeesController();
        $this->players = new PlayersController();
        $this->admins = new AdminsController();
        $this->subscriptions = new SubscriptionsController();
        $this->schedules = new SchedulesController();
        $this->teams_schedules = new TeamSchedulesController();
        $this->posts = new PostsController();
        $this->groups = new GroupController;
        $this->sponsors = new SponsorsController();
        $this->news = new NewsController();
        $this->outcomes = new OutComesController();
        $this->incomes = new InComesController();

    }

    public function adminpanel()
    {
        return view('pages.adminpanel',
            ['user' => $this->user,
                'role' => $this->role ,
                'coaches'=> $this->coaches->GetCoaches(),
                'players'=> $this->players->GetPlayers(),
                'depts_players'=> $this->players->GetDeptsPlayers(),
                'levels' => $this->levels->GetLevels(),
                'places' => $this->places->GetPlaces(),
                'sponsors' => $this->sponsors->GetSponsors(),
                'page' => 'home'
            ]);
    }
    public function playerpanel()
    {
        return view('pages.playerpanel',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'schedules' => $this->schedules->GetSchedules() ,
                                'sponsors' => $this->sponsors->GetSponsors(),


            ]);
    }

    public function admins()
    {
        return view('pages.admins',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'Admins'=> $this->admins->GetAdmins(),
                'AdminsFields'=> $this->admins->GetAdminsFields(),
                'reports'=>Report::all(),
                                'sponsors' => $this->sponsors->GetSponsors(),
                'page' => 'admins'
            ]);
    }
    public function players()
    {

        return view('pages.players',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'Players'=> $this->players->GetPlayers(),
                'PlayersFields'=> $this->players->GetPlayersFields(),
                                'sponsors' => $this->sponsors->GetSponsors(),
                'page' => 'players'
            ]);
    }
    public function coaches()
    {

        return view('pages.coaches',
            [
                'user' => $this->user,
                'role' => $this->role,
                'CoachesFields' => $this->coaches->GetCoachesFields(),
                'Coaches'=>$this->coaches->GetCoaches(),
                'CoachesTypesFields'=>$this->coaches->GetCoachesTypesFields(),
                'types'=>$this->coaches->GetCoachesTypes(),
                'places' => $this->places->GetPlaces(),
                                'sponsors' => $this->sponsors->GetSponsors(),
                'levels' => $this->levels->GetLevels(),
                'page' => 'coaches'
            ]);
    }
    public function coachpanel()
    {
        return view('pages.coachpanel',
            [
                'user' => $this->user,
                'sponsors' => $this->sponsors->GetSponsors(),
                'role' => $this->role,
                'days' => $this->schedules->GetDays(),
            ]);
    }
    public function employeepanel()
    {
        return view('pages.employeepanel',
            [
                'user' => $this->user,
                'sponsors' => $this->sponsors->GetSponsors(),
                'role' => $this->role,
                'page' => 'home'

            ]);
    }
    public function employees()
    {

        return view('pages.employees',
            [
                'user' => $this->user,
                'role' => $this->role,
                'employeesFields' => $this->employees->GetEmployeesFields(),
                'employees'=>$this->employees->GetEmployees(),
                'Places' => $this->places->GetPlaces(),
                                'sponsors' => $this->sponsors->GetSponsors(),
                'reports'=>Report::all(),
                'page' => 'employees'
            ]);
    }
    public function schedules()
    {

        return view('pages.schedules',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'places' => $this->places->GetPlaces(),
                'schedules' => $this->schedules->GetSchedules(),
                'days' => $this->schedules->GetDays(),
                'coaches'=> $this->coaches->GetCoaches(),
                'sponsors' => $this->sponsors->GetSponsors(),
                'page' => 'schedules'
            ]);
    }
    public function teams_schedules()
    {

        return view('pages.teams_schedules',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'places' => $this->places->GetPlaces(),
                'schedules' => $this->teams_schedules->GetSchedules(),
                'days' => $this->teams_schedules->GetDays(),
                'coaches'=> $this->coaches->GetCoaches(),
                'sponsors' => $this->sponsors->GetSponsors(),
                'page' => 'teams_schedules'
            ]);
    }
    public function subscriptions()
    {

        return view('pages.subscriptions',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'Levels' => $this->levels->GetLevels(),
                'Places' => $this->places->GetPlaces(),
                'Extras' => $this->extra->GetExtra(),
                'Coaches'=> $this->coaches->GetCoaches(),
                'Players'=> $this->players->GetPlayers(),
                'Subscriptions'=> $this->subscriptions->GetSubscriptions(),
                'SubscriptionsFields'=> $this->subscriptions->GetSubscriptionsFields(),
                                'sponsors' => $this->sponsors->GetSponsors(),
                'page' => 'subscriptions'
            ]);
    }
    public function attendances()
    {

        return view('pages.attendances',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'attendances' => Attendance::get(),
                'sponsors' => $this->sponsors->GetSponsors(),
                'page' => 'attendances'
            ]);
    }
    public function structure()
    {

        return view('pages.structure',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'levelsFields' => $this->levels->GetLevelsFields(),
                'levels' => $this->levels->GetLevels(),
                'playgroundsFields' => $this->playgrounds->GetPlaygroundsFields(),
                'playgrounds' => $this->playgrounds->GetPlaygrounds(),
                'placesFields' => $this->places->GetPlacesFields(),
                'places' => $this->places->GetPlaces(),
                'ExtraFields' => $this->extra->GetExtraFields(),
                'extras' => $this->extra->GetExtra(),
                                'sponsors' => $this->sponsors->GetSponsors(),
                'page' => 'structure'
            ]);
    }
    public function products()
    {

        return view('pages.products',
            [
                'user' => $this->user,
                'role' => $this->role,
                'products' => $this->products->GetProducts(),
                'places' => $this->places->GetPlaces(),
                'users'=> $this->products->GetUsers(),
                'sponsors' => $this->sponsors->GetSponsors(),
                'page' => 'products'
            ]);
    }
    public function settings()
    {

        return view('pages.settings',
            [
                'user' => $this->user,
                'role' => $this->role ,
                                'sponsors' => $this->sponsors->GetSponsors(),
                'page' => 'settings'
            ]);
    }
    public function reports()
    {
        return view('pages.reports',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'page' => 'reports',
                'reports'=>Report::all(),
                'places' => $this->places->GetPlaces(),
                                'sponsors' => $this->sponsors->GetSponsors(),
            ]);
    }
    public function invoices()
    {
        return view('pages.invoices',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'page' => 'invoices',
                'sponsors' => $this->sponsors->GetSponsors(),
            ]);
    }
    public function posts()
    {
        return view('pages.posts',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'page' => 'posts',
//                'posts' => $this->posts->GetPosts(),
                'groups' => Group::get(),
                'posts_types' => PostType::get(),
                'notifications' => Notification::orderBy("id","DESC")->get(),
                 'sponsors' => $this->sponsors->GetSponsors(),

            ]);
    }
    public function groups()
    {
        return view('pages.groups',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'page' => 'groups',
                'groups' => $this->groups->GetGroups(),
                 'sponsors' => $this->sponsors->GetSponsors(),

            ]);
    }
    public function sponsors()
    {
        return view('pages.sponsors',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'page' => 'sponsors',
                'sponsors' => $this->sponsors->GetSponsors(),

            ]);
    }
    public function news()
    {
        return view('pages.news',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'page' => 'news',
                'news' => $this->news->GetNews(),
                'sponsors' => $this->sponsors->GetSponsors(),

            ]);
    }
    public function outcomes()
    {
        return view('pages.outcomes',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'page' => 'outcomes',
                'places' => $this->places->GetPlaces(),
                'outcomes' => $this->outcomes->GetExtraOutcomes(),
                'sponsors' => $this->sponsors->GetSponsors(),

            ]);
    }
    public function incomes()
    {
        return view('pages.incomes',
            [
                'user' => $this->user,
                'role' => $this->role ,
                'page' => 'incomes',
                'places' => $this->places->GetPlaces(),
                'incomes' => $this->incomes->GetExtraIncomes(),
                'sponsors' => $this->sponsors->GetSponsors(),

            ]);
    }

}
