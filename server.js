import { createRequire } from 'module';
const require = createRequire(import.meta.url);

//var io = io('http://proacademydos.local:10029', {transports: ['websocket', 'polling', 'flashsocket']});

var io = require('socket.io')(8890);
//io.origins(['http://proacademydos.local:8890', 'http://proacademydos.local:10029']);

io.on('connection', function(socket){
    console.log('Connected');

    socket.on('sendMessage', function(message, sender, chat_id){
        console.log(message+', from: '+sender+', to chat: '+chat_id);
        io.sockets.emit('receiveMessage', message, sender, chat_id);
    });

    socket.on('disconnect', function(socket){
        console.log('Disconnected');
    });
});
/*var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');
 
server.listen(8890);
io.on('connection', function (socket) {
 
  console.log("new client connected");
  var redisClient = redis.createClient();
  redisClient.subscribe('sendMessage');
 
  redisClient.on("sendMessage", function(sender, message) {
    console.log("mew message in queue "+ message + "channel");
    socket.emit(sender, message);
  });
 
  socket.on('disconnect', function() {
    redisClient.quit();
  });
 
});*/