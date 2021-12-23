<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['is_present'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function getIsPresentAttribute()
    {
        foreach($this->attendances as $attendance){
            if($attendance->user_id == auth()->user()->id && $attendance->status == "tidak hadir"){
                return false;
            }
            return true;
        }
    }
}
