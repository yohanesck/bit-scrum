<?php

namespace App\Models;

use Bmichotte\Dijkstra\Dijkstra;
use Illuminate\Database\Eloquent\Model;
use Bmichotte\Dijkstra\Point;

class Path extends Model
{
    private $INT_MAX = 0x7FFFFFFF;

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
        $result = $dijkstra->findShortestPath();
        var_dump($result);
        return $result;
    }

    public function MinimumDistance($distance, $shortestPathTreeSet, $verticesCount)
    {
        $min = $this->INT_MAX;
        $minIndex = 0;

        for ($v = 0; $v < $verticesCount; ++$v)
        {
            if ($shortestPathTreeSet[$v] == false && $distance[$v] <= $min)
            {
                $min = $distance[$v];
                $minIndex = $v;
            }
        }

        return $minIndex;
    }

    public function PrintResult($distance, $verticesCount)
    {
        $output = array();

        for ($i = 0; $i < $verticesCount; ++$i)
            $output[$i] = $i . " - " . $distance[$i];

        return $output;
    }

    public function Dijkstra($graph, $source, $verticesCount)
    {
        $distance = array();
        $shortestPathTreeSet = array();

        for ($i = 0; $i < $verticesCount; ++$i)
        {
            $distance[$i] = $this->INT_MAX;
            $shortestPathTreeSet[$i] = false;
        }

        $distance[$source] = 0;

        for ($count = 0; $count < $verticesCount - 1; ++$count)
        {
            $u = $this->MinimumDistance($distance, $shortestPathTreeSet, $verticesCount);
            $shortestPathTreeSet[$u] = true;

            for ($v = 0; $v < $verticesCount; ++$v)
                if (!$shortestPathTreeSet[$v] && $graph[$u][$v] && $distance[$u] != $this->INT_MAX && $distance[$u] + $graph[$u][$v] < $distance[$v])
                    $distance[$v] = $distance[$u] + $graph[$u][$v];
        }

        return $this->PrintResult($distance, $verticesCount);
    }
}
