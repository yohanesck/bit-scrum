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

    public function getData()
    {
        return $this->leftJoin('EMPLOYEE', 'EMPLOYEE.NIP', '=', 'T_SEAT.NIP');
    }

    public function scopeBuilding($query, $building)
    {
        return $query->where('building_name', 'LIKE', $building);
    }

    public function scopeFloor($query, $floor)
    {
        return $query->where('building_name', 'LIKE', $floor);
    }
}
