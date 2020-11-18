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
        return $query->with('seat');
    }
}
