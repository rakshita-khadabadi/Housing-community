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

$senderUserId = $_GET['senderUserId'];
$receiverUserId = $_GET['receiverUserId'];

echo $senderUserId;
echo $receiverUserId;

?>

@extends('city-view.app')

@section('title', 'Subdivision Manager Page')

@section('content')
<div>
    <div class="small-chat-display-box">
        <span class="receiver-msg">How are you?</span>
        <span class="sender-msg">Great!</span>
        <div id="connecting">Connecting to web sockets server...</div>
        

    </div>

    <div class="chat-input-bar">
        <div class="chat-input">
            <label for="send"></label>
            <input type="text" id="apartment-owner-send" name="send" class="chat-input-box" placeholder="Enter Message">
        </div>
        <div>
            <button class="send-button" onclick="inputForChat(event, 'apartment-owner-send', $receiverUserId, $senderUserId)">Send</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/chat.js') }}"></script>

@endsection
