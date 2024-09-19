<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Shop\Entity\User;
use App\Shop\Entity\Product;
use App\Shop\Entity\Cart;
use App\Shop\Entity\Order;
use App\Shop\Entity\Order_item;
use Image;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //購物車頁面
    public function CartPage(){
        $userId = session('user_id');
        $Carts = Cart::where('uid', $userId)->with('product')->get();
        // dd($Carts);

        //計算總價
        $total = 0;
        $Carts->each(function($Cart) use (&$total) {
            $subtotal = $Cart->product->price * $Cart->quantity;
            $Cart->subtotal = $subtotal;
            $total += $subtotal;
        });

        $binding = [
            'Carts' => $Carts,
            'total' => $total,
        ];

        return view('cart.cart', $binding);
    }
    
    //新增商品到購物車處理
    public function CartAddProcess(Request $request)
    {
        $pid = $request->input('pid');
        //dd($pid);
        if(is_null(session('user_id'))){
            return response()->json(['success' => false, 'message' => '您尚未登入']);
        } else {
            $uid = session('user_id');

            Cart::create([
                'uid' => $uid,
                'pid' => $pid,
                'quantity' => 1,
            ]);

            return response()->json(['success' => true]);
        }
    }

    //購物車數量更新
    public function CartUpdateProcess(Request $request)
    {
        $pid = $request->input('pid');
        $quantity = $request->input('quantity');

        $cartItem = Cart::where('uid', session('user_id'))->where('pid', $pid)->first();

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => '商品不存在']);
        }
    }

    //購物車內商品刪除
    public function CartDeleteProcess($cid)
    {
        //dd($cid);
        $Cart = Cart::where('cid',$cid)->delete();
        return redirect('/cart');
    }

    //送出訂單
    public function CartSubmitProcess()
    {
        $userId = session('user_id');
        $Carts = Cart::where('uid', $userId)->with('product')->get();
        //dd($Carts);

        //計算總價 總數量
        $total = 0;
        $totalQuantity = 0;
        $Carts->each(function($Cart) use (&$total, &$totalQuantity) {
            $subtotal = $Cart->product->price * $Cart->quantity;
            $Cart->subtotal = $subtotal;
            $total += $subtotal;
            $totalQuantity += $Cart->quantity;
        });

        $order_number = uniqid('order_');

        Order::create([
            "order_number"      => $order_number,
            "uid"               => $userId,
            "total_quantity"    => $totalQuantity,
            "total"             => $total,
        ]);

        foreach($Carts as $Cart){
            Order_item::create([
                "order_number"  => $order_number,
                "pid"           => $Cart->pid,
                "quantity"      => $Cart->quantity,
                "price"         => $Cart->product->price,
            ]);
        }

        Cart::where('uid', $userId)->delete();
        
        return redirect('/user/MemberCenter');
    }
}

?>