<?php
// 檔案位置：app/Shop/Entity/Cart.php

namespace App\Shop\Entity;


use Illuminate\Database\Eloquent\Model;

class Order_item extends Model {
    protected $table = 'order_items';
    protected $primaryKey = 'item_id';
    protected $fillable = [
        "order_number",
        "pid",
        "quantity",
        "price",
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'pid');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_number');
    }
}
