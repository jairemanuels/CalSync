<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class DateController extends Controller
{
    public function addWeek(Request $request)
    {
        $date = Carbon::parse($request->date)->addWeek();
        return response()->json(['newDate' => $date->format('Y-m-d')]);
    }

    public function subWeek(Request $request)
    {
        $date = Carbon::parse($request->date)->subWeek();
        return response()->json(['newDate' => $date->format('Y-m-d')]);
    }

    public function addMonth(Request $request)
    {
        $date = Carbon::parse($request->date);
        $newDate = $date->addMonth()->format('Y-m-d');

        return response()->json(['newDate' => $newDate]);
    }

    public function subMonth(Request $request)
    {
        $date = Carbon::parse($request->date);
        $newDate = $date->subMonth()->format('Y-m-d');

        return response()->json(['newDate' => $newDate]);
    }

}
