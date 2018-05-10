<?php

namespace App\Http\Controllers;
use App\models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EventsController extends Controller
{
    public function GetExtraEvents()
    {
        $events = Event::get();
        return $events;
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'player_id' => 'required',
            'body' => 'required'
        ]);
        $data = $request->except('_token');
        $event = Event::create($data);
        if($event)
            return 1;
        else
            return 0;
    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $event = Event::find($id);
        $data = $request->except('_token');
        if($event->update($data))
            return 1;
        else
            return 0;

    }
    public function delete($id)
    {
        $event = Event::find($id);
        if($event->forcedelete())
            return 1;
        else
            return 0;
    }
}
