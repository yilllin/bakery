<!DOCTYPE html>
<html>
@extends('layout.master') 

@section('content')
<section id="content">

    <div class="title">
		<div class="fancy-title title-center title-border mt-6">
			<h2><b>管理中心</b></h2>
		</div>
	</div>

    <div class="content-wrap">
		<div class="container">
        @if ( session()->has('user_id') && session('user_type') == 'A')
            <div class="grid-filter-wrap">
                <ul class="grid-filter style-4" data-container="#portfolio">
                    <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>
                    <li ><a href="#" data-filter=".f-user">會員</a></li>
                    <li><a href="#" data-filter=".f-order">訂單</a></li>
                </ul>
                <div class="grid-shuffle rounded" data-container="#portfolio">
                    <i class="uil uil-sync"></i>
                </div>
            </div>

            <div id="portfolio" class="portfolio row grid-container">
                <article class="f-user">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>type</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Users as $User)
                            <tr>
                            <td>{{ $User->uid }}</td>
                            <td>{{ $User->type }}</td>
                            <td>{{ $User->username }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <div class="pagination justify-content-center">
                            {{ $Users->links('pagination::bootstrap-4') }}
                        </div>
                        <div class="pagination-info text-center mb-3">
                            顯示第 {{ $Users->firstItem() }} - {{ $Users->lastItem() }} 筆，共 {{ $Users->total() }} 筆資料
                        </div>
                    </div>
                    <div class="divider"></div>
                </article>

                <article class="f-order">
                    @include('errorMessage')
                    @if(empty($Order_items))
                        <h4>無歷史訂單</h4>
                    @else
                    @foreach($Orders as $Order)
                        <div class="col-md-12">
                            <h4>訂單{{ $Order->oid }}</h4>
                            <ul class="iconlist iconlist-sm">
                                <li><i class="bi-play-fill"></i> 
                                    <span><b>訂單狀態：
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
                                        &nbsp
                                    </b>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            訂單狀態
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item updateStatus" href="{{ url('/user/orderstate/' . $Order->oid .'/'. 1 ) }}">準備中</a>
                                            <a class="dropdown-item updateStatus" href="{{ url('/user/orderstate/' . $Order->oid .'/'. 2 ) }}">完成</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item updateStatus" href="{{ url('/user/orderstate/' . $Order->oid .'/'. 3 ) }}">取消</a>
                                        </div>
                                    </div>
                                    </span>
                                </li>
                                <li><i class="bi-play-fill"></i> <span><b>訂單編號：{{ $Order->order_number }}</b></span></li>
                                <li><i class="bi-play-fill"></i> <span><b>訂購人：{{ $Order->user->username }}</b></span></li>
                                <li><i class="bi-play-fill"></i> <span>訂單總金額：${{ number_format($Order->total,0) }}</span></li>
                                <li><i class="bi-play-fill"></i> <span>商品總數：{{ $Order->total_quantity }}</span></li>
                                <li><i class="bi-play-fill"></i> <span>訂購時間：{{ $Order->order_date }}</span></li>
                                <div class="col-lg-6 mt-3">
                                    <table class="table">
                                        <tbody>
                                        @foreach($Order_items as $item)
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
                    @endforeach
                    <div>
                        <div class="pagination justify-content-center">
                            {{ $Orders->links('pagination::bootstrap-4') }}
                        </div>
                        <div class="pagination-info text-center mb-3">
                            顯示第 {{ $Orders->firstItem() }} - {{ $Orders->lastItem() }} 筆，共 {{ $Orders->total() }} 筆資料
                        </div>
                    </div>
                    @endif
                    <div class="divider"></div>
                </article>
            </div>
        @else
            <h4>
                您不允許查看此頁面&nbsp
                <a href="{{asset('/index')}}">點我回首頁</a>
            </h4>
        @endif
        </div>
    </div>
</section>
@endsection
</html>