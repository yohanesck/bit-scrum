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
        $graph = $this->path->initializeGraph();

        return response()->json([
            'result' => $this->path->Dijkstra($graph, 0, 6),
            'input_array' => $this->path->getMap()
        ], 200);
    }
}
