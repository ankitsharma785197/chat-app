const form = document.querySelector(".typing-area"),
    inputField = form.querySelector('input[type="text"]'),
    sendBtn = form.querySelector("button"),
    fileInput = form.querySelector('input[type="file"]'),
    chatbox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault();
};

sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";
                fileInput.value = "";
                scrollToBottom();
            }
        }
    };

    let formData = new FormData(form);
    xhr.send(formData);
};


chatbox.onmouseenter = () => {
    chatbox.classList.add("active");
};

chatbox.onmouseleave = () => {
    chatbox.classList.remove("active");
};

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatbox.innerHTML = data;
                if (!chatbox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);
}, 500);


function openImagePopup(imgSrc) {
    const popup = document.createElement("div");
    popup.classList.add("image-popup");
    const img = document.createElement("img");
    img.src = imgSrc;
    popup.appendChild(img);
    popup.addEventListener("click", () => {
        popup.remove();
    });
    document.body.appendChild(popup);
    scrollToBottom();
}

setInterval(() => {
    updateLastSeen();
}, 60000);

function updateLastSeen() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/update-last-seen.php", true);
    xhr.send();
}

function scrollToBottom(){
    chatbox.scrollTop = chatbox.scrollHeight;
}

        // Add an event listener to handle image clicks
document.addEventListener("click", (event) => {
    const target = event.target;
    if (target.tagName === "IMG" && target.classList.contains("newimg")) {
        openImagePopup(target.src);
    }
});
function viewProfile(userId='') {
    let profileUrl;
    if (userId !== "") {
        profileUrl = "profile.php?user_id=" + userId;
    } else {
        profileUrl = "profile.php";
    }
    document.location.href = profileUrl;
}

setInterval(() => {
    updateLastSeen();
}, 10000); 

function updateLastSeen() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/update-last-seen.php", true);
    xhr.send();
}