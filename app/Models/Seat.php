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
        'NIP',
        'building',
        'floor'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'NIP', 'NIP');
    }

    public function getFloor()
    {
        return DB::select("SELECT DISTINCT BUILDING, FLOOR FROM T_SEAT");
    }
}
