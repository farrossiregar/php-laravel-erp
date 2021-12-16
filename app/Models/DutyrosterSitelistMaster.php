<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientProject;
use App\Models\Employee;

class DutyrosterSitelistMaster extends Model
{
    use HasFactory;
    protected $table = 'dutyroster_sitelist_master';

    public function project()
    {
        return $this->belongsTo(ClientProject::class,'client_project_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
