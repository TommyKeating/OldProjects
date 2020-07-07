// Require the packages we will use:
var http = require("http"),
	socketio = require("socket.io"),
	fs = require("fs"),
	bcrypt = require("bcrypt"),
	swearjar = require('swearjar-extended');

// Listen for HTTP connections.  This is essentially a miniature static file server that only serves our one file, client.html:
var app = http.createServer(function(req, resp){
	// This callback runs when a new connection is made to our HTTP server.
	
	fs.readFile("client.html", function(err, data){
		// This callback runs when the client.html file has been read from the filesystem.
		
		if(err) return resp.writeHead(500);
		resp.writeHead(200);
		resp.end(data);
	});
});
app.listen(3456);

//list of users
let users = [];
//list of rooms
let roomNames = [];
//list of room objects
let rooms = [];
// Do the Socket.IO magic:
var io = socketio.listen(app);
io.sockets.on("connection", function(socket){
	// This callback runs when a new Socket.IO connection is established.
	socket.on('message_to_server', function(data) {
		// This callback runs when the server receives a new message from the client.
		
		console.log("message: "+data["message"]); // log it to the Node.JS output
		let clean = swearjar.profane(data["message"]);
		if(clean) //false if clean, true if profane
		{
			io.sockets.emit("message_to_client",{message: "THIS MESSAGE WAS BLOCKED FOR CONTAINING PROFANITY", chatroom:data.chatroom}) // broadcast the message to other users
		}
		else
		{
			io.sockets.emit("message_to_client",{message:data["message"], chatroom:data.chatroom}) // broadcast the message to other users
		}
	});

	//private message
	socket.on('message_to_server_private', function(data) {
		// This callback runs when the server receives a new message from the client.
		
		console.log("message: "+data["message"]); // log it to the Node.JS outputput
		let clean = swearjar.profane(data["message"]);
		if(clean) //false if clean, true if profane
		{
			io.sockets.emit("message_to_client_private",{message: "THIS MESSAGE WAS BLOCKED FOR CONTAINING PROFANITY", chatroom:data.chatroom, username: data.username}) // broadcast the message to other users
		}
		else
		{
			io.sockets.emit("message_to_client_private",{message:data["message"], chatroom:data.chatroom, username: data.username}) // broadcast the message to other users
		}
	});

	//this is login request
	socket.on('login', function(data) {
		if(users.includes(data) || (swearjar.profane(data))){
			socket.emit('loginSuccess', {success: false});
		}else{
			users.push(data);
			socket.emit('loginSuccess', {success: true});
		}
	});

	//this is creating a new room request
	socket.on('newRoom', function(data){
		if(!roomNames.includes(data.name)){
			if(data.password == "")
			{
				roomNames.push(data.name);
				console.log(data.name);
				rooms.push(data);
				console.log(data);
				socket.emit('createRoomSuccess', {success: true});
				io.sockets.emit('sendRoomList', roomNames);
			}
			else
			{
				roomNames.push(data.name);
				console.log(data.name);
				bcrypt.hash(data.password, 10, function(err, hash) {
				data.password = hash;
				rooms.push(data);
				console.log(data);
				socket.emit('createRoomSuccess', {success: true});
				io.sockets.emit('sendRoomList', roomNames);
			  });
			}
		}else{
			socket.emit('createRoomSuccess', {success: false});
		}
	});

	//logout
	socket.on("logout", function(username){
		let index_remove = users.indexOf(username);
		if (index_remove > -1) {
			users.splice(index_remove, 1);
		}
	});

	//getting list of rooms
	socket.on('getRoomList', function(){
		socket.emit('sendRoomList', roomNames);
	});

	//getting information about a particular room in order to join it
	socket.on('joinRoom', function(data){
		if(roomNames.includes(data.roomname)){
			let index = roomNames.indexOf(data.roomname);
			let this_room = rooms[index];
			if(this_room.password == ""){ //room has no password
				if(!this_room.banList.includes(data.username)){
					socket.emit('canJoinRoom', {success: true, roomname: data.roomname});
					this_room.activeUserList.push(data.username);
					socket.join(data.roomname);
					io.sockets.emit('sendUserList', {userList: this_room.activeUserList, roomname: data.roomname});
				}else{
					socket.emit('canJoinRoom', {success: false, failCode: 0, reason: "You are banned from joining this room."});
				}
			}else{
				if(!this_room.banList.includes(data.username)){
					socket.emit('canJoinRoom', {success: false, failCode: 1, lobbyName: data.roomname}); //there is a password required
				}else{
					socket.emit('canJoinRoom', {success: false, failCode: 0, reason: "You are banned from joining this room."});
				}
			}
		}
	});

	//function that if a password is set for the room, check to see if the user can login
	socket.on('checkPassword', function(data){
		let index = roomNames.indexOf(data.roomname);
		let thisRoom = rooms[index];
		console.log(thisRoom.password);
		console.log(data.password);
		bcrypt.compare(data.password, thisRoom.password, function(err, res) {
			if(res) {
				socket.emit('correctPassword', {success: true});
				thisRoom.activeUserList.push(data.username);
				console.log(thisRoom.activeUserList);
				socket.join(data.roomname);
				io.sockets.emit('sendUserList', {userList: thisRoom.activeUserList, roomname: data.roomname});
			} else {
				socket.emit('correctPassword', {success: false, message: "Incorrect Password"});
			} 
		  });
	});

	socket.on('leaveRoom', function(data){
		let index = roomNames.indexOf(data.roomname);
		let thisRoom = rooms[index];
		let index_remove = thisRoom.activeUserList.indexOf(data.username);
		if (index_remove > -1) {
			thisRoom.activeUserList.splice(index_remove, 1);
		}
		socket.leave(data.roomname);
		io.sockets.emit('sendUserList', {userList: thisRoom.activeUserList, roomname: data.roomname, owner: thisRoom.owner});
	});

	//getting the list of users
	socket.on('getUserList', function(data){
		let index = roomNames.indexOf(data.roomname);
		let thisRoom = rooms[index];
		io.sockets.emit('sendUserList', {userList: thisRoom.activeUserList, roomname: data.roomname, owner: thisRoom.owner});
	});


	//kicking a user in a specified chatroom
	socket.on("kickUser", function(data){
		let index = roomNames.indexOf(data.roomname);
		let thisRoom = rooms[index];
		let index_remove = thisRoom.activeUserList.indexOf(data.username);
		if (index_remove > -1) {
			thisRoom.activeUserList.splice(index_remove, 1);
		}
		io.sockets.emit('sendUserList', {userList: thisRoom.activeUserList, roomname: data.roomname, owner: thisRoom.owner});
		io.sockets.emit("kickUserSender", data);
	});

	//kicking a user in a specified chatroom once the user is identified
	socket.on("kickUserAction", function(data){
		socket.leave(data.roomname);
		socket.emit("kickConfirmed");
	});

	//banning a user
	socket.on("banUser", function(data){
		let index = roomNames.indexOf(data.roomname);
		let thisRoom = rooms[index];
		thisRoom.banList.push(data.username);
		let index_remove = thisRoom.activeUserList.indexOf(data.username);
		if (index_remove > -1) {
			thisRoom.activeUserList.splice(index_remove, 1);
		}
		io.sockets.emit('sendUserList', {userList: thisRoom.activeUserList, roomname: data.roomname, owner: thisRoom.owner});
		io.sockets.emit("banUserSender", data);
	});	
}); //do not touch this is closing for connection