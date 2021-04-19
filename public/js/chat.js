function inputForChat(event, inputBoxId, receiverUserId, senderUserId){

    inputMessage = document.getElementById(inputBoxId).value
    console.log(inputMessage)

    console.log('receiverUserId = ' + receiverUserId)
    console.log('senderUserId = ' + senderUserId)

    // var ajax = new XMLHttpRequest();
	// ajax.open("POST", "php-send-message.php", true);
	// ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// ajax.send("name=" + name + "&message=" + message);
}


// We will add the WebSocket code here which will be outside any function