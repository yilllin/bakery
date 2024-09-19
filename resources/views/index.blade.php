<!DOCTYPE html>
@extends('layout.master') 

@section('content')
<section id="slider" class="slider-element slider-parallax swiper_wrapper min-vh-60 min-vh-md-100 include-header">
			<div class="slider-inner">

				<div class="swiper-container swiper-parent">
					<div class="swiper-wrapper">
						<div class="swiper-slide dark">
							<div class="container">
								<div class="slider-caption slider-caption-center">
									<h2 data-animate="fadeInUp">Welcome to Bakery</h2>
									<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">香氣四溢的手作烘焙，給您溫暖的甜蜜時光</p>
								</div>
							</div>
							<div class="swiper-slide-bg" style="background-image: url('images/1.jpg');"></div>
						</div>
						<div class="swiper-slide dark">
							<div class="container">
								<div class="slider-caption slider-caption-center">
									<h2 data-animate="fadeInUp">Welcome to Bakery</h2>
									<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">香氣四溢的手作烘焙，給您溫暖的甜蜜時光</p>
								</div>
							</div>
							<div class="swiper-slide-bg" style="background-image: url('images/2.jpg');"></div>
						</div>
					</div>
					<div class="slider-arrow-left"><i class="uil uil-angle-left-b"></i></div>
					<div class="slider-arrow-right"><i class="uil uil-angle-right-b"></i></div>
					<div class="slide-number"><div class="slide-number-current"></div><span>/</span><div class="slide-number-total"></div></div>
				</div>

			</div>
		</section>
        
    <body>
	<section id="content">
		<div class="content-wrap" id="about">

			<div class="promo promo-full promo-border p-5 header-stick mb-6">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-12 col-lg">
							<h3>香氣四溢的手作烘焙，給您溫暖的甜蜜時光</h3>
							<span>每一份糕點都用心製作，選用新鮮食材，為您帶來家的味道，讓每一口都充滿幸福感。</span>
						</div>
						<div class="col-12 col-lg-auto mt-4 mt-lg-0">
							<a href="{{ asset('/product/menu') }}" class="button button-reveal button-large button-circle button-black text-end m-0"><i class="uil uil-angle-right-b"></i><span>查看產品</span></a>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="title">
					<div class="fancy-title title-left title-border mt-6">
						<h2><b>關於我們</b></h2>
					</div>
				</div>
				<br/><br/>
				<div class="row col-mb-50 mb-0">
					<div class="col-lg-4">
						<div class="heading-block fancy-title border-bottom-0 title-bottom-border">
							<h4>天然食材，無負擔享受</h4>
						</div>
						<p>我們堅持選用天然、新鮮的食材，無添加人工色素或防腐劑，讓您每一口都能安心享用健康美味。</p>
					</div>
					<div class="col-lg-4">
						<div class="heading-block fancy-title border-bottom-0 title-bottom-border">
							<h4>手工製作，滿載心意</h4>
						</div>
						<p>每一道甜點皆由我們的烘焙師親手製作，注入細膩的心思與滿滿的愛，傳遞獨特的溫度與風味。</p>
					</div>
					<div class="col-lg-4">
						<div class="heading-block fancy-title border-bottom-0 title-bottom-border">
							<h4>創新口味，驚喜無限</h4>
						</div>
						<p>我們不斷追求創新與突破，結合傳統與現代口味，為您帶來無限的味覺驚喜，滿足不同的甜點偏好。</p>
					</div>
				</div>
			</div>

		</div>
	</section>
    </body>
@endsection
</html>
