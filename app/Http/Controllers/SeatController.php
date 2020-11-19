<?php

namespace App\Http\Controllers;

use App\Models\Path;
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
            'result' => $this->seat->data()->building($building)->floor($floor)->get()
        ], 200);
    }

    public function getShortestPath()
    {
        $path = new Path();
        $graph = array(
        array(0, 4, 0, 0, 0, 0, 0, 8, 0),
        array(4, 0, 8, 0, 0, 0, 0, 11, 0),
        array(0, 8, 0, 7, 0, 4, 0, 0, 2),
        array(0, 0, 7, 0, 9, 14, 0, 0, 0),
        array(0, 0, 0, 9, 0, 10, 0, 0, 0),
        array(0, 0, 4, 0, 10, 0, 2, 0, 0),
        array(0, 0, 0, 14, 0, 2, 0, 1, 6),
        array(8, 11, 0, 0, 0, 0, 1, 0, 7),
        array(0, 0, 2, 0, 0, 0, 6, 7, 0));

        return response()->json([
            'result' => $path->Dijkstra($graph, 0, 9)
        ], 200);
    }
}
