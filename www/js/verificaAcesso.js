    //window.localStorage.clear();
 var login = window.localStorage.getItem("username");
 //window.localStorage.removeItem("key");
 if(login == null){
    window.location.href = "index.html";
 }
