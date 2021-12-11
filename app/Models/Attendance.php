<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function meet()
    {
        return $this->belongsTo(meet::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
