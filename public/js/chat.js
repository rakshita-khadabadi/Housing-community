function inputForChat(event, inputBoxId, receiverUserId, senderUserId){

    chatMessage = document.getElementById(inputBoxId).value
    console.log(chatMessage)

    console.log('receiverUserId = ' + receiverUserId)
    console.log('senderUserId = ' + senderUserId)

    var ajax = new XMLHttpRequest();
	ajax.open("POST", "../php-send-message.php", true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send("senderUserId=" + senderUserId + "&receiverUserId" + receiverUserId + "&chatMessage=" + chatMessage);

    chatMessage = '';
}


// We will add the WebSocket code here which will be outside any function

window.WebSocket = window.WebSocket || window.MozWebSocket;

var connection = new WebSocket('ws://localhost:8080');
var connectingSpan = document.getElementById("connecting");

connection.onopen = function () {
	connectingSpan.style.display = "none";
};

connection.onerror = function (error) {
	connectingSpan.innerHTML = "Error occured";
};

connection.onmessage = function (message) {
	var data = JSON.parse(message.data);

	var div = document.createElement("div");
	var author = document.createElement("span");
		author.className = "author";
		author.innerHTML = data.name;
	var message = document.createElement("span");
		message.className = "messsage-text";
		message.innerHTML = data.message;

	div.appendChild(author);
	div.appendChild(message);

	document.getElementById("message-box").appendChild(div);

}