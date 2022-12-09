<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetails extends Model
{
    use HasFactory;

    protected $table = 'employeedetails';
    protected $fillable = [
        'emp_id',
        'emp_name',
        'email',
        'role',
        'department',
    ];
}
