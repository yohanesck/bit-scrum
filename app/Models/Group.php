<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "M_GROUP";

    protected $primaryKey = "BIRO_ID";

    public $timestamps = false;

    protected $fillable = [
        'BIRO_ID',
        'group_initial',
        'division_name',
        'biro_name'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'BIRO_ID', 'BIRO_ID');
    }
}
