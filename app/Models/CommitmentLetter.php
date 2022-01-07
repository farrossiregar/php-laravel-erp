<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Region;
use App\Models\ClientProject;

class CommitmentLetter extends Model
{
    use HasFactory;

    protected $table = 'commitment_letter';

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function region_()
    {
        return $this->belongsTo(Region::class,'region_id');
    }

    public function project_()
    {
        return $this->belongsTo(ClientProject::class,'project_id');
    }
}
