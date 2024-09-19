<!DOCTYPE html>
@extends('layout.master') 

@section('content')

<!-- Content
============================================= -->
<section id="content">
	<div class="title">
		<div class="fancy-title title-center title-border mt-6">
			<h2><b>產品目錄</b></h2>
		</div>
	</div>
	<div class="content-wrap">
		<div class="container">

			<div class="row gx-5 col-mb-80">
				<!-- Post Content
				============================================= -->
				<main class="postcontent col-lg-9 order-lg-last">

					<!-- Shop
					============================================= -->
					<div id="shop" class="shop row grid-container gutter-20" data-layout="fitRows">
                        @foreach($Product as $Product_)
						<div class="product col-md-4 col-sm-6 sf-{{ $Product_->type }}">
							<div class="grid-inner">
								<div class="product-image">
									<a href="#"><img src="{{ asset($Product_->img) }}" alt="img"></a>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between">
											<a href="#" class="btn btn-dark me-2 add-to-cart" data-pid="{{ $Product_->pid }}" title="Add to Cart">
												<i class="bi-bag-plus"></i>
											</a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="product-desc">
									<div class="product-title"><h3><a href="#">{{ $Product_->name }}</a></h3></div>
									<div class="product-price">${{ $Product_->price }}</div>
								</div>
							</div>
						</div>
                        @endforeach

                        <div class="pagination justify-content-center">
                            {{ $Product->links('pagination::bootstrap-4') }}
                        </div>
						<div class="pagination-info text-center mb-3">
							顯示第 {{ $Product->firstItem() }} - {{ $Product->lastItem() }} 筆，共 {{ $Product->total() }} 筆資料
						</div>

					</div><!-- #shop end -->

				</main><!-- .postcontent end -->

				<!-- Sidebar
				============================================= -->
				<aside class="sidebar col-lg-3">
					<div class="sidebar-widgets-wrap">

						<div class="widget widget-filter-links">
							<h4><b>商品分類</b></h4>
							<ul class="custom-filter ps-2" data-container="#shop" data-active-class="active-filter">
								<li class="widget-filter-reset active-filter"><a href="#" data-filter="*">Clear</a></li>
								<li><a href="#" data-filter=".sf-B">麵包</a></li>
								<li><a href="#" data-filter=".sf-C">蛋糕</a></li>
								<li><a href="#" data-filter=".sf-D">中式點心</a></li>
							</ul>
						</div>

						<div class="widget widget-filter-links">
							<h4><b>排序方式</b></h4>
							<ul class="shop-sorting ps-2">
								<li class="widget-filter-reset active-filter"><a href="#" data-sort-by="original-order">Clear</a></li>
								<li><a href="#" data-sort-by="name">依商品名稱</a></li>
								<li><a href="#" data-sort-by="price_lh">價格: 由低到高</a></li>
								<li><a href="#" data-sort-by="price_hl">價格: 由高到低</a></li>
							</ul>
						</div>

					</div>
				</aside><!-- .sidebar end -->
			</div>

		</div>
	</div>
</section><!-- #content end -->
<script src="{{asset('js/jquery.js')}}"></script>
<script>
		jQuery(document).ready( function(){
			jQuery(window).on( 'pluginIsotopeReady', function(){
				jQuery('#shop').isotope({
					transitionDuration: '0.65s',
					getSortData: {
						name: '.product-title',
						price_lh: function( itemElem ) {
							if( jQuery(itemElem).find('.product-price').find('ins').length > 0 ) {
								var price = jQuery(itemElem).find('.product-price ins').text();
							} else {
								var price = jQuery(itemElem).find('.product-price').text();
							}

							priceNum = price.split("$");

							return parseFloat( priceNum[1] );
						},
						price_hl: function( itemElem ) {
							if( jQuery(itemElem).find('.product-price').find('ins').length > 0 ) {
								var price = jQuery(itemElem).find('.product-price ins').text();
							} else {
								var price = jQuery(itemElem).find('.product-price').text();
							}

							priceNum = price.split("$");

							return parseFloat( priceNum[1] );
						}
					},
					sortAscending: {
						name: true,
						price_lh: true,
						price_hl: false
					}
				});

				jQuery('.custom-filter:not(.no-count)').children('li:not(.widget-filter-reset)').each( function(){
					var element = jQuery(this),
						elementFilter = element.children('a').attr('data-filter'),
						elementFilterContainer = element.parents('.custom-filter').attr('data-container');

					elementFilterCount = Number( jQuery(elementFilterContainer).find( elementFilter ).length );

					element.append('<span>'+ elementFilterCount +'</span>');
				});

				jQuery('.shop-sorting li').click( function() {
					jQuery('.shop-sorting').find('li').removeClass( 'active-filter' );
					jQuery(this).addClass( 'active-filter' );
					var sortByValue = jQuery(this).find('a').attr('data-sort-by');
					jQuery('#shop').isotope({ sortBy: sortByValue });
					return false;
				});
			});
		});

		//加入購物車
		document.addEventListener('DOMContentLoaded', function () {
			document.querySelectorAll('.add-to-cart').forEach(button => {
				button.addEventListener('click', function (e) {
					e.preventDefault(); // 防止頁面刷新
					var pid = this.getAttribute('data-pid');
					
					// 發送 AJAX 請求到對應的 cart.add 路徑
					fetch('{{ route('cart.add') }}', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF 保護
						},
						body: JSON.stringify({ pid: pid })
					})
					.then(response => {
						if (!response.ok) {
							throw new Error('HTTP error ' + response.status);
						}
						return response.json(); // 確保返回 JSON 數據
					})
					.then(data => {
						if (data.success) {
							alert('商品已加入購物車');
						} else {
							alert(data.message || '加入購物車失敗');
						}
					})
					.catch(error => {
						console.error('Error:', error);
					});
				});
			});
		});

	</script>
@endsection
</html>
