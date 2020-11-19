<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\RegularExpressionTest;

class SeatController extends Controller
{
    private $seat;

    public function __construct(Seat $seat)
    {
        $this->seat = $seat;
    }

    public function getFLoor()
    {
        return response()->json([
            'result' => $this->seat->getFloor()
        ], 200);
    }

    public function getDataSeatByFloor($building, $floor)
    {
//        dd($this->seat->data()->where("T_SEAT.BUILDING_NAME", "'".$building."'")->get());
        return response()->json([
            'result' => $this->seat->where('a', 381)
        ], 200);
//        return response()->json([
//            'result' => $this->seat->getDataByBuildingFloor($building, $floor)
//        ], 200);
    }
}
