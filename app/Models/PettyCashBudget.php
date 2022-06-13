<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class PettyCashBudget extends Model
{
    use HasFactory;

    protected $table = 'petty_cash_budget';

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function sub_department()
    {
        return $this->belongsTo(DepartmentSub::class,'sub_department_id','id');
    }
}
