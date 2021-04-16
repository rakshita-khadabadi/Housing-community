@extends('city-view.home')

@section('title', 'Login')

@section('content')
<div class="topnav">
    City View
    <a href="./login.php">Login</a>
    <a class="active" href="./sign-up.php">SignUp</a>
    <a href="./contact_us.php">Contact Us</a>
    <a href="/blog">Forum</a>
    <a href="./about.php">About Us</a>
    <a href="../index.php">Home</a>
</div>
<div class="container">
    <div class="contact_container">
        <h2 style="color:#4F4846;">Login</h2> <br>


        <div style="padding:100px 20px">

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="email"></label>
                <input type="email" id="email" name="email" required placeholder="Email"> <br><br>
                <label for="password"></label>
                <input type="password" id="password" name="password" required placeholder="Password"> <br><br>
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
