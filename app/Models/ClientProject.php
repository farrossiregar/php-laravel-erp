<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProject extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }
}
