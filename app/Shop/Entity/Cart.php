<?php
// 檔案位置：app/Shop/Entity/Cart.php

namespace App\Shop\Entity;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
    protected $table = 'carts';
    protected $primaryKey = 'cid';
    protected $fillable = [
        "cid",
        "uid",
        "pid",
        "quantity",
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'pid');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
}
