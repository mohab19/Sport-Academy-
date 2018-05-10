<?php

namespace App\Http\Controllers;

use App\Http\Utils\Utils;
use App\models\CoachesTypes;
use App\models\Day;
use App\models\Extra;
use App\models\InCome;
use App\models\Invoice;
use App\models\Level;
use App\models\Coach;
use App\models\Paying;
use App\models\Place;
use App\models\Player;
use App\models\Prices;
use App\models\Schedule;
use App\models\ScheduleSubscriptions;
use App\models\ScheduleTimes;
use App\models\Subscription;
use App\models\SubscriptionsExtras;
use App\models\TeamSchedule;
use App\models\TeamScheduleSubscriptions;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\PlayerRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class SubscriptionsController extends Controller
{
    protected $role;
    protected $role_id;
    protected $utils;
    public $app_url;
    public $photo_directory;
    public $Levels;
    public $Places;
    public $Extras;
    public $Coaches;
    public $Players;
    public $sponsors;

    /**
     * Create a new controller instance.
     *
     */

    public function __construct()
    {
        $this->utils = new Utils();
        $this->app_url = url()->to('/');
        $this->photo_directory = 'images/Users';
        $this->Levels = new LevelsController();
        $this->Places = new PlacesController();
        $this->Extras = new ExtraController();
        $this->Coaches = new CoachesController();
        $this->Players = new PlayersController();
        $this->sponsors = new SponsorsController();
    }

    public $subscriptions_fields = [
        'id',
        'Player',
        'Coach',
        'Place',
        'Level',
        'Extra',
        'From',
        'To',
        'Total',
        'Discount',
        'Paid',
        'Debt',
    ];

    public function GetPlayerInfo(Request $request)
    {
        $player = Player::find($request->player_id);
//        if($player->level_id != null && $player->place_id != null)
//        {
            echo"<input type='hidden' name='place_id' value='$player->place_id'><input type='hidden' name='level_id' value='$player->level_id'>'";
//        }
    }
    public function GetSchedules(Request $request)
    {
        $place = Place::find($request->place_id);
        $level = Level::find($request->level_id);
        $days=Day::get();
        echo"  <table class='table'>
                <thead>
                <tr class='info'>
                    <th>Day</th>
                    <th>Schedules</th>
                </tr>
                </thead>
                <tbody>";
        foreach ($days as $day)
        {
            $schedules = Schedule::where('place_id',$place->id)->where('day_id',$day->id)->get();
               if(sizeof($schedules))
               {
                   echo"<tr><td>{$day->name}</td><td>";
                            foreach($day->schedules as $schedule) {
                                $flag = 0;
                                foreach ($schedule->coach->coach_levels as $coach_level)
                                {
                                    if($level->id == $coach_level->level->id)
                                        $flag = 1;
                                }
                                if ($place->id == $schedule->place_id && sizeof($schedule->subscriptions)<$level->max && $flag) {
                                        echo "<label><input type='checkbox' name='schedules_id[]' value='$schedule->id'><div class='schedule'>
                                    <h4>{$schedule->from} -- {$schedule->to}</h4>
                                    <h5 class='purple'>{$schedule->coach->user->name}</h5>";
                                        if ($schedule->playground)
                                            echo "<h4 class='purple'>{$schedule->playground->title}</h4>";
                                        echo "</div></label>";
                                }
                            }
                        echo"</td></tr>";
               }
        }
        echo"</tbody></table>";
        echo "<script>
$('.schedules label input').click(function(){
    if($(this).is(':checked'))
                        $(this).parent().siblings().children('input').prop('checked' , false);
//       $(this).parent().siblings().hide();
       else
       $(this).parent().siblings().show();
    })
</script>";
    }
    public function GetTeamsSchedules(Request $request)
    {
        $place = Place::find($request->place_id);
        $days=Day::get();
        echo"  <table class='table'>
                <thead>
                <tr class='info'>
                    <th>Day</th>
                    <th>Schedules</th>
                </tr>
                </thead>
                <tbody>";
        foreach ($days as $day)
        {
            $schedules = TeamSchedule::where('place_id',$place->id)->where('day_id',$day->id)->get();
               if(sizeof($schedules))
               {
                   echo"<tr><td>{$day->name}</td><td>";
                            foreach($day->teams_schedules as $schedule) {
                                if ($place->id == $schedule->place_id) {
                                    echo "<label><input type='radio' name='teams_schedules_id[]' value='$schedule->id'><div class='schedule'>
                                    <h4>{$schedule->from} -- {$schedule->to}</h4>
                                    <h5 class='purple'>{$schedule->coach->user->name}</h5>
                                    <h5 class='purple'>{$schedule->playground->title}</h5>
                                </div></label>";
                                }
                            }
                        echo"</td></tr>";
               }
        }
        echo"</tbody></table>";
        echo "<script>
$('.schedules label input').click(function(){
    if($(this).is(':checked'))
                        $(this).parent().siblings().children('input').prop('checked' , false);
//       $(this).parent().siblings().hide();
       else
       $(this).parent().siblings().show();
    })
</script>";
//
//            echo "<div class='schedulecontainer fl-left text-center'><h4 class='text-left'>Saturday</h4>";
//        foreach ($day0 as $item)
//        {
//            echo "
//                        <label>
//                        <input type='checkbox' name='schedules_times_id[]' value='$item->id'>
//                        <div class='schedule text-left'>";
//            echo "
//                            <div class='time purple'>Time : <span class='rose'>$item->from </span> -- <span class='rose'> $item->to</span></div>
//                                ";
//            echo "
//                                <div class='purple coach'>Coach : <span class='rose'>{2}</span></div>
//                                <div class='purple coach'>No. : <span class='rose'>5</span></div>
//                             </div>
//                    </label>
//                    ";
//        }
//        echo"</div>";
//            echo "                    <script>
//        $('.schedules .schedule').change(function(){
//            if( $(this).siblings('input').checked)
//            {
//var filter = $(this).children('.coach').children('span').text();
//            $('.schedules .schedule .coach span').each(function(){
//                if ($(this).text().search(new RegExp(filter, 'i')) < 0) {
//                    $(this).parent().parent().hide(400);
//                } else {
//                    $(this).parent().parent().show(400);
//                }
//            });
//            }
//            else
//                {
//                    $('.schedules .schedule').each(function(){
//                    $(this).show(400);
//                })
//                }
//
//        });
//
//            </script>";
    }

    public function GetSubscriptionsFields()
    {
        return $this->subscriptions_fields;
    }

    public function GetSubscriptions()
    {
        $subscriptions = Subscription::get();
        return $subscriptions;
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
        $data['required'] = 0;
        $extra_price = 0;
        $level = Level::find($request->level_id);
        if ($request->extras_id > 0) {
            foreach ($request->extras_id as $extra) {
                $extra = Extra::find($extra);
                if ($extra)
                    $extra_price += $extra->price;
            }
        }
        $data['total'] = $level->price + $extra_price;
        $data['required'] = $data['total'] - $request->discount;
        return $data;

    }

    public function GetAdd()
    {
        return view('pages.newsubscription',
            [
                'levels' => $this->Levels->GetLevels(),
                'places' => $this->Places->GetPlaces(),
                'extras' => $this->Extras->GetExtra(),
                'coaches' => $this->Coaches->GetCoaches(),
                'players' => $this->Players->GetNonActivePlayers(),
                'sponsors' => $this->sponsors->GetSponsors(),
            ]);
    }

    public function PostAdd(Request $request)
    {
        $this->validate($request, [
            'paid' => 'required|numeric',
        ]);
        $data = $request->except('_token');
        $price = $this->GetPrice($request);
        $data['total'] = $price['total'];
        $data['receiver_id'] = Auth::user()->id;
        $subscription = Subscription::create($data);
        if ($subscription) {
            if ($request->extras_id) {
                foreach ($request->extras_id as $extra) {
                    $data['extra_id'] = $extra;
                    $data['subscription_id'] = $subscription->id;
                    SubscriptionsExtras::create($data);
                }
            }

            foreach ($request->schedules_id as $schedule_id) {
                $data['schedule_id'] = $schedule_id;
                $data['subscription_id'] = $subscription->id;
                ScheduleSubscriptions::create($data);
            }
            if($request->teams_schedules_id>0)
            {
                foreach ($request->teams_schedules_id as $schedule_id) {
                    $data['team_schedule_id'] = $schedule_id;
                    $data['subscription_id'] = $subscription->id;
                    TeamScheduleSubscriptions::create($data);
                }
            }

            $data['incomes_type_id'] = 1;
            $data['subscription_id'] = $subscription->id;
            $data['title'] = "Add Subscription No." . $subscription->id;
            $data['value'] = $subscription->paid;
            $income = InCome::create($data);
            if ($income) {
                $player = Player::find($subscription->player_id);
                $player->active = 1;
                $player->save();
                $max = Invoice::max('id');
                return view('invoices.subscriptions.new',[
                    "invoice_id"=>$max+1,
                    "invoice_issue"=>"New Subscription",
                    'income'=>$income,
                    "type" => "incomes",
                    "id" => $income->id,
                    "discount" => $request->discount,
                    "total" => $income->subscription->total,
                    "paid" => $income->value,
                    "remaining_debt" =>$income->subscription->debt , //$income->debt
                    "client" =>$player->user->name,
                    "places"=>Place::get(),
                    "read_only"=>0
                ]);
            }
        }
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

    public function delete(Request $request,$id)
    {
        $this->validate($request, [
            'type' => 'required',
        ]);
        $subscription = Subscription::findOrFail($id);
        $subscription->player->active = 0;
        $subscription->player->save();
        switch ($request->type)
        {
            case "soft":
                foreach ($subscription->schedules as $subscription_schedule)
                {
                    $subscription_schedule->delete();
                }
                $subscription->delete();
                break;
            case "force":
                foreach ($subscription->schedules as $subscription_schedule)
                {
                    $subscription_schedule->forcedelete();
                }
                foreach ($subscription->subscription_extras as$subscription_extra)
                {
                    $subscription_extra->forcedelete();
                }
                foreach ($subscription->incomes as $income)
                {
                    $income->forcedelete();
                }
                $subscription->forcedelete();
                break;
        }
        return 1;
    }

    public function Profile()
    {
        $id = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '-') + 1);
        $player = Player::select(
            'users.*',
            'players.*')
            ->where('players.id',$id)
            ->leftJoin('users', 'players.user_id', '=', 'users.id')
            ->first();
        if ($player) {
            return view('pages.player',
                [
                    'player' => $player,
                    'Levels' =>$this->Levels->GetLevels(),
                    'Places' =>$this->Places->GetPlaces(),
                    'Extras' =>$this->Extras->GetExtra(),
                    'Coaches' =>$this->Coaches->GetCoaches()
                ]);
        } else
            return view('errors.404');
    }
