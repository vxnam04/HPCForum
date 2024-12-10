<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewComment extends Model
{
    protected $table = "candidate";
    protected $fillable = ['id','del_flag','interview_id','comment','rating','created_by','modified_by','created_at'] ;
}
