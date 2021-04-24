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

    // receive chat message from Subdivision Manager -----------------------------------

    socket.on('sendChatMessageFromSMToAO', (message, aptOwnerUserId, subManagerUserId) => {
        console.log('message from SM to AO = ' + message + ' aptOwnerUserId = ' + aptOwnerUserId + 'subManagerUserId = ' + subManagerUserId);
        console.log('socket.id = '+socket.id);

        socket.broadcast.emit('sendChatToClient', message);
        
        saveChatToDB(aptOwnerUserId, subManagerUserId, message);
    });

    // receive chat message from Building Manager -----------------------------------

    socket.on('sendChatMessageFromBMToSM', (message, smUserId, bmUserId) => {
        console.log('message from frontend AO to SM = ' + message + ' ,smUserId = '+ smUserId +' ,bmUserId = ' + bmUserId);
        console.log('socket.id = '+socket.id);

        socket.broadcast.emit('sendChatToSMFromBM', message, bmUserId);

        // saveChatToDB(smUserId, bmUserId, message);
    });

    socket.on('sendChatMessageFromBMToAO', (message, aptOwnerUserId, buildingManagerUserId) => {
        console.log('message from BM to AO = ' + message + ' aptOwnerUserId = ' + aptOwnerUserId + ' ,buildingManagerUserId = ' + buildingManagerUserId);
        console.log('socket.id = '+socket.id);

        socket.broadcast.emit('sendChatToAOFromBM', message);
        
        saveChatToDB(aptOwnerUserId, buildingManagerUserId, message);
    });


    // receive chat message from Apartment Owner -----------------------------------

    socket.on('sendChatMessageToSMFromAO', (message, smUserId, aptOwnerUserId) => {
        console.log('message from frontend AO to SM = ' + message + ' ,smUserId = '+ smUserId +' ,aptOwnerUserId = ' + aptOwnerUserId);
        console.log('socket.id = '+socket.id);

        socket.broadcast.emit('sendChatToSMFromAO', message, aptOwnerUserId);

        saveChatToDB(smUserId, aptOwnerUserId, message);
    });

        
    socket.on('sendChatMessageToBMFromAO', (message, bmUserId, aptOwnerUserId) => {
        console.log('message from frontend AO to SM = ' + message + ' ,bmUserId = '+ bmUserId +' ,aptOwnerUserId = ' + aptOwnerUserId);
        console.log('socket.id = '+socket.id);

        socket.broadcast.emit('sendChatToBMFromAO', message, aptOwnerUserId);

        saveChatToDB(bmUserId, aptOwnerUserId, message);
    });


    socket.on('disconnect', (socket) => {
        console.log('socket.id = '+socket.id);
        console.log('NodeJS server connection disconnected.');
        // socket.removeAllListeners();
    });
});



server.listen(3000, () => {
    console.log('NodeJS server is running on port = 3000.');
});




function saveChatToDB(receiverUserId, senderUserId, message){

    // console.log('Inside saveUserIdsToDB');

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

    // console.log('conversation_id = '+conversation_id);

    return conversation_id;
}