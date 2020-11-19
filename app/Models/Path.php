<?php

namespace App\Models;

use Bmichotte\Dijkstra\Dijkstra;
use Illuminate\Database\Eloquent\Model;
use Bmichotte\Dijkstra\Point;

class Path extends Model
{
    private $INT_MAX = 0x7FFFFFFF;
    private $_distArr = array();

    public function input($row, $column, $value)
    {
        $this->map[$row][$column] = $value;
        $this->map[$column][$row] = $value;
    }

    public function getMap()
    {
        return $this->map;
    }

    public function generateArrayMBCA15()
    {
        $_distArr[1][2] = 1;
        $_distArr[2][3] = 1;
        $_distArr[3][4] = 1;
        $_distArr[4][5] = 1;
        $_distArr[5][6] = 1;
        $_distArr[6][7] = 1;
        $_distArr[7][8] = 1;
        $_distArr[8][9] = 1;
        $_distArr[8][10] = 1;
        $_distArr[10][11] = 1;
        $_distArr[11][12] = 1;
        $_distArr[12][13] = 1;
        $_distArr[13][14] = 1;
        $_distArr[14][15] = 1;
        $_distArr[15][16] = 1;
        $_distArr[16][17] = 1;
        $_distArr[17][18] = 1;
        $_distArr[18][19] = 1;
        $_distArr[19][20] = 1;
        $_distArr[20][26] = 1;
        $_distArr[26][25] = 1;
        $_distArr[25][24] = 1;
        $_distArr[24][23] = 1;
        $_distArr[23][21] = 1;
        $_distArr[21][1] = 1;
        $_distArr[1][22] = 1;

        //Mirror
        $_distArr[2][1] = 1;
        $_distArr[3][2] = 1;
        $_distArr[4][3] = 1;
        $_distArr[5][4] = 1;
        $_distArr[6][5] = 1;
        $_distArr[7][6] = 1;
        $_distArr[8][7] = 1;
        $_distArr[9][8] = 1;
        $_distArr[10][8] = 1;
        $_distArr[11][10] = 1;
        $_distArr[12][11] = 1;
        $_distArr[13][12] = 1;
        $_distArr[14][13] = 1;
        $_distArr[15][14] = 1;
        $_distArr[16][15] = 1;
        $_distArr[17][16] = 1;
        $_distArr[18][17] = 1;
        $_distArr[19][18] = 1;
        $_distArr[20][19] = 1;
        $_distArr[26][20] = 1;
        $_distArr[25][26] = 1;
        $_distArr[24][25] = 1;
        $_distArr[23][24] = 1;
        $_distArr[21][23] = 1;
        $_distArr[1][21] = 1;
        $_distArr[22][1] = 1;

        return $_distArr;
    }

    public function shortestPath($_distArr, $a, $b)
    {
        //initialize the array for storing
        $S = array();//the nearest path with its parent and weight
        $Q = array();//the left nodes without the nearest path
        foreach(array_keys($_distArr) as $val) $Q[$val] = 99999;
        $Q[$a] = 0;

        //start calculating
        while(!empty($Q)){
            $min = array_search(min($Q), $Q);//the most min weight
            if($min == $b) break;
            foreach($_distArr[$min] as $key=>$val) if(!empty($Q[$key]) && $Q[$min] + $val < $Q[$key]) {
                $Q[$key] = $Q[$min] + $val;
                $S[$key] = array($min, $Q[$key]);
            }
            unset($Q[$min]);
        }

        //list the path
        $path = array();
        $pos = $b;
        while($pos != $a){
            $path[] = $pos;
            $pos = $S[$pos][0];
        }
        $path[] = $a;
        $path = array_reverse($path);

        return $path;
    }
}
