<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class DrugTest extends Model
{
    use HasFactory;

    protected $table = 'drug_test';

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public function head()
    {
        return $this->hasOne(Employee::class,'id','employee_pic_id');
    }
}
