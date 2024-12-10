<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configguration extends Model
{
    protected $table = "candidate";
    protected $fillable = ['id','del_flag','value','description','type','created_at','updated_at'] ;
}