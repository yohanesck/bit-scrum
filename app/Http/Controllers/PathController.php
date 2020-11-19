<?php

namespace App\Http\Controllers;

use App\Models\Path;
use Exception;
use Illuminate\Http\Request;

class PathController extends Controller
{
    private $path;

    public function __construct(Path $path)
    {
        $this->path = $path;
    }

    public function getShortestPath($building, $floor, $from, $to)
    {
        if (strtolower($building) == 'mbca' && strtolower($floor) == '15')
            return response()->json([
                'result' => $this->path->shortestPath($this->path->generateArrayMBCA15(), $from, $to)
            ], 200);

        throw new Exception('Service Unavailable', 503);
    }
}
