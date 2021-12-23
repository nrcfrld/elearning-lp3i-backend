<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['document_url'];

    public function meet()
    {
        return $this->belongsTo(meet::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function getDocumentUrlAttribute(){
        if(!$this->document){
            return null;
        }
        return asset(Storage::url($this->document));
    }
}
