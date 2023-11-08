<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\UserTrait;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail{
    use HasApiTokens, HasFactory, Notifiable, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rejected_at'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function profile(){
        return $this->hasOne(UserProfile::class);
    }

    public function isAdmin(){
      return $this->roles->contains('name', 'admin');
    } 

    public function isTeacher(){
        return $this->teacher !== null;
    }
    public function teacher(){
        return $this->hasOne(Teacher::class);
    }

    public function scopePending(Builder $query){
         $query->whereNotNull('email_verified_at')
         ->whereNull('rejected_at')
         ->whereHas('teacher',function($query){
            $query->where('status','pending');
         });
    }

    public function scopeTeachers(Builder $query){

        $query->whereHas('teacher',function($query){

            $query->where('status','active');
        });
    }


}
