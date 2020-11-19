<?php

namespace App\Http\Controllers;

use App\Models\Path;
use Illuminate\Http\Request;

class PathController extends Controller
{
    private $path;

    public function __construct(Path $path)
    {
        $this->path = $path;
    }

    public function getShortestPath()
    {
        $graph = array(
            array(0, 4, 0, 0, 0, 0, 0, 8, 0),
            array(4, 0, 8, 0, 0, 0, 0, 11, 0),
            array(0, 8, 0, 7, 0, 4, 0, 0, 2),
            array(0, 0, 7, 0, 9, 14, 0, 0, 0),
            array(0, 0, 0, 9, 0, 10, 0, 0, 0),
            array(0, 0, 4, 0, 10, 0, 2, 0, 0),
            array(0, 0, 0, 14, 0, 2, 0, 1, 6),
            array(8, 11, 0, 0, 0, 0, 1, 0, 7),
            array(0, 0, 2, 0, 0, 0, 6, 7, 0)
        );

        dd($this->path->Dijkstra($graph, 0, 9));

        return response()->json([
            'result' => $this->path->Dijkstra($graph, 0, 9)
        ], 200);
    }
}
