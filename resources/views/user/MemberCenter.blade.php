<!DOCTYPE html>
<html>
@extends('layout.master') 

@section('content')

<section id="content">
    <div style="margin-bottom: 50px; "></div>
    <div class="title">
        <div class="fancy-title title-center title-border mt-6">
            <h2><b>會員中心</b></h2>
        </div>
    </div>
    @if ( !(session()->has('user_id')) )
    <h4>您尚未登入</h4>
    <a href="{{asset('user/signup')}}">Sign up</a> or <a href="{{asset('user/login')}}">Login</a>
    @else
	<div class="content-wrap">
		<div class="container">

			<div class="grid-filter-wrap">

				<!-- Portfolio Filter
				============================================= -->
				<ul class="grid-filter style-4" data-container="#portfolio">
                    <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>
                    <li ><a href="#" data-filter=".f-info">基本資料</a></li>
                    <li><a href="#" data-filter=".f-buy">購買紀錄</a></li>
				</ul><!-- .grid-filter end -->

				<div class="grid-shuffle rounded" data-container="#portfolio">
					<i class="uil uil-sync"></i>
				</div>

			</div>

			<!-- Portfolio Items
			============================================= -->
			<div id="portfolio" class="portfolio row grid-container">
                <article class="f-info">
                    <p>目前登入帳號：{{ $User->username }}</p>
                        @if( $User->type == 'G')
                        <p>type：一般使用者</p>
                        @else
                        <p>type：管理員</p>
                        @endif
                    <div class="divider"><i class="bi-circle-fill"></i></div>
                </article>

                <article class="f-buy">
                    @if(empty($allOrderItems))
                    <h4>無歷史訂單</h4>
                    @else
                    @foreach($Orders as $Order)
                    <div class="col-md-12">
                        <h4>訂單{{ $Order->oid }}</h4>
                        <ul class="iconlist iconlist-sm">
                            <li><i class="bi-play-fill"></i> <span> 訂單總金額：${{ number_format($Order->total,0) }}</span></li>
                            <li><i class="bi-play-fill"></i> <span> 商品總數：{{ $Order->total_quantity }}</span></li>
                            <li><i class="bi-play-fill"></i> <span> 訂購時間：{{ $Order->order_date }}</span></li>
                            <li><i class="bi-play-fill"></i> <span> 訂單狀態：
                                                                    @switch( $Order->state )
                                                                        @case(1)
                                                                            <span>準備中</span>
                                                                            @break
                                                                        @case(2)
                                                                            <span style="color: green;">完成</span>
                                                                            @break
                                                                        @case(3)
                                                                            <span style="color: red;">取消</span>
                                                                            @break
                                                                        @default:
                                                                            <span>?</span>
                                                                    @endswitch
                                                            </span>
                            </li>
                            <div class="col-lg-6 mt-3">
                                <table class="table">
                                    <tbody>
                                    @foreach($allOrderItems as $item)
                                    @if($item['order_number'] == $Order->order_number)
                                        <tr>
                                            <td></td>
                                            <td>#</td>
                                            <td>{{ $item['product']['name'] }}</td>
                                            <td>{{ $item['quantity'] }}個</td>
                                            <td>${{ $item['quantity'] * number_format($item['price'], 0) }}</td>
                                        </tr>
                                    @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </ul>
                    </div>
                    <div class="divider"><i class="bi-circle-fill"></i></div>
                    @endforeach
                    @endif
                </article>
			</div><!-- #portfolio end -->

		</div>
	</div>
    @endif
</section>

@endsection
</html>