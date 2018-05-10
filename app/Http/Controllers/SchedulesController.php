<?php

namespace App\Http\Controllers;

use App\models\Coach;
use App\models\CoachesPlaces;
use App\models\Day;
use App\models\InCome;
use App\models\Level;
use App\models\OutCome;
use App\models\Place;
use App\models\Playground;
use App\models\Schedule;
use App\models\ScheduleSubscriptions;
use App\models\ScheduleTimes;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PlaceRequest;
use Illuminate\Support\Facades\Auth;

class SchedulesController extends Controller
{
    private $places;
    private $coaches;
    public $sponsors;
    public function __construct()
    {
        $this->places = new PlacesController();
        $this->coaches = new CoachesController();
        $this->sponsors = new SponsorsController();
    }
    public function GetSchedules()
    {
        return Schedule::all();
    }
    public function GetDays()
    {
        return Day::all();
    }
    public function GetSchedulesSubscriptions()
    {
        return ScheduleSubscriptions::all();
    }
    public function GetCoaches($id)
    {
        $place = Place::findOrFail($id);
//        foreach ($place->coaches_places as $coaches_place)
//        {
//            echo "<option value='{$coaches_place->coach->id}'>{$coaches_place->coach->name}</option>";
//        }
        $coahes = Coach::get();
                foreach ($coahes as $coach)
        {
            echo "<option value='{$coach->id}'>{$coach->name}</option>";
        }
    }
    public function GetPlaygrounds($id)
    {
        $place = Place::findOrFail($id);
        foreach ($place->playgrounds as $playground)
        {
            echo "<option value='{$playground->id}'>{$playground->title}</option>";
        }
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
        ]);
        $data = $request->except('_token');
        if($data["playground_id"] == "")
            $data["playground_id"] = null;
        $schedule = Schedule::create($data);
        if($schedule)
        {
                return 1;
        }
        else
            return 0;
    }
    public function update(Request $request,$id)
    {
        $schedule = Schedule::findOrFail($id);
        $data = $request->except('_token');
        if($data["playground_id"] == "")
            $data["playground_id"] = null;
        if ($schedule->update($data))
        {
            return 1;
        }
        else
            return 0;

    }
    public function delete($id)
    {
        $schedule = Schedule::find($id);
        if ($schedule->delete())
            return 1;
        else
            return 0;
    }
    public function FullTimeTable($id)
    {
        $place = Place::find($id);
        if ($place) {
            return view('pages.schedules.fulltimetable',
                [
                    'place' => $place,
                    'days' => Day::get(),
                    'sponsors' => $this->sponsors->GetSponsors()
                ]);
        } else
            return view('errors.404');
    }
    public function CoachTimeTable($id)
    {

        $coach_place = CoachesPlaces::find($id);
        if ($coach_place) {
            return view('pages.schedules.coachtimetable',
                [
                    'coach_place' => $coach_place,
                    'days' => Day::get(),
                    'sponsors' => $this->sponsors->GetSponsors()
                ]);
        } else
            return view('errors.404');
    }
    public function ScheduleDetailed($name)
    {
        $place = Place::where("name",str_replace('-', ' ', $name))->first();
        if ($place) {
            return view('pages.schedules.profile',
                [
                    'place' => $place,
                    'days' => Day::get(),
                    'sponsors' => $this->sponsors->GetSponsors()
                ]);
        } else
            return view('errors.404');
    }
    public function profile($id)
    {
        $schedule = Schedule::find($id);
        if ($schedule) {
            return view('pages.schedule',
                [
                    'schedule' => $schedule,
                    'places' => $this->places->GetPlaces(),
                    'coaches' => $this->coaches->GetCoaches(),
                    'playgrounds' => Playground::get(),
                    'sponsors' => $this->sponsors->GetSponsors()
                ]);
        } else
            return view('errors.404');
    }
}
