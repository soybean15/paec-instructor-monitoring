<?php

namespace App\Models;

use App\Traits\HasSubject;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    protected $fillable = ['user_id','department_id'];


    public function user(){

        return $this->belongsTo(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
        
    }

 


    public function scopePending(Builder $query){

        $query->where('status','pending');

    }

   

}
