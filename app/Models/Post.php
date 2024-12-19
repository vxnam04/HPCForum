<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'baiviet';
    protected $primaryKey = 'baiVietID';
    public $incrementing = false;
    protected $keyType = 'string';

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
        return $this->hasMany(Binhluan::class);
    }
}
