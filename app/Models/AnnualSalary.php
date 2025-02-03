<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnnualSalary extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'annual_salary';
    protected $dates = ['deleted_at'];

    protected $guarded = [];
}
