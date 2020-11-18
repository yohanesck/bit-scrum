<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "S_EMPLOYEE";

    protected $primaryKey = "NIP";

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'NIP',
        'full_name',
        'group_initial',
        'url_picture'
    ];

    public function seat()
    {
        return $this->belongsTo(Seat::class, 'NIP', 'NIP');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_initial', 'group_initial');
    }

    public function scopeData($query, $employee)
    {
        return $query->with([
            'seat',
            'group'
        ]);
    }
}
