<?php

namespace App\Http\Controllers;

use App\Http\Utils\Utils;
use App\models\CoachesLevels;
use App\models\CoachesTypes;
use App\models\CoachesPlaces;
use App\models\Level;
use App\models\Coach;
use App\models\OutCome;
use App\models\Place;
use App\models\Player;
use App\models\Roles;
use App\models\Subscription;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CoachesController extends Controller
{
    protected $role;
    protected $role_id;
    protected $utils;
    public $Places;
    public $sponsors;
    public $Levels;
    public $Players;
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->utils = new Utils();
        $this->role = Roles::class;
        $this->Places = new PlacesController();
        $this->Levels = new LevelsController();
        $this->Players = new PlayersController();
        $this->sponsors = new SponsorsController();
    }

    public $coaches_fields = [
        'Photo',
        'Name',
        'Birthdate',
        'Phone',
        'Address',
        'email',
        'Type',
        'Places',
        'Levels',
        'Salary',
        'SocialMedia',

    ];
    public $coaches_types_fields = [
        'name'
    ];

    public function GetCoachesFields()
    {
        return $this->coaches_fields;
    }
    public function GetCoachesTypesFields()
    {
        return $this->coaches_types_fields;
    }
    public function GetCoaches()
    {
        $coaches =Coach::select(
            'users.*',
            'coaches.*')
            ->leftJoin('users','coaches.user_id','=','users.id')
            ->get();
        return $coaches;
    }
    public function GetCoachesTypes()
    {
        $types = CoachesTypes::get();
        return $types;
    }
    public function addType(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|',
        ]);
        $data = $request->except('_token');
        $type = CoachesTypes::create($data);
        if($type)
            return 1;
        else
            return 0;
    }
    public function deleteType(Request $request)
    {
        $type = CoachesTypes::find($request->id);
        if($type->forcedelete())
            return 1;
        else
            return 0;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'birthdate' => 'required',
            'phone' => 'required',
            'type_id' => 'required',
            'address' => 'required',
            'salary' => 'required|numeric',
            'places_id' => 'required',
            'email' => 'email|unique:users',
            'username' => 'unique:users|regex:/^[a-z]+[0-9]*$/u',
        ]);
        $data = $request->except('_token');
        $data['role_id']  = 2;
        $data['birthdate'] = $data['birthdate']." 00:00:00";
        $user = User::create($data);
        if($user)
        {
            $data['user_id'] = $user->id;
            $user->picture = $this->Players->AddUserImage( $request , $data['user_id'] , "main");
            $user->save();
            $coach = Coach::create($data);
            if($coach)
            {
                foreach ($request->places_id as $place)
                {
                    $data['place_id'] = $place;
                    $data['coach_id'] = $coach->id;
                    CoachesPlaces::create($data);
                }
                if($request->levels_id>0)
                {
                    foreach ($request->levels_id as $level)
                    {
                        $data['level_id'] = $level;
                        $data['coach_id'] = $coach->id;
                        CoachesLevels::create($data);
                    }
                }

                $data['value'] = $request->salary;
                $data['user_id'] = $coach->user_id;
                $data['outcomes_type_id'] = 3;
                if( OutCome::create($data))
                {
                    if(!$request->username)
                        $data["username"]="coach".$user->id;
                    if(!$request->password)
                        $data["password"] = bcrypt("coach".$user->id);
                    else
                        $data["password"] = bcrypt($request->password);
                    if(!$request->email)
                        $data["email"] ="coach".$user->id."@example.com";
                    if($user->update($data))
                        return 1;
                    else
                        return 0;
                }

            }
            else
            {
                $user->forceDelete();
                return 0;
            }
        }
        else
            return 0;
    }
    public function update(Request $request)
    {
        $coach = Coach::findOrFail($request->id);
        $this->validate($request, [
            'full_name' => 'required',
            'birthdate' => 'required',
            'phone' => 'required',
            'type_id' => 'required',
            'address' => 'required',
            'salary' => 'required|numeric',
            'places_id' => 'required',
            'levels_id' => 'required',
            'email' => 'required|email|unique:users,email, '.$coach->user_id,
            'username' => 'required|regex:/^[a-z]+[0-9]*$/u|unique:users,username, '.$coach->user->id
        ]);
        $data = $request->except('_token');
        foreach ($coach->coach_places as $place) // will change later
        {
            $place->forcedelete();
        }
        foreach ($request->places_id as $place)
        {
            $data['place_id'] = $place;
            $data['coach_id'] = $coach->id;
            CoachesPlaces::create($data);
        }

            foreach ($coach->coach_levels as $level) // will change later
            {
                $level->forcedelete();
            }
        if($request->levels_id>0)
        {
            foreach ($request->levels_id as $level)
            {
                $data['level_id'] = $level;
                $data['coach_id'] = $coach->id;
                CoachesLevels::create($data);
            }
        }

        $data['picture'] = $this->Players->AddUserImage($request,$coach->user_id,"main");
        if($coach->user->update($data)&&$coach->update($data))
        {
            return 1;
        }
        else
            return 0;

    }
    public function delete(Request $request)
    {
        $coach = Coach::find($request->id);
        $user = User::find($coach->user_id);
        if($coach && $user)
        {
            $user->email = $user->id+1;
            $user->save();
            if(sizeof($coach->coach_places)>0)
            {
                foreach ($coach->coach_places as $coach_place)
                {
                    $coach_place->delete();
                }
            }
            if(sizeof($coach->schedules)>0)
            {
                foreach ($coach->schedules as $schedule)
                {
                    $schedule->delete();
                }
            }
            $coach->delete();
            $user->delete();
            return 1;
        }
        else
            return 0;
    }
    public function Profile($id,$name)
    {
        $coach = Coach::find($id);
        if ($coach) {
            $players = Player::get();
            return view('pages.coach',
                [
                    'coach' => $coach,
                    'types'=>$this->GetCoachesTypes(),
                    'places' =>$this->Places->GetPlaces(),
                    'levels' =>$this->Levels->GetLevels(),
                    'players' =>$players,
                    'sponsors'=>$this->sponsors->GetSponsors()
                ]);
        } else
            return view('errors.404');
    }
}
