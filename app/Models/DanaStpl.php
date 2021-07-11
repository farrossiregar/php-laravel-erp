<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanaStpl extends Model
{
    use HasFactory;
    protected $table = 'dana_stpl_master';

    public function sm_name()
    {
        return $this->hasOne(Employee::class,'id','project_manager_id');
    }

}
