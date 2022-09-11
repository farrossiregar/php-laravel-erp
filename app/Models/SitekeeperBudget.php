<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\SubRegion;

class SitekeeperBudget extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'sitekeeper_budget';

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function region()
    {
        return $this->hasOne(Region::class,'id','region');
    }

    public function sub_region()
    {
        return $this->belongsTo(SubRegion::class,'subregion','id');
    }
}
