@extends('city-view.home')

@section('title', 'Login')

@section('content')
<div class="topnav">
    City View
    <a href="./login">Login</a>
    <a class="active" href="./sign-up">SignUp</a>
    <a href="./contact_us">Contact Us</a>
    <a href="/blog">Forum</a>
    <a href="./about">About Us</a>
    <a href="../">Home</a>
</div>
<div class="container">
    <div class="contact_container">
        <h2 style="color:#4F4846;">Login</h2> <br>

        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div style="padding:100px 20px">

            {{-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> --}}
            <form method="post">
                @csrf
                <label for="email"></label>
                @if(session('newUserEmail'))
                <input type="email" id="email" name="email" required placeholder="Email" value="{{ session('newUserEmail') ?? '' }}"> <br><br>
                @else
                <input type="email" id="email" name="email" required placeholder="Email"> <br><br>
                @endif

                <label for="password"></label>
                @if(session('newUserPassword'))
                <input type="password" id="password" name="password" required placeholder="Password" value="{{ session('newUserPassword') ?? '' }}"> <br><br>
                @else
                <input type="password" id="password" name="password" required placeholder="Password"> <br><br>
                @endif

                <div class="SignUpFormButtons" style="text-align: center;">
                    <button class="login-button">Login</button>
                </div>

            </form>

        </div>

    </div>
</div>
<br><br><br><br>

<script src="" async defer></script>
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
