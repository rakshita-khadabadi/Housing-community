<?php

// DB credentials required to connect
$db_host = "localhost";
$db_name = "city_view_database";
$db_user = "root";
$db_pass = "";

// function to connect to the DB
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// checkng if the connection was successful
if (mysqli_connect_error()) {
	echo mysqli_connect_error();
	exit;
} else {
	echo "connected successfully";
}

?>

@extends('city-view.app')

@section('title', 'Subdivision Manager Page')

@section('content')
<div>
    <div class="small-chat-display-box">

    </div>

    <div class="chat-input-bar">
        <div class="chat-input">
            <label for="send"></label>
            <input type="text" id="apartment-owner-send" name="send" class="chat-input-box" placeholder="Enter Message">
        </div>
        <div>
            <button class="send-button" onclick="inputForChat(event, 'apartment-owner-send', 4, 2)">Send</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/chat.js') }}"></script>

@endsection
