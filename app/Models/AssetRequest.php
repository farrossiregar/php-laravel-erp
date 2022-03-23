<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class AssetRequest extends Model
{
    use HasFactory;

    protected $table = 'asset_request';

}
