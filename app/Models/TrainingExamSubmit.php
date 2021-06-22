<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrainingExam;

class TrainingExamSubmit extends Model
{
    use HasFactory;

    protected $table = 'training_exam_submit';

    public function soal()
    {
        return $this->belongsTo(TrainingExam::class,'training_exam_id','id');
    }
}
