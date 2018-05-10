<?php

namespace App\Http\Controllers;

use App\models\Group;
use App\models\GroupUsers;
use App\models\Level;
use App\models\Place;
use App\models\Sponsor;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function GetGroups()
    {
        $groups = Group::get();
        return $groups;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $data = $request->except('_token');
        $data["owner_id"] = Auth::user()->id;
        $group = Group::create($data);
        if($group)
            return 1;
        else
            return 0;
    }
    public function addUser(Request $request)
    {
        $data = $request->except('_token');
        $data["group_id"] = $request->group_id;
        $flag = 0;
        if ($request->places_id) {
            foreach ($request->places_id as $place_id){
                $place = Place::find($place_id);
            foreach ($place->subscriptions as $subscription) {
                $data["user_id"] = $subscription->player->user_id;
                if(GroupUsers::where("user_id",$data["user_id"])->where("group_id",$data["group_id"])->first())
                    continue;
                if (GroupUsers::create($data))
                    $flag = 1;
                else
                    $flag = 0;
            }
        }
    }
        else if ($request->levels_id) {
            foreach ($request->levels_id as $level_id){
                $level = Level::find($level_id);
                foreach ($level->subscriptions as $subscription) {
                    $data["user_id"] = $subscription->player->user_id;
                if(GroupUsers::where("user_id",$data["user_id"])->where("group_id",$data["group_id"])->first())
                        continue;
                    if (GroupUsers::create($data))
                        $flag = 1;
                    else
                        $flag = 0;
                }
            }
        }
        else if ($request->users_id)
        {
            foreach ($request->users_id as $user_id){
                $data["user_id"] = $user_id;
                if(GroupUsers::where("user_id",$data["user_id"])->where("group_id",$data["group_id"])->first())
                    continue;
                if (GroupUsers::create($data))
                    $flag = 1;
                else
                    $flag = 0;
            }
        }
       return $flag;
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|',
        ]);
        $group = Group::find($request->id);
        $data = $request->except('_token');
        if($group->update($data))
            return 1;
        else
            return 0;

    }
    public function deleteUser($id)
    {
        $group_user = GroupUsers::find($id);
        if($group_user->forcedelete())
            return 1;
        else
            return 0;
    }
    public function delete(Request $request)
    {
        $group = Group::find($request->id);
        foreach ($group->group_users as $group_user)
        {
            $group_user->forcedelete();
        }
        if($group->forcedelete())
            return 1;
        else
            return 0;
    }
    public function profile($id,$title)
    {
        $group = Group::find($id);
        if ($group) {
            return view('pages.group',
                [
                    'group' => $group,
                    'places' => Place::get(),
                    'levels' => Level::get(),
                    'users' => User::get(),
                    'sponsors' => Sponsor::get(),
                ]);
        } else
            return view('errors.404');
    }
}
