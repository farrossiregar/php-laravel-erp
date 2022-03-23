<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrainingMaterialGroupEmployee;

class TrainingMaterialGroup extends Model
{
    use HasFactory;

    protected $table = 'training_material_group';

    public function employee()
    {
        return $this->hasMany(TrainingMaterialGroupEmployee::class,'training_material_group_id');
    }
}
