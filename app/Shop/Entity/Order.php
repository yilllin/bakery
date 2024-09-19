<?php
// 檔案位置：app/Shop/Entity/Order.php

namespace App\Shop\Entity;


use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $table = 'orders';
    protected $primaryKey = 'oid';
    protected $fillable = [
        "order_number",
        "uid",
        "total_quantity",
        "total",
        "order_date",
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
    public function order_item()
    {
        return $this->belongsTo(Order_item::class, 'order_number');
    }
}
