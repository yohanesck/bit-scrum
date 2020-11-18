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
        'full_name',
        'BIRO_ID',
        'url_picture'
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
        return $query->with('seat', 'group');
    }

    public function scopeName()
    {
        return DB::select('select FULL_NAME from S_EMPLOYEE');
    }

    public function scopeByName($query, $name)
    {
        return DB::select("SELECT FULL_NAME FROM S_EMPLOYEE WHERE UPPER(FULL_NAME) LIKE UPPER('%" . $name. "%')");
    }

    public function getCoordinate($nip)
    {
        return DB::select("
            SELECT SEAT_ID
            FROM S_EMPLOYEE
            JOIN T_SEAT
            ON S_EMPLOYEE.NIP = T_SEAT.NIP
            WHERE NIP=$nip"
        );
    }

    public function getEmployeeByFloor($building, $floor)
    {
        return DB::select("SELECT FULL_NAME
            FROM S_EMPLOYEE
            JOIN T_SEAT
            ON S_EMPLOYEE.NIP = T_SEAT.NIP
            WHERE FLOOR = $floor AND UPPER(BUILDING_NAME) = UPPER($building)"
        );
    }
}
