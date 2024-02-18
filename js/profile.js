const form = document.querySelector(".updatedetails form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-txt");
form.onsubmit = (e)=>{
    e.preventDefault();
}
continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/update-profile.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    location.reload();
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
setInterval(() => {
    updateLastSeen();
}, 10000);

function updateLastSeen() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/update-last-seen.php", true);
    xhr.send();
}