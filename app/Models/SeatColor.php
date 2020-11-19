<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatColor extends Model
{
    protected $table = 'M_SEAT_COLOR';

    protected $primaryKey = 'GROUP_INITIAL';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable= [
        'GROUP_INITIAL',
        'COLOR_NAME',
        'COLOR_HEX'
    ];

    public function group()
    {
        return $this->hasMany(Group::class, 'GROUP_INITIAL', 'GROUP_INITIAL');
    }
}
