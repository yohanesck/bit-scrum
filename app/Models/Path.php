<?php

namespace App\Models;

use Bmichotte\Dijkstra\Dijkstra;
use Illuminate\Database\Eloquent\Model;
use Bmichotte\Dijkstra\Point;

class Path extends Model
{
    private $INT_MAX = 0x7FFFFFFF;
    private $map = array();

    public function setArrayZero()
    {
        for ($i = 0; $i < 11; $i++) {
            for ($j = 0; $j < 11; $j++) {
                $this->map[$i][$j] = 0;
            }
        }
    }

    public function initializeGraph()
    {
        $this->setArrayZero();

        for ($i = 0; $i < 11; $i++) {
            for ($j = 0; $j < 11; $j++) {
                if (abs($i - $j) == 1) {
                    $this->input($i, $j, 1);
                } else {
                    $this->input($i, $j, 0);
                }
            }
        }

        return $this->getMap();
    }

    public function input($row, $column, $value)
    {
        $this->map[$row][$column] = $value;
        $this->map[$column][$row] = $value;
    }

    public function getMap()
    {
        return $this->map;
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
                if (!$shortestPathTreeSet[$v] && $graph[$u][$v] && $distance[$u] != $this->INT_MAX && $distance[$u] + $graph[$u][$v] < $distance[$v]) {
                    $distance[$v] = $distance[$u] + $graph[$u][$v];
                }
        }

        return $this->PrintResult($distance, $verticesCount);
    }
}
