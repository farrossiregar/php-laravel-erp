<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulesItem extends Model
{
    use HasFactory;

    public function func()
    {
        return $this->hasMany('\App\Models\ModulesItem','parent_id','id');
    }

    public function client_project()
    {
        return $this->belongsTo(\App\Models\ClientProject::class);
    }
}
