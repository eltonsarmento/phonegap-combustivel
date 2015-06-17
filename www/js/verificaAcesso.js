
var username = window.localStorage.getItem("username");

if(username == null){
	window.location.href = "index.html";
}