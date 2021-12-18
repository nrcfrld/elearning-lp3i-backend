<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}
