<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrainingMaterialGroup;

class TrainingMaterial extends Model
{
    use HasFactory;

    protected $table  = 'training_material';

    public function group()
    {
        return $this->hasOne(TrainingMaterialGroup::class,'id','training_material_group_id');
    }
}
