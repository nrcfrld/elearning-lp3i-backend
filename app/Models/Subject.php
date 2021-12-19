<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function lecture() {
        return $this->belongsTo(User::class, "lecture_id");
    }

    public function participants(){
        return $this->belongsToMany(User::class, 'subject_participants', 'user_id');
    }
}
