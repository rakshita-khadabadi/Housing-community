const express = require('express');

const app = express();

const server = require('http').createServer(app);

const io = require('socket.io')(server, {
    cors: { origin: "*"}
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

    socket.on('sendChatToServer', (message, second) => {
        console.log('message from frontend = ' + message + ' ' + second);
        console.log('socket.id = '+socket.id);
        // io.sockets.emit('sendChatToClient', message);
        socket.broadcast.emit('sendChatToClient', message);
        
    });

    socket.on('sendChatMessageToSMFromAO', (message, aptOwnerUserId) => {
        console.log('message from frontend AO to SM = ' + message + ' from ' + aptOwnerUserId);
        console.log('socket.id = '+socket.id);
        // io.sockets.emit('sendChatToSMFromAO', message);
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