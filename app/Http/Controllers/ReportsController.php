<?php
/**
 * Created by PhpStorm.
 * User: karim
 * Date: 01/08/16
 * Time: 09:18 م
 */

namespace App\Http\Controllers;

use App\models\InCome;
use App\models\OutCome;
use App\models\Paying;
use App\models\Place;
use App\models\Player;
use App\models\Sponsor;
use App\models\Subscription;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\User;

class ReportsController extends Controller
{

    public function __construct()
    {

    }
    public function GetMonths(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'place_id' => 'required',
        ]);
        $place_id = 0;
        if ($request->place_id != "all") {
            $place_id = $request->place_id;
        }
        switch ($request->type) {
            case 'subscriptions':
                if($place_id)
                {
                    $incomes = InCome::where('incomes_type_id', 1)->where('place_id',$place_id)->withTrashed()->get();
                }
                else
                {
                    $incomes = InCome::where('incomes_type_id', 1)->withTrashed()->get();
                }
                $months = array();
                foreach ($incomes as $income) {
                    $months[] = date('m', strtotime($income->created_at));
                }
                $months = array_unique($months);
                foreach ($months as $month) {
                    echo "<option value='{$month}'>" . date('F', strtotime('2010' . $month . '01')) . "</option>";
                }
                break;
            case 'debts':
                if($place_id)
                {
                    $incomes = InCome::where('incomes_type_id', 1)->where('place_id',$place_id)->withTrashed()->get();
                }
                else
                {
                    $incomes = InCome::where('incomes_type_id', 1)->withTrashed()->get();
                }
                $months = array();
                foreach ($incomes as $income) {
                    if($income->subscription->debt == 0)
                        continue;
                    $months[] = date('m', strtotime($income->created_at));
                }
                $months = array_unique($months);
                foreach ($months as $month) {
                    echo "<option value='{$month}'>" . date('F', strtotime('2010' . $month . '01')) . "</option>";
                }
                break;
            case 'sold':
                if($place_id)
                {
                    $incomes = InCome::where('incomes_type_id', 2)->where('place_id',$place_id)->withTrashed()->get();
                }
                else
                {
                    $incomes = InCome::where('incomes_type_id', 2)->withTrashed()->get();
                }
                $months = array();
                foreach ($incomes as $income) {
                    $months[] = date('m', strtotime($income->created_at));
                }
                $months = array_unique($months);
                foreach ($months as $month) {
                    echo "<option value='{$month}'>" . date('F', strtotime('2010' . $month . '01')) . "</option>";
                }
                break;
            case 'purchased':
                if($place_id)
                {
                    $outcomes = OutCome::where('outcomes_type_id', 2)->where('place_id',$place_id)->withTrashed()->get();
                }
                else
                {
                    $outcomes = OutCome::where('outcomes_type_id', 2)->withTrashed()->get();
                }
                $months = array();
                foreach ($outcomes as $outcome) {
                    $months[] = date('m', strtotime($outcome->created_at));
                }
                $months = array_unique($months);
                foreach ($months as $month) {
                    echo "<option value='{$month}'>" . date('F', strtotime('2010' . $month . '01')) . "</option>";
                }
                break;

            case 'products_debts':
                if($place_id)
                {
                    $incomes = InCome::where('incomes_type_id', 3)->where('place_id',$place_id)->withTrashed()->get();
                }
                else
                {
                    $incomes = InCome::where('incomes_type_id', 3)->withTrashed()->get();
                }
                $months = array();
                foreach ($incomes as $income) {
                    if($income->debt)
                    $months[] = date('m', strtotime($income->created_at));
                }
                $months = array_unique($months);
                foreach ($months as $month) {
                    echo "<option value='{$month}'>" . date('F', strtotime('2010' . $month . '01')) . "</option>";
                }
                break;
            case 'rents':
                if($place_id)
                {
                    $outcomes = OutCome::where('outcomes_type_id', 1)->where('place_id',$place_id)->withTrashed()->get();
                }
                else
                {
                    $outcomes = OutCome::where('outcomes_type_id', 1)->withTrashed()->get();
                }
                $months = array();
                foreach ($outcomes as $outcome) {
                    $months[] = date('m', strtotime($outcome->created_at));
                }
                $months = array_unique($months);
                foreach ($months as $month) {
                    echo "<option value='{$month}'>" . date('F', strtotime('2010' . $month . '01')) . "</option>";
                }
                break;
            case 'salaries':
                if($place_id)
                {
                    $outcomes = OutCome::where('outcomes_type_id', 3)
                        ->orwhere('outcomes_type_id', 4)
                        ->orwhere('outcomes_type_id', 5)
                        ->where('place_id',$place_id)
                        ->withTrashed()->get();
                }
                else
                {
                    $outcomes = OutCome::where('outcomes_type_id', 3)
                        ->orwhere('outcomes_type_id', 4)
                        ->orwhere('outcomes_type_id', 5)
                        ->withTrashed()->get();
                }
                $months = array();
                foreach ($outcomes as $outcome) {
                    $months[] = date('m', strtotime($outcome->created_at));
                }
                $months = array_unique($months);
                foreach ($months as $month) {
                    echo "<option value='{$month}'>" . date('F', strtotime('2010' . $month . '01')) . "</option>";
                }
                break;
            case 'extra_incomes':
                if($place_id)
                {
                    $incomes = InCome::where('incomes_type_id', 3)->where('place_id',$place_id)->withTrashed()->get();
                }
                else
                {
                    $incomes = InCome::where('incomes_type_id', 3)->withTrashed()->get();
                }
                $months = array();
                foreach ($incomes as $income) {
                    $months[] = date('m', strtotime($income->created_at));
                }
                $months = array_unique($months);
                foreach ($months as $month) {
                    echo "<option value='{$month}'>" . date('F', strtotime('2010' . $month . '01')) . "</option>";
                }
                break;
            case 'extra_outcomes':
                if($place_id)
                {
                    $outcomes = OutCome::where('outcomes_type_id', 6)
                        ->where('place_id',$place_id)
                        ->withTrashed()->get();
                }
                else
                {
                    $outcomes = OutCome::where('outcomes_type_id', 6)
                        ->withTrashed()->get();
                }
                $months = array();
                foreach ($outcomes as $outcome) {
                    $months[] = date('m', strtotime($outcome->created_at));
                }
                $months = array_unique($months);
                foreach ($months as $month) {
                    echo "<option value='{$month}'>" . date('F', strtotime('2010' . $month . '01')) . "</option>";
                }
                break;
            case 'outcomes':
                if($place_id)
                    {
                    $outcomes = OutCome::where('place_id',$place_id)->withTrashed()->get();
                }
                else
                {
                    $outcomes = OutCome::withTrashed()->get();
                }
                $months = array();
                foreach ($outcomes as $outcome) {
                    $months[] = date('m', strtotime($outcome->created_at));
                }
                $months = array_unique($months);
                foreach ($months as $month) {
                    echo "<option value='{$month}'>" . date('F', strtotime('2010' . $month . '01')) . "</option>";
                }
                break;
            case 'incomes':
                if($place_id)
                {
                    $incomes = InCome::where('place_id',$place_id)->withTrashed()->get();
                }
                else
                {
                    $incomes = InCome::withTrashed()->get();
                }
                $months = array();
                foreach ($incomes as $income) {
                    $months[] = date('m', strtotime($income->created_at));
                }
                $months = array_unique($months);
                foreach ($months as $month) {
                    echo "<option value='{$month}'>" . date('F', strtotime('2010' . $month . '01')) . "</option>";
                }
                break;
        }
    }
    public function GetYears(Request $request)
    {
$this->validate($request, [
    'type' => 'required',
    'place_id' => 'required',
]);
$place_id = 0;
if ($request->place_id != "all") {
    $place_id = $request->place_id;
}
switch ($request->type) {
    case 'subscriptions':
        if($place_id)
        {
            $incomes = InCome::where('incomes_type_id', 1)->where('place_id',$place_id)->withTrashed()->get();
        }
        else
        {
            $incomes = InCome::where('incomes_type_id', 1)->withTrashed()->get();
        }
        $years = array();
        foreach ($incomes as $income) {
            $years[] = date('Y', strtotime($income->created_at));
        }
        $years = array_unique($years);
        foreach ($years as $year) {
            echo "<option value='{$year}'>$year</option>";
        }
        break;
    case 'debts':
        if($place_id)
        {
            $incomes = InCome::where('incomes_type_id', 1)->where('place_id',$place_id)->withTrashed()->get();
        }
        else
        {
            $incomes = InCome::where('incomes_type_id', 1)->withTrashed()->get();
        }
        $years = array();
        foreach ($incomes as $income) {
            if($income->subscription->debt == 0)
                continue;
            $years[] = date('Y', strtotime($income->created_at));
        }
        $years = array_unique($years);
        foreach ($years as $year) {
            echo "<option value='{$year}'>$year</option>";
        }
        break;
    case 'sold':
        if($place_id)
        {
            $incomes = InCome::where('incomes_type_id', 2)->where('place_id',$place_id)->withTrashed()->get();
        }
        else
        {
            $incomes = InCome::where('incomes_type_id', 2)->withTrashed()->get();
        }
        $years = array();
        foreach ($incomes as $income) {
            $years[] = date('Y', strtotime($income->created_at));
        }
        $years = array_unique($years);
        foreach ($years as $year) {
            echo "<option value='{$year}'>$year</option>";
        }
        break;
    case 'purchased':
        if($place_id)
        {
            $outcomes = OutCome::where('outcomes_type_id', 2)->where('place_id',$place_id)->withTrashed()->get();
        }
        else
        {
            $outcomes = OutCome::where('outcomes_type_id', 2)->withTrashed()->get();
        }
        $years = array();
        foreach ($outcomes as $outcome) {
            $years[] = date('Y', strtotime($outcome->created_at));
        }
        $years = array_unique($years);
        foreach ($years as $year) {
            echo "<option value='{$year}'>$year</option>";
        }
        break;

    case 'products_debts':
        if($place_id)
        {
            $incomes = InCome::where('incomes_type_id', 3)->where('place_id',$place_id)->withTrashed()->get();
        }
        else
        {
            $incomes = InCome::where('incomes_type_id', 3)->withTrashed()->get();
        }
        $years = array();
        foreach ($incomes as $income) {
            if($income->debt)
                $years[] = date('Y', strtotime($income->created_at));
        }
        $years = array_unique($years);
        foreach ($years as $year) {
            echo "<option value='{$year}'>$year</option>";
        }
        break;
    case 'rents':
        if($place_id)
        {
            $outcomes = OutCome::where('outcomes_type_id', 1)->where('place_id',$place_id)->withTrashed()->get();
        }
        else
        {
            $outcomes = OutCome::where('outcomes_type_id', 1)->withTrashed()->get();
        }
        $years = array();
        foreach ($outcomes as $outcome) {
            $years[] = date('Y', strtotime($outcome->created_at));
        }
        $years = array_unique($years);
        foreach ($years as $year) {
            echo "<option value='{$year}'>$year</option>";
        }
        break;
    case 'salaries':
        if($place_id)
        {
            $outcomes = OutCome::where('outcomes_type_id', 3)
                ->orwhere('outcomes_type_id', 4)
                ->orwhere('outcomes_type_id', 5)
                ->where('place_id',$place_id)
                ->withTrashed()->get();
        }
        else
        {
            $outcomes = OutCome::where('outcomes_type_id', 3)
                ->orwhere('outcomes_type_id', 4)
                ->orwhere('outcomes_type_id', 5)
                ->withTrashed()->get();
        }
        $years = array();
        foreach ($outcomes as $outcome) {
            $years[] = date('Y', strtotime($outcome->created_at));
        }
        $years = array_unique($years);
        foreach ($years as $year) {
            echo "<option value='{$year}'>$year</option>";
        }
        break;
    case 'extra_incomes':
        if($place_id)
        {
            $incomes = InCome::where('incomes_type_id', 3)->where('place_id',$place_id)->withTrashed()->get();
        }
        else
        {
            $incomes = InCome::where('incomes_type_id', 3)->withTrashed()->get();
        }
        $years = array();
        foreach ($incomes as $income) {
            $years[] = date('Y', strtotime($income->created_at));
        }
        $years = array_unique($years);
        foreach ($years as $year) {
            echo "<option value='{$year}'>$year</option>";
        }
        break;
    case 'extra_outcomes':
        if($place_id)
        {
            $outcomes = OutCome::where('outcomes_type_id', 6)
                ->where('place_id',$place_id)
                ->withTrashed()->get();
        }
        else
        {
            $outcomes = OutCome::where('outcomes_type_id', 6)
                ->withTrashed()->get();
        }
        $years = array();
        foreach ($outcomes as $outcome) {
            $years[] = date('Y', strtotime($outcome->created_at));
        }
        $years = array_unique($years);
        foreach ($years as $year) {
            echo "<option value='{$year}'>$year</option>";
        }
        break;
    case 'outcomes':
        if($place_id)
        {
            $outcomes = OutCome::where('place_id',$place_id)->withTrashed()->get();
        }
        else
        {
            $outcomes = OutCome::withTrashed()->get();
        }
        $years = array();
        foreach ($outcomes as $outcome) {
            $years[] = date('Y', strtotime($outcome->created_at));
        }
        $years = array_unique($years);
        foreach ($years as $year) {
            echo "<option value='{$year}'>$year</option>";
        }
        break;
    case 'incomes':
        if($place_id)
        {
            $incomes = InCome::where('place_id',$place_id)->withTrashed()->get();
        }
        else
        {
            $incomes = InCome::withTrashed()->get();
        }
        $years = array();
        foreach ($incomes as $income) {
            $years[] = date('Y', strtotime($income->created_at));
        }
        $years = array_unique($years);
        foreach ($years as $year) {
            echo "<option value='{$year}'>$year</option>";
        }
        break;
}
}
public function FinalReport(Request $request)
{
    $this->validate($request, [
        'type' => 'required',
        'place_id' => 'required',
        'month' => 'required',
        'year' => 'required',
    ]);
    $places_all_flag = 0;
    $months_all_flag = 0;
    $years_all_flag = 0;
    $all_incomes = InCome::withTrashed()->get();
    $all_outcomes = OutCome::withTrashed()->get();
    if($request->place_id != "all")
    {
        $all_incomes = InCome::where('place_id',$request->place_id)->withTrashed()->get();
        $all_outcomes = OutCome::where('place_id',$request->place_id)->withTrashed()->get();
    }
    if($request->month != "all")
    {
        foreach ($all_incomes as $key => $income)
        {
            if( date('m', strtotime($income->created_at)) != $request->month)
            {
                unset($all_incomes[$key]);
            }
        }

        foreach ($all_outcomes as $key => $outcome)
        {
            if( date('m', strtotime($outcome->created_at)) != $request->month)
            {
                unset($all_outcomes[$key]);
            }
        }
    }
    if($request->year != "all")
    {

        foreach ($all_incomes as $key => $income)
        {
            if( date('Y', strtotime($income->created_at)) != $request->year)
            {
                unset($all_incomes[$key]);
            }
        }
        foreach ($all_outcomes as $key => $outcome)
        {
            if( date('Y', strtotime($outcome->created_at)) != $request->year)
            {
                unset($all_outcomes[$key]);
            }
        }
    }
    switch ($request->type)
    {
        case 'subscriptions':
            foreach ($all_incomes as $key => $income)
            {
                if($income->incomes_type_id ==2 || $income->incomes_type_id ==3)
                {
                    unset($all_incomes[$key]);
                }
            }
            return view('reports.subscriptions',['incomes'=>$all_incomes,'sponsors'=>Sponsor::get()]);
            break;
        case 'debts':
            foreach ($all_incomes as $key => $income)
            {
                if($income->incomes_type_id !=1)
                {
                    unset($all_incomes[$key]);
                }
            }
            return view('reports.subscriptions',['incomes'=>$all_incomes]);
            break;
        case 'sold':
            foreach ($all_incomes as $key => $income)
            {
                if($income->incomes_type_id == 1 ||$income->incomes_type_id == 4 || $income->incomes_type_id == 3 )
                {
                    unset($all_incomes[$key]);
                }
            }
            return view('reports.sold',['incomes'=>$all_incomes]);
            break;
        case 'purchased':
            foreach ($all_outcomes as $key => $outcome)
            {
                if($outcome->outcomes_type_id !=2)
                {
                    unset($all_outcomes[$key]);
                }
            }
            return view('reports.purchased',['outcomes'=>$all_outcomes]);
            break;
        case 'products_debts':
            foreach ($all_incomes as $key => $income)
            {
                if($income->incomes_type_id !=3 || $income->debt==0)
                {
                    unset($all_incomes[$key]);
                }
            }
            return view('reports.products_debts',['incomes'=>$all_incomes]);
            break;
        case 'rents':
            foreach ($all_outcomes as $key => $outcome)
            {
                if($outcome->outcomes_type_id !=1)
                {
                    unset($all_outcomes[$key]);
                }
            }
            return view('reports.rents',['outcomes'=>$all_outcomes]);
            break;
        case 'salaries':
            foreach ($all_outcomes as $key => $outcome)
            {
                if($outcome->outcomes_type_id !=3 || $outcome->outcomes_type_id !=3 )
                {
                    unset($all_outcomes[$key]);
                }
            }
            return view('reports.salaries',['outcomes'=>$all_outcomes]);
            break;
        case 'extra_incomes':
            foreach ($all_incomes as $key => $income)
            {
                if($income->incomes_type_id == 1 || $income->incomes_type_id == 2 || $income->incomes_type_id == 4)
                {
                    unset($all_incomes[$key]);
                }
            }
            return view('reports.extra_incomes',['incomes'=>$all_incomes]);
            break;
        case 'extra_outcomes':
            foreach ($all_outcomes as $key => $outcome)
            {
                if($outcome->outcomes_type_id != 6)
                {
                    unset($all_outcomes[$key]);
                }
            }
            return view('reports.extra_outcomes',['outcomes'=>$all_outcomes]);
            break;
    }
}
}
