<?php

namespace App\Http\Controllers;

use App\models\Attendance;
use App\models\Employees;
use App\models\Level;
use App\models\Place;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PlaceRequest;

class AttendancesController extends Controller
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
        $users = User::where('role_id',2)->get();
        return $users;
    }
    public function attend(Request $request,$id,$attend)
    {
        $attendance = Attendance::find($id);
        if($attendance)
        {
            $attendance->attend = $attend;
            if($attendance->save())
                return 1;
        }
    }

    public function add(Request $request)
    {
        $data = $request->except('_token');
        $attendances = Attendance::get();
        foreach ($attendances as $attendance)
        {
            $attendance->forcedelete();
        }
            for($i=0;$i<sizeof($request->users_id);$i++)
            {
                $data['user_id']=$request->users_id[$i];
                $data['schedule_time_id']=$request->schedules_times_id[$i];
                if(sizeof($request->attends))
                {
                    if(array_key_exists($i,$request->attends))
                    {
                        $data['attend'] = 1;
                    }
                    else
                        $data['attend'] = 0;
                }
                Attendance::create($data);
            }
            return 1;

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
