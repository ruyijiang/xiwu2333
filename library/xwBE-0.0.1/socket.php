<?php
header("Content-Type: text/html;charset=utf-8");
/*********************************************Socket类WS | ********************************************/

	$host = "localhost";
	$port = 4533;
	// 设置超时时间
	set_time_limit(0);
	// 创建一个Socket
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not createsocket\n");
	if ($socket < 0) {
    	echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
	}else {
     echo "OK.\n";
	}
	
	socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR,1);
	//绑定Socket到端口
	$result = socket_bind($socket,$host,$port) or die("Could not bind socket\n");
	// 开始监听链接
	if ($result < 0) {
		 echo "socket_bind() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
	}else {
	   echo "绑定OK\n";
	}
	$result = socket_listen($socket,3) or die("Could not set up socketlistener\n");
	// 开始监听链接
	if ($result < 0) {
		 echo "socket_listen() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
	}else {
	   echo "监听OK\n";
	}
	// accept incoming connections
	// 另一个Socket来处理通信
	$spawn = socket_accept($socket) or die("Could not accept incomingconnection\n");
	// 开始监听链接
	if ($spawn < 0) {
		 echo "socket_accept() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
	}else {
	   echo "accept OK\n";
	}
	// 获得客户端的输入
	$input = socket_read($spawn,1024) or die("Could not read input\n");
	// 开始监听链接
	if ($input < 0) {
		 echo "socket_read() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
	}else {
	   echo "read OK\n";
	    echo "接收服务器回传信息成功！\n\r";
	    echo "接受的内容为:".$input."\n\r";
	}
	// 清空输入字符串
	$input = trim($input);
	//处理客户端输入并返回结果
	$output = strrev($input) . "\n";
	
	$in = "Ho\r\n";
	$in .= "first blood\r\n";
	$out = '';
	$output = socket_write($spawn, $in, strlen ($in)) or die("Could not write	output\n");
	// 开始监听链接
	if ($output < 0) {
		 echo "socket_write() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
	}else {
	   echo "write OK\n";
   	   echo "发送到服务器信息成功！\n";
       echo "发送的内容为:<font color='red'>".$in."</font> <br>";
	}

	// 关闭sockets
	$status = socket_close($socket);
	if($status){echo "已经关闭socket";}
	
	

?>