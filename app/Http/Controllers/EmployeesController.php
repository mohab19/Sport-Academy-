<?php

namespace App\Http\Controllers;

use App\Http\Utils\Utils;
use App\models\Employee;
use App\models\EmployeesPlaces;
use App\models\OutCome;
use App\models\Report;
use App\models\Roles;
use App\User;
use Illuminate\Http\Request;
use App\models\AdminReports;


use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class EmployeesController extends Controller
{
    protected $role;
    protected $players;
    protected $places;
    protected $reports;
    protected $sponsors;
    protected $role_id;
    protected $utils;
    public $app_url;
    public $photo_directory;
    public $EmployeeID;

    /**
     * Create a new controller instance.
     *
     */

    public function __construct()
    {
        $this->utils = new Utils();
        $this->role = Roles::class;
        $this->players = new PlayersController();
        $this->places = new PlacesController();
        $this->reports = new ReportsController();
        $this->sponsors = new SponsorsController();
        $this->app_url = url()->to('/');
        $this->photo_directory = 'images/Users';
    }

    public $employees_fields = [
        'Photo',
        'Name',
        'Place',
        'Birthdate',
        'Phone',
        'Address',
        'Salary',
    ];

    public function GetEmployeesFields()
    {
        return $this->employees_fields;
    }
    public function GetEmployees()
    {
        $employees = Employee::get();
        return $employees;
    }
public function GetEmployeeID()
{
    return $this->EmployeeID;
}
public function SetEmployeeID($id)
{
     $this->EmployeeID = $id;
}
    public function add(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'places_id' => 'required',
            'role_id' => 'required',
            'salary' => 'required|numeric',
            'birthdate' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'email|unique:users',
            'username' => 'unique:users|regex:/^[a-z]+[0-9]*$/u',
            ]);
        $data = $request->except('_token');
        $user = User::create($data);
        if($user)
        {
            $data['user_id'] = $user->id;
            if($request->reports_id>0)
            {
                foreach ($request->reports_id as $report_id)
                {
                    $data['report_id'] = $report_id;
                    AdminReports::create($data);
                }
            }
            $user->picture = $this->players->AddUserImage( $request , $data['user_id'] , "main");
            $user->save();
            $employee = Employee::create($data);
            if($employee)
            {
                foreach ($request->places_id as $place)
                {
                    $data['place_id'] = $place;
                    $data['employee_id'] = $employee->id;
                    EmployeesPlaces::create($data);
                }
                $data['value'] = $request->salary;
                $data['outcomes_type_id'] = 3;
                if( OutCome::create($data))
                {
                    if(!$request->username)
                        $data["username"]="employee".$user->id;
                    if(!$request->password)
                        $data["password"] = bcrypt("employee".$user->id);
                    else
                        $data["password"] = bcrypt($request->password);
                    if(!$request->email)
                        $data["email"] ="employee".$user->id."@example.com";
                    if($user->update($data))
                        return 1;
                    else
                        return 0;
                }
            }
        }
        else
            return 0;
    }
    public function profile($id)
    {
        $this->SetEmployeeID($id);
        $employee = Employee::find($this->GetEmployeeID());
        if ($employee) {
            return view('pages.employee',
                [
                    'employee' => $employee,
                    'places' => $this->places->GetPlaces(),
                    'reports' => Report::get(),
                    'sponsors'=>$this->sponsors->GetSponsors()
                ]);
        } else
            return view('errors.404');
    }
    public function update(Request $request,$id)
    {
        $emplyoee = Employee::findOrFail ($id);
        $this->validate($request, [
            'full_name' => 'required',
            'places_id' => 'required',
            'salary' => 'required|numeric',
            'birthdate' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email, '.$emplyoee->user_id,
            'username' => 'required|regex:/^[a-z]+[0-9]*$/u|unique:users,username, '.$emplyoee->user->id
        ]);
        $data = $request->except('_token');
        $data["user_id"]=$emplyoee->user_id;
        if($request->picture)
            $data['picture'] = $this->players->AddUserImage($request,$emplyoee->user_id,"main");
        else
            $data['picture'] = $emplyoee->user->picture;
        foreach ($emplyoee->employee_places as $place) // will change later
        {
            $place->forcedelete();
        }
        foreach ($request->places_id as $place)
        {
            $data['place_id'] = $place;
            $data['employee_id'] = $emplyoee->id;
            EmployeesPlaces::create($data);
        }
        foreach ($emplyoee->user->reports as $report) // will change later
        {
            $report->forcedelete();
        }
        if($request->reports_id>0)
        {
            foreach ($request->reports_id as $report_id)
            {
                $data['report_id'] = $report_id;
                AdminReports::create($data);
            }
        }

        if($emplyoee->update($data)&&$emplyoee->user->update($data))
        {
                return 1;
        }

        else
            return 0;

    }
    public function delete(Request $request)
    {
        $employee = Employee::find($request->id);
        if ($employee) {
            $upload_to = app_path() . '/../public/' . $this->photo_directory . "/" . $employee->user_id;
            if (is_dir($upload_to))
                $this->players->RemoveFolder($upload_to);
            $employee->user->email = $employee->user->id+1;
            $employee->user->save();
            if($employee->delete()&& $employee->user->delete())
            return 1;
            else
                return 0;
        }
        else
            return 0;
    }
}
