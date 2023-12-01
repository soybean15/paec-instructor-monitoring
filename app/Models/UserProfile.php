<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory,HasImage;

    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'birthdate',
        'gender',
        'contact_number',
        'image',
        'address',
        'user_id'
    ];

    protected $appends= ['full_name'];

    public function getFullNameAttribute(){

     //   $middlename = strtoupper(($this->middlename[0] . '.')) ?? '';

     $middlename = !empty($this->middlename) && trim($this->middlename) !== '' ? strtoupper($this->middlename[0] . '.') : '';



        return $this->lastname .', ' . $this->firstname. ' '.$middlename;


    }


    public function getImageAttribute($value){
        if($value){
            return asset('images/users/' . $value);
        }
        return asset('images/defaults/default_user.jpg');
    }
}
