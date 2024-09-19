<!DOCTYPE html>
<html>
@extends('layout.master') 

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<section id="content">
	<div class="title">
		<div class="fancy-title title-center title-border mt-6">
			<h2><b>購物車</b></h2>
		</div>
	</div>
	<div class="content-wrap">
		<div class="container">
        @include('errorMessage')
			@if ( !( session()->has('user_id') ))
				<h4>您尚未登入&nbsp
					<a href="{{asset('user/account')}}">Register or Login</a>
				</h4>
			@elseif( empty($total) )
				<h4>購物車中沒有商品。
					<a href="{{asset('/product/menu')}}">前往產品目錄</a>
				</h4>
			@else
			<table class="table cart mb-5">
				<thead>
					<tr>
                        <th class="cart-product-remove">刪除</th>
						<th class="cart-product-thumbnail">圖片</th>
						<th class="cart-product-name">商品名稱</th>
						<th class="cart-product-price">單價</th>
						<th class="cart-product-quantity">數量</th>
						<th class="cart-product-subtotal">總價</th>
					</tr>
				</thead>
				<tbody>
                    @foreach($Carts as $Cart)
					<tr class="cart_item">

                        <td class="cart-product-remove">
							<a href="{{ url('/cart/' . $Cart->cid . '/delete') }}" class="remove" title="Remove this item"><i class="fa-solid fa-trash"></i></a>
						</td>

						<td class="cart-product-thumbnail">
							<a href="#"><img width="64" height="64" src="{{ asset($Cart->product->img) }}" alt="image"></a>
						</td>

						<td class="cart-product-name">
							<span>{{ $Cart->product->name }}</span>
						</td>

						<td class="cart-product-price">
							<span class="amount">${{ $Cart->product->price }}</span>
						</td>

						<td class="cart-product-quantity">
							<div class="quantity">
								<input type="button" value="-" class="minus" data-pid="{{ $Cart->pid }}">
								<input type="text" name="quantity" value="{{ $Cart->quantity }}" class="qty" data-pid="{{ $Cart->pid }}">
								<input type="button" value="+" class="plus" data-pid="{{ $Cart->pid }}">
							</div>
						</td>

						<td class="cart-product-subtotal">
							<span class="amount">${{ $Cart->product->price * $Cart->quantity }}</span>
						</td>

					</tr>
                    @endforeach

                    <tr class="cart_item">
                        <td colspan="6">
                            <div class="row justify-content-end align-items-center py-2 col-mb-30">
                                <div class="col-lg-auto">
                                    <div class="row">
                                        <div class="col-md-auto text-end"><h4>Cart Totals</h4></div>
                                        <div class="col-md-auto text-end"><span class="amount color lead"><strong>${{$total}}</strong></span></div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
					
					<tr class="cart_item">
						<td colspan="6">
							<div class="row justify-content-between align-items-center py-2 col-mb-30">
								<div class="col-lg-auto ps-lg-0">
									<div class="row align-items-center">
										<div class="col-md-8">
                                            
										</div>
										<div class="col-md-4 mt-3 mt-md-0">
                                            
										</div>
									</div>
								</div>
								<div class="col-lg-auto pe-lg-0">
								<form action="/cart/submit" method="post">
									@csrf
									<button type="submit" class="button button-small button-3d mt-2 mt-sm-0 me-0 mb-0">送出訂單</button>
								</form>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			@endif
		</div>
	</div>
</section>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		// 更新購物車數量
		document.querySelectorAll('.quantity input').forEach(function (input) {
			input.addEventListener('change', function () {
				const pid = this.getAttribute('data-pid');
				const quantity = this.value;

				fetch('/cart/update', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
					},
					body: JSON.stringify({ pid: pid, quantity: quantity }),
				})
				.then(response => response.json())
				.then(data => {
					if (data.success) {
						// 更新成功，重新載入頁面或顯示成功消息
						location.reload();
					} else {
						// 顯示錯誤消息
						alert(data.message);
					}
				});
			});
		});
	});
</script>

@endsection
</html>