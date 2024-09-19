<!DOCTYPE html>
<html>
@extends('layout.master') 

@section('content')
<div class="container">
        @include('errorMessage')
        <div class="row">
            <div class="col-md-12">
                <div class="accordion accordion-lg mx-auto mb-0" style="max-width: 1200px;">
                <div style="margin-bottom: 50px; "></div>
                    
                    <div class="fancy-title title-border title-center">
						<h2><b>商品編輯</b></h2>
					</div>
                    <form action="/product/{{ $Product->pid }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="pid">產品編號(自動產生)</label>
                                    <input type="text"
                                        class="form-control"
                                        id="pid"
                                        name="pid"
                                        value="{{ $Product->pid }}"
                                        readonly
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="name">產品名稱</label>
                                    <input type="text"
                                        class="form-control"
                                        id="name"
                                        name="name"
                                        placeholder="產品名稱"
                                        value="{{ old('name', $Product->name) }}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="price">價格</label>
                                    <input type="number"
                                        class="form-control"
                                        id="price"
                                        name="price"
                                        placeholder="價格"
                                        min="0"
                                        step="1"
                                        value="{{ old('price', $Product->price) }}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="type">產品分類</label><br>
                                    <div class="btn-group d-flex" role="group">
                                        <input type="radio" class="btn-check required valid" name="type" id="type_bread" value="B"
                                            {{ old('type', $Product->type) == 'B' ? 'checked' : '' }}>
                                        <label for="type_bread" class="btn btn-outline-dark font-body ls-0 text-transform-none">麵包</label>

                                        <input type="radio" class="btn-check required valid" name="type" id="type_cake" value="C"
                                            {{ old('type', $Product->type) == 'C' ? 'checked' : '' }}>
                                        <label for="type_cake" class="btn btn-outline-dark font-body ls-0 text-transform-none">蛋糕</label>

                                        <input type="radio" class="btn-check required valid" name="type" id="type_pastry" value="D"
                                            {{ old('type', $Product->type) == 'D' ? 'checked' : '' }}>
                                        <label for="type_pastry" class="btn btn-outline-dark font-body ls-0 text-transform-none">中式點心</label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 d-flex flex-column justify-content-between">

                                <div class="form-group">
                                    <label for="img">商品圖片</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img width='150' height='150' src="{{ asset($Product->img) }}" />
                                        </div>
                                        <div class="col-md-8">
                                            <input type="file"
                                                class="form-control"
                                                id="img"
                                                name="img"
                                                placeholder="商品圖片"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right mt-auto text-end">
                                    <button type="submit" class="btn btn-secondary">更新</button>
                                </div>

                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
</div>
@endsection 
</html>