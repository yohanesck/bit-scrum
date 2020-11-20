<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Seat extends Model
{
    protected $table = "T_SEAT";

    protected $primaryKey = "SEAT_ID";

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'SEAT_ID',
        'SEAT_NAME',
        'NIP',
        'BUILDING_NAME',
        'FLOOR',
        'NO_NODE',
        'COORD_X',
        'COORD_Y'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'NIP', 'NIP');
    }

    public function getFloor()
    {
        return DB::select("SELECT DISTINCT seat_id, seat_name, building_name, floor FROM T_SEAT");
    }

    public function scopeData($query)
    {
        return $query->with('employee', 'employee.group', 'employee.group.seatColor');
    }

    public function scopeBuilding($query, $building)
    {
        return $query->where('building_name', $building);
    }

    public function scopeFloor($query, $floor)
    {
        return $query->where('floor', $floor);
    }

    public function getCoordinateBySeatName($building, $floor, $seatName)
    {
        $query = "SELECT COORD_X, COORD_Y, S_EMPLOYEE.NIP FROM T_SEAT LEFT JOIN S_EMPLOYEE ON T_SEAT.NIP = S_EMPLOYEE.NIP WHERE T_SEAT.BUILDING_NAME LIKE '$building' AND T_SEAT.FLOOR LIKE '$floor' AND T_SEAT.SEAT_NAME LIKE '$seatName'";

        return DB::select($query);
    }
}
