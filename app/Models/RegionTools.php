<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Region;

class RegionTools extends Model
{
    use HasFactory;

    protected $table = 'region_tools';

    public function pic()
    {
        return $this->belongsTo(Employee::class,'pic_id','id');   
    }
    
    public function sm()
    {
        return $this->belongsTo(Employee::class,'sm_id','id');   
    }

    public function region()
    {
        return $this->belongsTo(Region::class,'region_id','id');   
    }
}
