<?php

namespace App\Http\Controllers;

use App\models\Employees;
use App\models\InCome;
use App\models\Level;
use App\models\OutCome;
use App\models\Place;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PlaceRequest;
use Illuminate\Support\Facades\Auth;

class PlacesController extends Controller
{

    public $places_fields = [
        'Name',
        'Price',
        'Address',
        'Map',
    ];
    public function GetPlacesFields()
    {
        return $this->places_fields;
    }
    public function GetPlaces()
    {
        $places = Place::get();
        return $places;
    }
    public function add(PlaceRequest $request)
    {
        $data = $request->except('_token');
        $place = Place::create($data);
        if($place)
        {
            $data['outcomes_type_id'] = 1;
            $data['place_id'] = $place->id;
            $data['value'] = $place->price;
            $data['user_id'] = Auth::user()->id;
            $data['title'] = "Rent For ".$place->name." Place";
            $outcome = OutCome::create($data);
            if($outcome)
            return 1;
        }
        else
            return 0;
    }
    public function update(PlaceRequest $request)
    {
        $place = Place::find($request->id);
        $data = $request->except('_token');
        if($place->update($data))
            return 1;
        else
            return 0;

    }
    public function delete(Request $request)
    {
        $place = Place::find($request->id);
        if(sizeof($place->coaches_places))
        {
            foreach ($place->coaches_places as $coaches_place)
            {
                $coaches_place->delete();
            }
        }
        if(sizeof($place->employees_places))
        {
            foreach ($place->employees_places as $employees_place)
            {
                $employees_place->delete();
            }
        }
        if(sizeof($place->subscriptions))
        {
            foreach ($place->subscriptions as $subscription)
            {
                $subscription->delete();
            }
        }
        if(sizeof($place->playgrounds))
        {
            foreach ($place->playgrounds as $playground)
            {
                $playground->delete();
            }
        }
        if(sizeof($place->schedules))
        {
            foreach ($place->schedules as $schedule)
            {
                $schedule->delete();
            }
        }
        if($place->delete())
            return 1;
        else
            return 0;
    }
}
