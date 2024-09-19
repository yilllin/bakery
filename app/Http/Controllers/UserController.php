<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Shop\Entity\User;
use App\Shop\Entity\Order;
use App\Shop\Entity\Order_item;
use Hash;

class UserController extends Controller
{
    //登入 註冊
    public function SignUp_Login_Page()
    {
        return view('user.account');
    }

    //註冊處理
    public function SignUpProcess()
    {
        $form_data = request()->all();
        if ( $form_data['password'] == "" || $form_data['username'] == "" || $form_data['repassword'] == "" ) {
            return redirect('/user/account#tab-register')
            ->withInput()
            ->withErrors(['資料不齊全，請檢查所有欄位都填滿']);
        }

        // 密碼確認
        if($form_data['password'] !== $form_data['repassword']){
            return redirect('/user/account#tab-register')
            ->withInput()
            ->withErrors(['密碼與確認密碼不一致']);

        }

        #判斷帳號是否存在
        $user = User::where('username', $form_data['username'])->first();
        if (!is_null($user)){
            return redirect('/user/account#tab-register')
            ->withInput()
            ->withErrors(['此帳號名稱已被註冊，請使用其他名稱註冊']);
        }

        //密碼加密
        $form_data['password'] = Hash::make($form_data['password']);
        $form_data['repassword'] = Hash::make($form_data['repassword']);
        //dd($form_data);
        $user = User::create($form_data);

        return redirect('/user/account#tab-login')
            ->with('success', '註冊成功，請登入您的帳戶！');
        
    }
    
    //登入處理
    public function LoginProcess(){
        $form_data = request()->all();
        // dd($form_data);
        $user = User::where('username', $form_data['username'])->FirstOrFail();
        if (Hash::check($form_data['password'], $user->password)){
            echo '登入成功';
            session()->put('user_id', $user->uid);
            session()->put('user_name', $user->username);
            session()->put('user_type', $user->type);
            # 導向到首頁
            return redirect('/index');
        }else{
            echo '登入失敗';
             # 導向回登入頁
             return redirect('/user/account#tab-login')
             ->withInput()
             ->withErrors(['無此帳號或帳號密碼錯誤']);
        }
    }

    //登出
    public function SignOut()
    {
        session()->forget('user_id');
        return redirect('/index');
    }

    //會員中心
    public function MemberCenter(){
        $userId = session('user_id');
        $User = User::findOrFail($userId);
        $username = $User->username;

        $Orders = Order::where('uid', $userId)->get();

        $allOrderItems = [];
        foreach ($Orders as $Order) {
            $order_number = $Order->order_number;
            $Order_items = Order_item::where('order_number', $order_number)->with('product')->get();
            $allOrderItems = array_merge($allOrderItems, $Order_items->toArray());
        }

        $binding = [
            'User'          => $User,
            'Orders'        => $Orders,
            'allOrderItems'   => $allOrderItems,
        ];
        return view('user.MemberCenter', $binding);
    }

    //管理中心
    public function ManagementCenter(){
        $row_per_page = 10;
        $Users = User::OrderBy('uid', 'asc')->paginate($row_per_page);

        $Orders = Order::OrderBy('oid', 'asc')->with('user')->paginate($row_per_page);
        $Order_items = Order_item::OrderBy('item_id', 'asc')->get();
        //dd($Orders);

        $binding = [
            'Users'=> $Users,
            'Orders'=> $Orders,
            'Order_items'=> $Order_items,
        ];
        
        return view('user.ManagementCenter', $binding);
    }

    // 修改訂單狀態
    public function OrderState($oid, $stype){
        $Order = Order::find($oid);

        if ($Order) {
            $Order->state = $stype;
            $Order->save();
        } else {
            return redirect('/user/ManagementCenter')
             ->withErrors(['修改訂單狀態失敗']);
        }

        return redirect('/user/ManagementCenter');
    }
}
