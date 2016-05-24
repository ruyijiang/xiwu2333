//用于将html字符反转义为普通的字符
function htmlencode(s){
    //将特殊字符转换成Html实体
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(s));
    return div.innerHTML;
}
function htmldecode(s){
    //将html实体转换成特殊字符
    var div = document.createElement('div');
    div.innerHTML = s;
    return div.innerText || div.textContent;
}