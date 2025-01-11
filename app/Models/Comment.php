<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
// Model: Comment // Tên bảng (nếu không tuân theo chuẩn đặt tên của Laravel)
    protected $table = 'comments';

    // Các cột được phép gán giá trị
    protected $fillable = ['baiVietID', 'user_id', 'noi_dung'];


    // Quan hệ với bảng Post
    public function post()
    {
        return $this->belongsTo(Post::class, 'bai_viet_id');
    }

    // Quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
