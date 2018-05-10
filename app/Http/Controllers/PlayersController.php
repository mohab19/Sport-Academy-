<?php

namespace App\Http\Controllers;

use App\Http\Utils\Utils;
use App\models\CoachesTypes;
use App\models\Day;
use App\models\Extra;
use App\models\Level;
use App\models\Coach;
use App\models\Paying;
use App\models\Player;
use App\models\Roles;
use App\models\Schedule;
use App\models\Subscription;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\PlayerRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Gate;

class PlayersController extends Controller
{
    protected $role;
    protected $role_id;
    protected $utils;
    public $app_url;
    public $photo_directory;
    public $Levels;
    public $Places;
    public $sponsors;
//    public $schedules;
    public $Extras;
    public $Coaches;
    public $Subscriptions;

    /**
     * Create a new controller instance.
     *
     */

    public function __construct()
    {
        $this->utils = new Utils();
        $this->role = Roles::class;
        $this->app_url = url()->to('/');
        $this->Places = new PlacesController();
        $this->sponsors = new SponsorsController();
//        $this->schedules = new SchedulesController();
        $this->photo_directory = 'images/Users';

    }

    public $players_fields = [
        'Photo',
        'Name',
        'School',
        'Birthdate',
        'Phone',
        'Address',
        'SocialMedia',

    ];

    public function GetPlayersFields()
    {
        return $this->players_fields;
    }

    public function GetPlayers()
    {
            return Player::get();
    }

    public function GetNonActivePlayers()
    {
            return Player::where('active',0)->orderBy("id","DESC")->get();
    }

    public function GetDeptsPlayers()
    {
        $coaches = Player::select(
            'users.*',
            'players.*')
            ->leftJoin('users', 'players.user_id', '=', 'users.id')
//            ->where('players.paid','<','players.total')
            ->get();
        return $coaches;
    }
    public function GetPrice(Request $request)
    {
        $data['total'] = 0;
        $data['requried'] = 0;
        $extra_price = 0;
        $level = Level::find($request->level_id)->first();
        if($request->extra_id>0)
        {
            $extra = Extra::find($request->extra_id)->first();
            $extra_price = $extra->price;
        }
        $total = $level->price + $extra_price;
        $total = $total - $request->discount;
        return $data;
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

    public function add(PlayerRequest $request)
    {
        if ($request->extra_id == "0")
            $request->extra_id = NULL;

        $data = $request->except('_token');
        $data['role_id'] = 4;
        $data['birthdate'] = $data['birthdate'] . " 00:00:00";
        $user = User::create($data);
        if ($user) {
            $id = $user->id;
            $user->picture = $this->AddUserImage( $request , $id , "main");
            $user->save();
            $player = Player::create([
                'user_id' => $user->id,
                'school' => $request->school,
            ]);
            if ($player)
            {
                if(!$request->username)
                    $data["username"]="player".$user->id;
                if(!$request->password)
                    $data["password"] = bcrypt("player".$user->id);
                else
                    $data["password"] = bcrypt($request->password);
                if(!$request->email)
                    $data["email"] ="player".$user->id."@example.com";
                if($user->update($data))
                    return 1;
                else
                    return 0;
            }

            else {
                return 0;
            }
        } else
            return 0;
    }
    public function signup(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'school' => 'required',
            'birthdate' => 'required',
            'home' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users|regex:/^[a-z]+[0-9]*$/u',
        ]);
        $data = $request->except('_token');
        $data['password'] = bcrypt($request->password);
        $data['role_id'] = 4;
        $user = User::create($data);
        if ($user) {
            $id = $user->id;
            $user->picture = $this->AddUserImage( $request , $id , "main");
            $user->save();
            $data['user_id'] = $user->id;
            $player = Player::create($data);
            if ($player)
            {
                return 1;
            }

            else {
                return 0;
            }
        } else
            return 0;
    }

    public function update(Request $request)
    {
        $player = Player::find($request->id);
        $this->validate($request, [
            'full_name' => 'required',
            'school' => 'required',
            'birthdate' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email, '.$player->user_id,
            'username' => 'required|regex:/^[a-z]+[0-9]*$/u|unique:users,username, '.$player->user->id,
        'address' => 'required',
        ]);
        $data = $request->except('_token');
        if($request->picture)
            $data['picture'] = $this->AddUserImage($request,$request->id, "main");
        if($player->update($data) && $player->user->update($data))
            return 1;
        else
            return 0;
    }

    function RemoveFolder($dir)
    {
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) continue;
            if (is_dir("$dir/$file"))
                rmdir_recursive("$dir/$file");
            else unlink("$dir/$file");
        }
        rmdir($dir);
    }

    public function delete(Request $request)
    {
        $player = Player::find($request->id);
        $user = User::find($player->user_id);
        if ($player && $user) {
            $upload_to = app_path() . '/../public/' . $this->photo_directory . "/" . $player->user_id;
            if (is_dir($upload_to))
                $this->RemoveFolder($upload_to);
            $user->email = $user->id+1;
            $user->save();
            $player->delete();
            $user->delete();
            if($player->subscription)
                $player->subscription->delete();
            return 1;
        } else
            return 0;
    }

    public function Profile($id,$name)
    {
        $player = Player::find($id);
        if ($player) {
            return view('pages.player',
                [
                    'player' => $player,
                    'places' => $this->Places->GetPlaces(),
                    'schedules' => Schedule::all(),
                    'days' => Day::all(),
                    'sponsors'=>$this->sponsors->GetSponsors()

                ]);
        } else
            return view('errors.404');
    }
}
