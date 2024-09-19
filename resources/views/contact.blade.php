<!DOCTYPE html>
@extends('layout.master') 

@section('content')
<div class="container">
    <div class="title">
        <div class="fancy-title title-center title-border mt-6">
            <h2><b>聯絡我們</b></h2>
        </div>
    </div>
    <div class="content-wrap">
        <div class="row col-mb-50">
            <div class="col-md-6">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.671080259659!2d120.2003964253131!3d22.99911967919017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346e76604a4f5175%3A0x3fea3168897669f!2z5Y-w5Y2X6JGh5ZCJ6bq15YyF5bqX!5e0!3m2!1szh-TW!2stw!4v1725294390519!5m2!1szh-TW!2stw" 
                width="600" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            </div>
            <div class="col-md-1"></div> 
            <div class="col-md-5">
                <h5>連絡電話</h5>
                <p>06-1234567</p>
                <h5>信箱</h5>
                <p>bakery@gmail.com</p>
                <h5>地址</h5>
                <p>台南市北區成功路200號</p>
                <h5>營業時間</h5>
                <p>08:00-20:00(週一至週日)</p>
            </div>
        </div>
    </div>
</div>

@endsection
</html>
