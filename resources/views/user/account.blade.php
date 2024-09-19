<!DOCTYPE html>
<html>
@extends('layout.master') 

@section('content')
<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container">
		@if ( !(session()->has('user_id')) )
			<div class="mx-auto mb-0" id="tab-login-register" style="max-width: 500px;">

				<ul class="nav canvas-alt-tabs2 tabs nav-pills justify-content-center mb-3" id="canvas-tab-nav2" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="tab-login-tab" data-bs-toggle="pill" data-bs-target="#tab-login"
							type="button" role="tab" aria-controls="tab-login" aria-selected="true">登入</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="tab-register-tab" data-bs-toggle="pill" data-bs-target="#tab-register" type="button"
							role="tab" aria-controls="tab-register" aria-selected="false">註冊</button>
					</li>
				</ul>

                @include('errorMessage')

                @if (session('success'))
                    <div class="alert bg-transparent text-success border-success">
                        <i class="bi-person-fill-check"></i> <strong>{{ session('success') }}</strong>
                    </div>
                @endif
				
                <div class="tab-content">
					<div class="tab-pane show active" id="tab-login" role="tabpanel" aria-labelledby="canvas-tab-login-tab" tabindex="0">
						<div class="card mb-0">
							<div class="card-body" style="padding: 40px;">
								<form id="login-form" name="login-form" class="mb-0" action="/user/login" method="post">
                                @csrf
									<h3><b>立即登入</b></h3>

									<div class="row">
										<div class="col-12 form-group">
											<label for="username">帳號：</label>
											<input type="text" id="username" name="username" value="" class="form-control">
										</div>

										<div class="col-12 form-group">
											<label for="password">密碼：</label>
											<input type="password" id="password" name="password" value="" class="form-control">
										</div>

										<div class="col-12 form-group">
											<div class="d-flex justify-content-end">
												<button class="button button-3d button-black m-0" id="login-form-submit" name="login-form-submit" value="login">登入</button>
											</div>
										</div>
									</div>

								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="tab-register" role="tabpanel" aria-labelledby="canvas-tab-register-tab" tabindex="0">
						<div class="card mb-0">
							<div class="card-body" style="padding: 40px;">
								<h3><b>註冊會員</b></h3>

								<form id="register-form" name="register-form" class="row mb-0" action="/user/signup" method="post">
                                @csrf
									<div class="col-12 form-group">
										<label for="username">帳號：</label>
										<input type="text" id="username" name="username" value="" class="form-control">
									</div>

									<div class="col-12 form-group">
										<label for="password">密碼：</label>
										<input type="password" id="password" name="password" value="" class="form-control">
									</div>

									<div class="col-12 form-group">
										<label for="repassword">確認密碼：</label>
										<input type="password" id="repassword" name="repassword" value="" class="form-control">
									</div>

									<div class="col-12 form-group">
                                        <div class="d-flex justify-content-end">
										    <button class="button button-3d button-black m-0" id="register-form-submit" name="register-form-submit" value="register">註冊</button>
                                        </div>
                                    </div>

								</form>
							</div>
						</div>
					</div>

				</div>

			</div>
		@else
			<h4>您已登入，3秒後回首頁</h4>
			<script>
				setTimeout(function() {window.location.href = '/index';}, 3000);
			</script>
		@endif
		</div>
	</div>
</section><!-- #content end -->

@endsection
</html>
