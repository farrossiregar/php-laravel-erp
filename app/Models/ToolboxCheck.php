<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Toolbox;

class ToolboxCheck extends Model
{
    use HasFactory;

    protected $table = 'toolbox_check';

    public function toolbox()
    {
        return $this->belongsTo(Toolbox::class,'toolbox_id');
    }
}
