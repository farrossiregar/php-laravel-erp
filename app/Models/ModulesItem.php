<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModuleGroup;
use App\Models\ClientProject;

class ModulesItem extends Model
{
    use HasFactory;

    public function func()
    {
        return $this->hasMany('\App\Models\ModulesItem','parent_id','id');
    }

    public function client_project()
    {
        return $this->belongsTo(ClientProject::class);
    }

    public function group()
    {
        return $this->belongsTo(ModuleGroup::class,'module_group_id','id');
    }
}
