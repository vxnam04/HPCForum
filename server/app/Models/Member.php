<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "candidate";
    protected $fillable = ['id','del_flag','usename','password','fullname','is_male','birthday','email','phone','picture','access_level','created_by','modified_by','created_at','update_at'] ;
    protected $hidden = [
        'password'
    ];
}
