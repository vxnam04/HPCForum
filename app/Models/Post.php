<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts'; // Tên bảng trong CSDL
    protected $fillable = ['title', 'content']; // Các cột có thể gán giá trị hàng loạt
}
