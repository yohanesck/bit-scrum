<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Seat extends Model
{
    protected $table = "T_SEAT";

    protected $primaryKey = "seat_id";

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'seat_id',
        'seat_name',
        'NIP',
        'building_name',
        'floor'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'NIP', 'NIP');
    }

    public function getFloor()
    {
        return DB::select("SELECT DISTINCT seat_id, seat_name, building_name, NIP, floor FROM T_SEAT");
    }

    public function getDataByBuildingFloor($building, $floor)
    {
        return DB::select("
            SELECT * FROM T_SEAT LEFT JOIN S_EMPLOYEE
            ON T_SEAT.NIP = S_EMPLOYEE.NIP
            WHERE T_SEAT.BUILDING_NAME LIKE '$building'
            AND T_SEAT.FLOOR = $floor
        ");
    }
}
