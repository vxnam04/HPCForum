<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'baiviet';
    protected $primaryKey = 'baiVietID';
    public $incrementing = true;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'baiVietID',
        'tieuDe',
        'noiDung',
        'ngayDang',
        'soLike',
        'soBinhLuan',
        'trangThaiDuyet',
        'userID',
    ];
    public function comments()
{
    return $this->hasMany(Comment::class, 'baiVietID');
}

}
