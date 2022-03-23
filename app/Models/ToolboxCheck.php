<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Toolbox;
use App\Models\ToolboxType;

class ToolboxCheck extends Model
{
    use HasFactory;

    protected $table = 'toolbox_check';

    public function toolbox()
    {
        return $this->belongsTo(Toolbox::class,'toolbox_id');
    }

    public function toolbox_type()
    {
        return $this->belongsTo(ToolboxType::class,'toolbox_type_id');
    }
}
