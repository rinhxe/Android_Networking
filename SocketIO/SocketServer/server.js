const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);

const { Server } = require("socket.io");
const io = new Server(server);

var userList=[];

app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

io.on('connection', (socket) => {
  console.log('A user connecting... ');
  socket.on('user_login', (user_name)=> {
    if(userList.indexOf(user_name)>-1){
      return;
    }
    userList.push(user_name);
    socket.user = user_name;
  });

  socket.on('send_message',(message)=>{
    io.sockets.emit('receiver_message',{data: socket.use + ": "+message})
  })

  socket.on('disconnect', () => {
    console.log('--user disconnected--');
  });
});

server.listen(3000);