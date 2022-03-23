<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class TrainingMaterialGroupEmployee extends Model
{
    use HasFactory;

    protected $table = 'training_material_group_employee';

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id','employee_id');
    }
}
