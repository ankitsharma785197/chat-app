let eyeicon = document.getElementById("eyeicon");
let password = document.getElementById("password");


eyeicon.onclick = function (){
    if(password.type === "password"){
        password.type ="text";
        eyeicon.className = "ri-eye-line";

    }
    else{
        password.type = "password";
        eyeicon.className = "ri-eye-off-line";
    }
}