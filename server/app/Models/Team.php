<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = "candidate";
    protected $fillable = ['id','del_flag','name','leader','description',
    'created_by','modified_by','created_at','update_at'] ;
}
