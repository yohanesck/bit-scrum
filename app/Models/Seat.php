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
        return DB::select("SELECT DISTINCT seat_id, seat_name, building_name, floor FROM T_SEAT");
    }

    public function scopeDataSeatByFloor($query, $building, $floor)
    {
        return $query->where(
            [
                'building_name' => $building,
                'floor' => $floor
            ]
        );
    }
}
