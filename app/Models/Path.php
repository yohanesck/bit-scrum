<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\DeclareDeclare;

class Path extends Model
{
    public function inputArray(&$arr, $row, $column, $value)
    {
        $arr[$row][$column] = $value;
        $arr[$column][$row] = $value;
    }

    public function handleRequest($building, $floor, $from, $to)
    {
        $tempStart = (array) $this->getNodes($from, $building, $floor)[0];
        $tempEnd = (array) $this->getNodes($to, $building, $floor)[0];
        $nodeStart = $tempStart['NO_NODE'];
        $nodeEnd = $tempEnd['NO_NODE'];

        if (strtolower($building) == 'mbca') {
            if (strtolower($floor) == '15') {
                $result = $this->shortestPath($this->generateArrayMBCA15(), $nodeStart, $nodeEnd);
                return $this->getCoordinateXY($result, $building, $floor);
            } else if (strtolower($floor) == '33') {
                $result = $this->shortestPath($this->generateArrayMBCA33(), $nodeStart, $nodeEnd);
                return $this->getCoordinateXY($result, $building, $floor);
            }
        } else if (strtolower($building) == 'wsa2') {
            if (strtolower($floor) == '12b') {
                $result = $this->shortestPath($this->generateArrayWSA12B(), $nodeStart, $nodeEnd);
                return $this->getCoordinateXY($result, $building, $floor);
            }
        }

        throw new Exception('Bad Request', 400);
    }

    public function getNodes($param, $building, $floor)
    {
        $query = "SELECT NO_NODE FROM T_SEAT WHERE (BUILDING_NAME LIKE '$building' AND FLOOR LIKE '$floor') AND SEAT_NAME LIKE UPPER('$param')";
        return DB::select($query);
    }

    public function getCoordinateXY($result, $building, $floor)
    {
        //Get coordinate from table Node by node_id
        $arrCoordinate = array();

        for ($i=0; $i<count($result); $i++) {
            $query = "SELECT NO_NODE, COORD_X, COORD_Y FROM M_NODE WHERE (BUILDING_NAME LIKE '$building' AND FLOOR = '$floor') AND (NO_NODE = $result[$i])";
            $data = DB::select($query);
            dd(array_values($data));
            array_push($arrCoordinate, $data);
        }

        dd($arrCoordinate);

        foreach ($arrCoordinate as $item) {

        }

        return $coordinate;
    }

    /**
     * @return mixed
     */
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
        $_distArr[26][27] = 1;
        $_distArr[27][28] = 1;
        $_distArr[28][29] = 1;
        $_distArr[29][30] = 1;
        $_distArr[30][23] = 1;
        $_distArr[26][25] = 1;
        $_distArr[25][24] = 1;
        $_distArr[24][23] = 1;
        $_distArr[23][21] = 1;
        $_distArr[21][1] = 1;
        $_distArr[23][22] = 1;

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
        $_distArr[27][26] = 1;
        $_distArr[28][27] = 1;
        $_distArr[29][28] = 1;
        $_distArr[30][29] = 1;
        $_distArr[23][30] = 1;
        $_distArr[25][26] = 1;
        $_distArr[24][25] = 1;
        $_distArr[23][24] = 1;
        $_distArr[21][23] = 1;
        $_distArr[1][21] = 1;
        $_distArr[22][23] = 1;

        return $_distArr;
    }

    public function generateArrayMBCA33()
    {
        $arr = array();
        $this->inputArray($arr, 1, 2, 1);
        $this->inputArray($arr, 2, 3, 1);
        $this->inputArray($arr, 3, 4, 1);
        $this->inputArray($arr, 4, 5, 1);
        $this->inputArray($arr, 5, 6, 1);
        $this->inputArray($arr, 6, 7, 1);
        $this->inputArray($arr, 7, 8, 1);
        $this->inputArray($arr, 8, 9, 1);
        $this->inputArray($arr, 9, 10, 1);
        $this->inputArray($arr, 10, 11, 1);
        $this->inputArray($arr, 11, 12, 1);
        $this->inputArray($arr, 12, 13, 1);
        $this->inputArray($arr, 13, 14, 1);
        $this->inputArray($arr, 14, 15, 1);
        $this->inputArray($arr, 15, 16, 1);
        $this->inputArray($arr, 16, 17, 1);
        $this->inputArray($arr, 17, 18, 1);
        $this->inputArray($arr, 18, 19, 1);
        $this->inputArray($arr, 19, 20, 1.5);
        $this->inputArray($arr, 20, 2, 1);

        return $arr;
    }

    public function generateArrayWSA12B()
    {
        $arr = array();

        $this->inputArray($arr, 1, 2, 1);
        $this->inputArray($arr, 2, 3, 1);
        $this->inputArray($arr, 3, 4, 1);
        $this->inputArray($arr, 4, 5, 1);
        $this->inputArray($arr, 5, 6, 1);
        $this->inputArray($arr, 6, 7, 1);
        $this->inputArray($arr, 7, 8, 1);
        $this->inputArray($arr, 7, 9, 1);
        $this->inputArray($arr, 8, 9, 1.5);
        $this->inputArray($arr, 9, 10, 1);
        $this->inputArray($arr, 10, 11, 1);
        $this->inputArray($arr, 11, 12, 1);
        $this->inputArray($arr, 12, 13, 1);
        $this->inputArray($arr, 13, 14, 1);
        $this->inputArray($arr, 14, 15, 1);
        $this->inputArray($arr, 15, 16, 1);
        $this->inputArray($arr, 16, 17, 1);
        $this->inputArray($arr, 17, 18, 1);
        $this->inputArray($arr, 17, 19, 1);
        $this->inputArray($arr, 19, 20, 1);
        $this->inputArray($arr, 20, 21, 1);
        $this->inputArray($arr, 21, 22, 1);
        $this->inputArray($arr, 22, 2, 1);
        $this->inputArray($arr, 28, 27, 1);
        $this->inputArray($arr, 27, 26, 1);
        $this->inputArray($arr, 26, 24, 1);
        $this->inputArray($arr, 15, 25, 1);
        $this->inputArray($arr, 25, 24, 1);
        $this->inputArray($arr, 24, 23, 1);
        $this->inputArray($arr, 23, 4, 1);

        return $arr;
    }

    /**
     * @param $_distArr
     * @param $a
     * @param $b
     * @return array
     */
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
            $path[] = "".$pos;
            $pos = $S[$pos][0];
        }
        $path[] = $a;

        $path = array_reverse($path);

        return $path;
    }
}
