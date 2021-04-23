@extends('city-view.home')

@section('title', 'Login')

@section('content')
<div class="topnav">
    City View
    <a href="./login">Login</a>
    <a class="active" href="./sign-up">SignUp</a>
    <a href="./contact-us">Contact Us</a>
    <a href="/blog">Forum</a>
    <a href="./about">About Us</a>
    <a href="../">Home</a>
  </div>
  <br><br><br>
  <div style="height: auto;">
    <h1 class="text1">About Us</h1>
    <p class="content1"> We will help you to dicover a place where you will love to live.</p>
    <div class="row">
      <div class="column">
        <img src="/static/photo01.jpg" alt="Avatar" class="avatar">
      </div>
      <div class="column1">
        <p>Our team is built by a group of hardworking developers and designers.We strongly believe that one can learn
          and achieve anything, when driven by ‘character strength’ and the ‘strive for perfection’.It motivates us to
          work round the clock so that client requirements are met.</p>
        <div class="skill-row">
          <img class="img" src="/static/roles.png" alt="Roles" height="70" width="40">
          <h3>Registers for Manager,Subdivision and Apartment role</h3>
        </div>
        <div class="skill-row">
          <img class="img" src="/static/time.png" alt="chat" height="70" width="40">
          <h3>24/7 Service available</h3>
        </div>
        <div class="skill-row">
          <img class="img" src="/static/maintenace.png" alt="maintenace" height="70" width="40">
          <h3>Maintenance Requests and Complaints</h3>
          </p>
        </div>
        <div class="skill-row">
          <img class="img" src="/static/chat.png" alt="chat" height="70" width="40">
          <h3>Chat Feature</h3>
        </div>
      </div>
    </div>
  </div><br><br><br>
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