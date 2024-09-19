<?php
// 檔案位置：app/Shop/Entity/User.php

namespace App\Shop\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // 資料表名稱
    protected $table = 'user';
    
    // 主鍵名稱
    protected $primaryKey = 'uid';
    
    // 可以大量指定異動的欄位（Mass Assignment）
    protected $fillable = [
        'username',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
