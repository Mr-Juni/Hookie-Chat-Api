
var server = require('http').Server();
var io = require('socket.io')(server);

var Redis = require('ioredis');
var redis = new Redis();


//Suubscribe to the redis channne

redis.subscribe('test-channel');

redis.on('message', function(channel, message){
	console.log(channel, message);
	message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);//test-channel

});

server.listen(3000);

