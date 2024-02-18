window.addEventListener('beforeunload', function(){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/logout.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
            }
        }
    }
    xhr.send();
})