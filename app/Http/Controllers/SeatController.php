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
        return response()->json([
            'result' => $this->seat->data()->building($building)->get()
        ], 200);
    }
}
