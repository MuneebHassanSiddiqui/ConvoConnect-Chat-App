const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".input-field");
const sendBtn = form.querySelector("button"); // Corrected button selector
const chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault();
};

sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = ""; // Clear input field after sending message
                scrollToBottom();
            }
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);
};



chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}
chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data; // Corrected variable name
                if (!chatBox.classList.contains("active")) {//if active class not cantain in chatbox the scroll bottom   
                    scrollToBottom();
                }

            }
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);

}, 500);



function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}






