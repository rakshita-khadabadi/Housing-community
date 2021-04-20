<?php
include_once 'php-db.php';

// get the input
$senderUserId = trim(htmlspecialchars($_POST['senderUserId'] ?? ''));
$receiverUserId = trim(htmlspecialchars($_POST['receiverUserId'] ?? ''));
$chatMessage = trim(htmlspecialchars($_POST['chatMessage'] ?? ''));

echo $chatMessage;

if (!$senderUserId || !$receiverUserId || !$message)
	die;



// // insert data into the database
// $stmt = $mysqli -> prepare('INSERT INTO chat_messages (name, time, message) VALUES (?,?,?)');
// $time = time();
// $stmt -> bind_param('sis', $name, $time, $message);
// $stmt -> execute();
	
// // Send the HTTP request to the websockets server (it runs both  HTTP and Websockets)
// // (change the URL accordingly)
// $ch = curl_init('http://localhost:8080');
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

// // we send JSON encoded data to the Node.JS server
// $jsonData = json_encode([
// 	'name' => $name,
// 	'message' => $message
// ]);
// $query = http_build_query(['data' => $jsonData]);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $response = curl_exec($ch);
// curl_close($ch);