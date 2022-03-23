<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class AccidentReport extends Model
{
    use HasFactory;

    protected $table = 'accident_report';

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
