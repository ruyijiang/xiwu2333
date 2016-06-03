<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script src="js/run.js"></script>
<script>
function $$(id){
	return document.getElementById(id);
}
var strTip = "";
var objWs = null;
var conUrl = "ws://localhost:8000";
var SocketCreated = false;
var arrState = new Array("正在建立连接","连接成功","正在关闭连接","连接已关闭","正在初始化","连接出错");
function pageload(){
	
	
	
	
	if(SocketCreated && (objWs.readeyState ==0 || objWs.readyState == 1)){
		objWs.close();
	}else{
		Handle_List(arrState[4]);
		try{
			objWs = new WebSocket(conUrl);
			SocketCreated = true;
		}catch(ex){
			Handle_List(ex);
			return ;
		}
	}
	
	objWs.onopen = function (e){
		Handle_List(arrState[objWs.readyState]);
		alert ("open");
	}
	objWs.onmessage = function (event){
		Handle_List("系统消息：" + event.data);
		alert ("message");
	}
	objWs.onerror = function (){
		Handle_List(arrState[5]);
		alert ("error");
	}
	objWs.onclose = function (){
		Handle_List(arrState[objWs.readyState]);
		alert ("close");
	}
}
function btnSend_Click(){
	var strTxtMessage = $$("txtMessage").value;
	if(strTxtMessage.length > 0){
		objWs.send(strTxtMessage);
		Handle_List("我说：" + strTxtMessage);
		$$("txtMessage").value = "";
	}
}
function Handle_List(message){
	strTip += message + "\n";
	$$("textaList").innerHTML = strTip;	
}
</script>
</head>

<body onload="pageload();">
	<textarea id="textaList" cols="26" rows="12" readonly="readonly"></textarea><br>
    <input type="text" id="txtMessage" class="inputtxt"/>
    <input type="button" id="btnAdd" value="发送" class="inputbtn" onclick="btnSend_Click()"/>

</body>
</html>