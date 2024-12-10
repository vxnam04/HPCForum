<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateSkill extends Model
{
    protected $table = "candidtae_skill";
    protected $fillable = ['id','del_flag','candidate_id','skill_id','created_by','modified_by','created_at','update_at'];
}