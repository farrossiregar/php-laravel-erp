<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class ToolsCheck extends Model
{
    use HasFactory;

    protected $table = 'tools_check';

    public function _employee()
    {
        return $this->hasOne(Employee::class, 'employee_id');
    }
}
