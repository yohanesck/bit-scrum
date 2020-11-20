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

    public function getCoordinateBySeatName($seatName)
    {
        return DB::select("SELECT NO_NODE, COORD_X, COORD_Y FROM T_SEAT WHERE SEAT_NAME LIKE '$seatName'");
    }
}
