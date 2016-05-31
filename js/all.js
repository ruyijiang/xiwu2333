// JavaScript Document
/************创建Socket，用以与php socket握手通信**********/
/******************************************************/
/*var socket = null;
var SocketCreated = false;
if(SocketCreated && (socket.readyState == 0 || socket.readState == 1)){
	socket.close();
}else{
	
}
var socket = new WebSocket('ws://localhost:4533/library/xwBE-0.0.1/socket'); 

// 打开Socket 
socket.onopen = function(event) { 

  // 发送一个初始化消息
  socket.send('12345 I am the client and I\'m listening!'); 

  // 监听消息
  socket.onmessage = function(event) { 
    console.log('Client received a message',event); 
    console.log("握手成功");
	alert ("1");
  }; 

  // 监听Socket的关闭
  socket.onclose = function(event) { 
    console.log('Client notified socket has closed',event); 
	alert ("2");
  }; 
	alert (socket.readyState);
  // 关闭Socket.... 
  socket.close() 
};
socket.onerror = function(){
    console.log("error");
  socket.close() 
};*/

/******************************************************/
/******************************************************/
//设置Angular app
var app = angular.module('myApp', ["ui.router",'angular-popups']);





