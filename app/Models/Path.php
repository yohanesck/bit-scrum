<?php

namespace App\Models;

use Bmichotte\Dijkstra\Dijkstra;
use Illuminate\Database\Eloquent\Model;
use Bmichotte\Dijkstra\Point;

class Path extends Model
{
    public function generatePath()
    {
        $point1 = new Point(1, 1);
        $point2 = new Point(2, 2);
        $point3 = new Point(3, 3);

        $allPoints = [$point1, $point2, $point3];

        $point1->addPoint($point2);
        $point1->addPoint($point3);
        $point2->addPoint($point3);

        $dijkstra = new Dijkstra($allPoints, $point1, $point3);
        return $dijkstra->findShortestPath();
    }
}
