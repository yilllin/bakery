<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Shop\Entity\Product;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    // 產品目錄
    public function Menu(){
        $row_per_page = 9;
        $Product = Product::OrderBy('pid', 'asc')->paginate($row_per_page);

        $binding = [
            'Product'=> $Product,
        ];

        return view('product.menu', $binding);
    }

    // 產品管理 清單檢視
    public function ProductManage()
    {
        $row_per_page = 10;
        $Product = Product::OrderBy('pid', 'desc')->paginate($row_per_page);

        $binding = [
            'Product'=> $Product,
        ];

        return view('product.manage', $binding);
    }

    // 新建產品
    public function ProductCreate()
    {
        // 建立商品基本資訊
        $product_data = [
            'name'    => '',    // 名稱
            'type'    => '',    // 類型
            'price'   => 0 ,    // 價格
            'img'     => null,  // 照片
        ];
        $Product = Product::create($product_data);
        
        // 導向至商品編輯頁
        return redirect('/product/' . $Product->pid . '/edit');
    }

    // 產品編輯
    public function ProductEdit($pid){
        $Product = Product::where('pid', $pid)->first();
        //dd($Product);
        $binding = [
            'Product' => $Product,
        ];
        return view('product.edit', $binding);
    }

    // 商品資料更新處理
    public function ProductEditProcess($pid)
    {
        $Product = Product::findOrFail($pid);
        $input = request()->all();
        //dd($input);

        if ( $input['name'] == '' || $input['type'] == '' || $input['price'] == '' ) {
            // 資料驗證錯誤
            return redirect('/product/' . $Product->pid . '/edit')
                ->withErrors(['資料不齊全，請檢查所有欄位都填滿'])
                ->withInput();
        }

        if (isset($input['img'])){
            // 有上傳圖片
            $img = $input['img']; // 獲取上傳的圖片檔案
            $file_extension = $img->getClientOriginalExtension(); // 獲取檔案的副檔名
            $file_name = uniqid() . '.' . $file_extension; // 產生自訂隨機檔案名
           
            $file_relative_path = 'images/product/'; // 設定檔案儲存的相對路徑
            $file_path = public_path($file_relative_path); // 檔案存放目錄為對外公開 public 目錄下的相對位置(絕對路徑)

            $image = Image::make($img->getRealPath()); // 裁切圖片
            $image->fit(600, 600); // 設定裁切的尺寸

            $img -> move($file_path, $file_name); //檔案移動到指定的目錄
            $input['img'] = $file_relative_path.$file_name; // 設定圖片檔案相對位置
        }
        
        if(empty($Product['img']) && empty($input['img'])){
            // 如果沒有上傳圖片，使用預設圖片
            $file_relative_path = 'images/product/';
            $default_image = 'empty.png'; // 預設圖片檔案
            $input['img'] = $file_relative_path . $default_image; // 設定預設圖片檔案相對位置
        }

        // 商品資料更新
        $Product->update($input);

        // 重新導向到商品管理頁
        return redirect('product/manage');
    }

    // 產品資料刪除
    public function ProductDeleteProcess($pid)
    {
        $Product = Product::where('pid',$pid)->delete();
        return redirect('/product/manage');
    }
}

?>