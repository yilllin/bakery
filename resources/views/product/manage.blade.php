<!DOCTYPE html>
<html>
@extends('layout.master') 

@section('content')
    <div class="container">
        @include('errorMessage')
        <div class="row">
            <div class="col-md-12">
                <div style="margin-bottom: 50px; "></div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><b>產品管理</b></h2>
                    <a href="{{ route('product.create') }}" class="button button-small text-end">
                        新增商品<i class="bi-arrow-right-circle-fill"></i>
                    </a>
                </div>
                
                <table class="table">
                    <tr>
                        <th>編號</th>
                        <th>名稱</th>
                        <th>型態</th>
                        <th>價格</th>
                        <th>圖片</th>
                        <th>編輯</th>
                        <th>刪除</th>
                    </tr>
                    
                    @foreach($Product as $Product_)
                        <tr>
                            <td> {{ $Product_->pid }}</td>
                            <td> {{ $Product_->name }}</td>
                            <td> {{ $Product_->type }}</td>
                            <td> ${{ $Product_->price }}</td>
                            <td>
                                <img width="100" height="100" src="{{ asset($Product_->img) }}" />
                            </td>
                            <td>
                                <a href="/product/{{ $Product_->pid }}/edit">
                                    <i class="bi-pencil-fill"></i>
                                </a>
                            </td>
                            <td>
                                <a href="/product/{{ $Product_->pid }}/delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <div>
                    <div class="pagination justify-content-center">
                        {{ $Product->links('pagination::bootstrap-4') }}
                    </div>
                    <div class="pagination-info text-center mb-3">
                        顯示第 {{ $Product->firstItem() }} - {{ $Product->lastItem() }} 筆，共 {{ $Product->total() }} 筆資料
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
@endsection 
</html>