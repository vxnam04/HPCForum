<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateContact extends Model
{
    protected $table = "candidate_contact";
    protected $fillable = ['id','del_flag','candidate_id','cantact_id','value','created-by','modified-by','create_at','updated_at'] ;
}
