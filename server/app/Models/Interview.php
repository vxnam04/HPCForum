<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $table = "candidate";
    protected $fillable = ['id','del_flag','status','evaluation','position_id','date','note','created_by','modified_by','created_at','updated_at'] ;
}
