<?php
// 檔案位置：app/Shop/Entity/Product.php

namespace App\Shop\Entity;


use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    // 資料表名稱
    protected $table = 'product';
    // 主鍵名稱
    protected $primaryKey = 'pid';
    // 可以大量指定異動的欄位（Mass Assignment）
    protected $fillable = [
        "name",
        "type",
        "price",
        "img",
    ];
}