public function Update(Request $request,$id)
{
    $this->validate($request, [
        'schedules_id' => 'required',
    ]);
    $subscription = Subscription::findOrFail($id);
    foreach ($subscription->schedules as $subscription_schedule)
    {
        $subscription_schedule->forcedelete();
    }
    foreach ($subscription->teams_schedules as $subscription_schedule)
    {
        $subscription_schedule->forcedelete();
    }
    foreach ($request->schedules_id as $schedule_id) {
        $data['schedule_id'] = $schedule_id;
        $data['subscription_id'] = $subscription->id;
        ScheduleSubscriptions::create($data);
    }
    if($request->teams_schedules_id)
    foreach ($request->teams_schedules_id as $schedule_id) {
        $data['team_schedule_id'] = $schedule_id;
        $data['subscription_id'] = $subscription->id;
        TeamScheduleSubscriptions::create($data);
    }
    return 1;
}
    public function pay(Request $request,$id)
    {
        $this->validate($request, [
            'paid' => 'required|numeric',
        ]);
        $subscription = Subscription::withTrashed()->find($id);
        if($subscription)
        {
            if($request->paid<=$subscription->debt)
            {
                $debt = $subscription->debt;
                $subscription->paid += $request->paid;
                $subscription->save();
                $data['receiver_id'] = Auth::user()->id;
                    $data['incomes_type_id'] = 5;
                    $data['title'] = "Pay Debt For Subscription No. ".$subscription->id;
                $data['subscription_id'] = $subscription->id;
                $data['player_id'] = $subscription->player_id;
                $data['place_id'] = $subscription->place_id;
                $data['value'] = $request->paid;
                $income = InCome::create($data);
                $max = Invoice::max('id');
                return view('invoices.subscriptions.debt',[
                    "invoice_id"=>$max+1,
                    "invoice_issue"=>"Pay Subscription's Debt",
                    'income'=>$income,
                    "type" => "income",
                    "id" => $income->id,
                    "discount" => 0,
                    "total" => $debt,
                    "paid" => $request->paid,
                    "remaining_debt" =>$income->subscription->debt , //$income->debt
                    "client" =>$income->subscription->player->user->name,
                    "places"=>Place::get(),
                    "read_only"=>0
                ]);
            }
            else
                return 2;
        }
    }
    public function renew(Request $request)
    {
        $this->validate($request, [
            'paid' => 'required|numeric',
        ]);
        $subscription = Subscription::find($request->id);
        if ($subscription) {
            if ($request->paid <= $subscription->total) {

                $new_subscription = $subscription->replicate();
                $new_subscription->paid = $request->paid;
                $new_subscription->created_at = date("Y-m-d H:i:s", strtotime($subscription->end));
                $new_subscription->save();
                if ($subscription->subscription_extras) {
                    foreach ($subscription->subscription_extras as $subscription_extra) {
                        $new_subscription_extra = $subscription_extra->replicate();
                        $new_subscription_extra->subscription_id = $new_subscription->id;
                        $new_subscription_extra->save();
                        $subscription_extra->delete();
                    }
                }
                if ($subscription->schedules) {
                    foreach ($subscription->schedules as $schedule) {
                        $new_schedule = $schedule->replicate();
                        $new_schedule->subscription_id = $new_subscription->id;
                        $new_schedule->save();
                        $schedule->delete();
                    }
                }
                if ($subscription->teams_schedules) {
                    foreach ($subscription->teams_schedules as $schedule) {
                        $new_schedule = $schedule->replicate();
                        $new_schedule->subscription_id = $new_subscription->id;
                        $new_schedule->save();
                        $schedule->delete();
                    }
                }
                $data['receiver_id'] = Auth::user()->id;
                $data['incomes_type_id'] = 4;
                $data['title'] = "Renew Subscription No. " . $subscription->id;
                $data['subscription_id'] = $new_subscription->id;
                $data['player_id'] = $new_subscription->player_id;
                $data['place_id'] = $new_subscription->place_id;
                $data['value'] = $request->paid;
                $income = InCome::create($data);
                $max = Invoice::max('id');
                $subscription->delete();
                return view('invoices.subscriptions.renew', [
                    "invoice_id" => $max + 1,
                    "invoice_issue" => "Renew Subscription",
                    'income' => $income,
                    "type" => "incomes",
                    "id" => $income->id,
                    "discount" => $request->discount,
                    "total" => $income->subscription->total,
                    "paid" => $income->value,
                    "remaining_debt" => $income->subscription->debt, //$income->debt
                    "client" => $new_subscription->player->user->name,
                    "places" => Place::get(),
                    "read_only" => 0
                ]);
            }
            else
                return 2;
        }

    }
}
