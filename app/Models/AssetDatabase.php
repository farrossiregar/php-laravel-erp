<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\AssetsType;

class AssetDatabase extends Model
{
    use HasFactory;

    protected $table = 'asset_database';

    public function type()
    {
        return $this->belongsTo(AssetsType::class,'asset_type','id');
    }
}
