<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

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



        return $this->lastname .' ' . $this->firstname. ' '.$middlename;


        



    }
}
