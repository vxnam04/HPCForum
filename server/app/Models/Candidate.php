<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = "candidate";
    protected $fillable = ['id','del_flag','name','is_male','birthday','cv','is_passed',
    'university_id','created_by','modified_by','created_at','updated_at'] ;
}
