<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "M_GROUP";

    protected $primaryKey = "BIRO_ID";

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'BIRO_ID',
        'GROUP_INITIAL',
        'DIVISION_NAME',
        'BIRO_NAME',
        'BIRO_INITIAL'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'BIRO_ID', 'BIRO_ID');
    }

    public function seatColor()
    {
        return $this->hasMany(SeatColor::class, 'GROUP_INITIAL', 'GROUP_INITIAL');
    }
}
