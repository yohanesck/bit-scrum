<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "M_GROUP";

    protected $primaryKey = "group_initial";

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'group_initial',
        'division_name',
        'biro_name'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'group_initial', 'group_initial');
    }
}
