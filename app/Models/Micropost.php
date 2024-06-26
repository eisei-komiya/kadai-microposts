<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Micropost extends Model
{
    use HasFactory;

    protected $fillable = ['content','category_id'];

    /**
     * この投稿を所有するユーザー。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function favorite_users()
    {
        //(相手側のクラス,中間テーブル名,こっちがわのidに対応する中間テーブルのid名,相手側のidに対応する中間テーブルのid名)
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
