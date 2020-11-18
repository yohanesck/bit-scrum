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
        'biro_id',
        'url_picture'
    ];

    public function seat()
    {
        return $this->belongsTo(Seat::class, 'NIP', 'NIP');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'biro_id', 'biro_id');
    }

    public function scopeData($query)
    {
        return $query->with([
            'seat',
            'group'
        ]);
    }
}
