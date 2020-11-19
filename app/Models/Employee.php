<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    protected $table = "S_EMPLOYEE";

    protected $primaryKey = "NIP";

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'NIP',
        'FULL_NAME',
        'INITIAL_NAME',
        'BIRO_ID',
        'url_picture',
        'AD_NAME'
    ];

    public function seat()
    {
        return $this->belongsTo(Seat::class, 'NIP', 'NIP');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'BIRO_ID', 'BIRO_ID');
    }

    public function scopeData($query)
    {
        return $query->with('seat', 'group', 'group.seatColor');
    }

    public function scopeByName($query, $name)
    {
        return DB::select("SELECT * FROM S_EMPLOYEE
            WHERE UPPER(FULL_NAME) LIKE UPPER('%" . $name . "%')
            OR UPPER(INITIAL_NAME) LIKE UPPER('%" . $name . "%')"
        );
    }

    public function getCoordinate($nip)
    {
        return DB::select("
            SELECT SEAT_NAME
            FROM S_EMPLOYEE
            JOIN T_SEAT
            ON S_EMPLOYEE.NIP = T_SEAT.NIP
            WHERE S_EMPLOYEE.NIP=$nip"
        );
    }

    public function getEmployeeByFloor($building, $floor)
    {
        return DB::select("SELECT S_EMPLOYEE.NIP, S_EMPLOYEE.FULL_NAME
            FROM S_EMPLOYEE
            JOIN T_SEAT
            ON S_EMPLOYEE.NIP = T_SEAT.NIP
            WHERE FLOOR = $floor AND UPPER(BUILDING_NAME) = UPPER('$building')"
        );
    }
}
