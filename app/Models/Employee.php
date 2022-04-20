<?php

namespace App\Models;

use App\Models\City;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'city_id',
        'department_id',
        'birthdate',
        'date_hired',
        'zip_code',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}