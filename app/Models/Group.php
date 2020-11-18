<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "M_GROUP";

    protected $primaryKey = "biro_id";

    public $timestamps = false;

    protected $fillable = [
        'biro_id',
        'group_initial',
        'division_name',
        'biro_name'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'biro_id', 'biro_id');
    }
}
