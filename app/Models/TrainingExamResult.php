<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class TrainingExamResult extends Model
{
    use HasFactory;

    protected $table = 'training_exam_result';

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }
}
