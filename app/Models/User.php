<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'identity_number',
        'birthplace',
        'gender',
        'phone_number',
        'address',
        'birthdate',
        'avatar',
        'classroom_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends= [
        'avatar_url',
        'role',
        'label'
    ];

    public function getAvatarUrlAttribute(){
        if(!$this->avatar){
            return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=7F9CF5&background=EBF4FF';
        }

        return Storage::url($this->avatar);
    }

    public function getRoleAttribute(){
        if(count($this->roles) > 0){
            return $this->roles[0];
        }

        return null;
    }

    public function getLabelAttribute(){
        return $this->identity_number . " - " . $this->name;
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}
