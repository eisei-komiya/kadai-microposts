<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount(['microposts', 'followings', 'followers', 'favorites']);
    }
    /**
     * このユーザーがフォロー中のユーザー。（Userモデルとの関係を定義）
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    /**
     * このユーザーをフォロー中のユーザー。（Userモデルとの関係を定義）
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow(int $userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    /**
     * $userIdで指定されたユーザーをアンフォローする。
     * 
     * @param  int $usereId
     * @return bool
     */
    public function unfollow(int $userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 指定された$userIdのユーザーをこのユーザーがフォロー中であるか調べる。フォロー中ならtrueを返す。
     * 
     * @param  int $userId
     * @return bool
     */
    public function is_following(int $userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function feed_microposts()
    {
        // このユーザーがフォロー中のユーザーのidを取得して配列にする
        $userIds = $this->followings()->pluck('users.id')->toArray();
        // このユーザーのidもその配列に追加
        $userIds[] = $this->id;
        // それらのユーザーが所有する投稿に絞り込む
        return Micropost::whereIn('user_id', $userIds);
    }
    
    //多対多関係定義と取得
    public function favorites()
    {
        //(相手側のクラス,中間テーブル名,こっちがわのidに対応する中間テーブルのid名,相手側のidに対応する中間テーブルのid名)
        return $this->belongsToMany(Micropost::class, 'favorites', 'user_id', 'micropost_id')->withTimestamps();
    }
    
    //お気に入りしてるかどうか
    public function is_favoriting(int $micropostId)
    {
        return $this->favorites()->where('micropost_id', $micropostId)->exists();
    }
    
    //お気に入り登録
    public function favorite(int $micropostId){
        $exist = $this->is_favoriting($micropostId);
        
        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($micropostId);
            return true;
        }
    }
    
    //お気に入り解除
    public function unfavorite(int $micropostId){
        $exist = $this->is_favoriting($micropostId);
        
        if ($exist) {
            $this->favorites()->detach($micropostId);
            return true;
        } else {
            return false;
        }
    }
    
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    
    public function postsByCategory()
    {
        return $this->microposts()
                    ->select('category_id', \DB::raw('count(*) as count'))
                    ->groupBy('category_id')
                    ->with('category')
                    ->orderBy('category_id')
                    ->get();
    }
    
    protected static function booted()
    {
        static::created(function ($user) {
            // ユーザー登録時にカテゴリを作成
            $defaultCategories = ['Default', 'Category1', 'Category2', 'Category3'];
            foreach ($defaultCategories as $categoryName) {
                $user->categories()->create([
                    'name' => $categoryName
                ]);
            }
        });
    }
}
