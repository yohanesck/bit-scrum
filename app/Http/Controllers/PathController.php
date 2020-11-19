<?php

namespace App\Http\Controllers;

use App\Models\Path;
use App\Models\Seat;
use Exception;
use Illuminate\Http\Request;

class PathController extends Controller
{
    private $path;
    private $seat;

    public function __construct(Path $path, Seat $seat)
    {
        $this->path = $path;
        $this->seat = $seat;
    }

    public function getShortestPath($building, $floor, $from, $to)
    {
        try {
            return response()->json([
                'result' => [
                    'path' => $this->path->handleRequest($building, $floor, $from, $to),
                    'seat' => [
                        'seat_name' => $to,
                        'coordinate' => $this->seat->getCoordinateBySeatName($to)
                    ]
                ]
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
