@extends('city-view.home')

@section('title', 'Login')

@section('content')
<div>
      <div class="topnav">
       City View
        <a href="/login">Login</a>
        <a class="active" href="/sign-up">SignUp</a>
        <a href="/contact-us">Contact Us</a>
        <a href="/blog">Forum</a>
        <a href="/about">About Us</a>
        <a href="/">Home</a>
      </div>
     </div>
    <div class="container">
      <img src="./static/cityview.jpg" class="bg_img" alt="No Image Found">
    </div>
    <script src="" async defer></script>
    <br>
    <footer>
      <p align="center" class="footer"> 
        <span style="float: left;">All Rights Reserved</span>
        <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a> &nbsp;&nbsp;
        <a href="https://facebook.com"><i class="fab fa-facebook"></i></a>&nbsp;&nbsp;
        <a href="https://youtube.com"><i class="fab fa-youtube"></i></a>&nbsp;&nbsp;
        <span style="float: right;">www.cityview.com</span>
      </p>
    </footer>  
@endsection