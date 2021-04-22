const express = require('express');

const app = express();

const server = require('http').createServer(app);

const io = require('socket.io')(server, {
    cors: { origin: "*"}
});

server.listen(3000, () => {
    console.log('NodeJS server is running on port = 3000.');
});