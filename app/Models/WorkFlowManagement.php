<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Cluster;

class WorkFlowManagement extends Model
{
    use HasFactory;

    public function coordinator()
    {
        return $this->belongsTo(Employee::class,'coordinator_id');
    }

    public function sm()
    {
        return $this->belongsTo(Employee::class,'sm_id');
    }

    public function osm()
    {
        return $this->belongsTo(Employee::class,'osm_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }
}
