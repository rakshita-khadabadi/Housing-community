const { timeStamp } = require('console');
const express = require('express');

const app = express();

const server = require('http').createServer(app);

const io = require('socket.io')(server, {
    cors: { origin: "*"}
});

var mysql = require('mysql')

var con = mysql.createConnection({
    host:"localhost",
    user:"root",
    password:"",
    database:"city_view_database"
})

con.connect((err) => {
    if (!err)
        console.log('DB connection successful');
    else   
        console.log('DB connection failed : ' + JSON.stringify(err));
});


io.on('connection', (socket) => {
    console.log('NodeJS server connection established.');
    console.log("The number of connected sockets: "+socket.adapter.sids.size);
    console.log('socket.id = '+socket.id);
    // console.log(socket.adapter.sids)
    // console.log(socket.adapter)
    console.log('-----------------------');

    socket.on('new_visitor', user => {
        console.log('new_visitor', user);
        socket.user = user;
    });

    socket.on('sendChatToServer', (message, aptOwnerUserId, subManagerUserId) => {
        console.log('message from frontend = ' + message + ' aptOwnerUserId = ' + aptOwnerUserId + 'subManagerUserId = ' + subManagerUserId);
        console.log('socket.id = '+socket.id);
        // io.sockets.emit('sendChatToClient', message);
        socket.broadcast.emit('sendChatToClient', message);
        var conversationId = saveUserIdsToDB(aptOwnerUserId, subManagerUserId, message);
        console.log('conversationId = ' + conversationId);
        
    });

    socket.on('sendChatMessageToSMFromAO', (message, aptOwnerUserId) => {
        console.log('message from frontend AO to SM = ' + message + ' from ' + aptOwnerUserId);
        console.log('socket.id = '+socket.id);
        // io.sockets.emit('sendChatToSMFromAO', message);
        // socket.broadcast.emit('sendChatToSMFromAO', message+','+aptOwnerUserId);
        socket.broadcast.emit('sendChatToSMFromAO', message, aptOwnerUserId);
        // io.sockets.emit('sendChatToClient', message);
        // socket.disconnect(0);
    });

        
    // socket.on('end', function (){
    //     socket.disconnect(0);
    // });


    socket.on('disconnect', (socket) => {
        console.log('socket.id = '+socket.id);
        console.log('NodeJS server connection disconnected.');
        // socket.removeAllListeners();
    });
});



server.listen(3000, () => {
    console.log('NodeJS server is running on port = 3000.');
});




function saveUserIdsToDB(receiverUserId, senderUserId, message){
    console.log('Inside saveUserIdsToDB');

    var conversation_id;

    console.log('receiverUserId = ', receiverUserId);
    console.log('senderUserId = ', senderUserId);

    var timeStamp = new Date().toISOString().slice(0, 19).replace('T', ' ');


    var mysqlInsertQuery = "INSERT INTO `chats` (`id`,`receiver_user_id`,`sender_user_id`,`message`,`message_datetime`) VALUES (NULL, ?, ?, ?, ?);";

    conversation_id = con.query(mysqlInsertQuery, [receiverUserId, senderUserId, message, timeStamp], function (err, result) {
        if(!err){
             return result.insertId;
            
        }
        else{
            console.log('DB connection failed : ' + JSON.stringify(err));
        }
    })

    console.log('conversation_id = '+conversation_id);

    return conversation_id;
}