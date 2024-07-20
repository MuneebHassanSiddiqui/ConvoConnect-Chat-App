const customSearchBar = document.querySelector(".users .search input");
const customSearchBtn = document.querySelector(".users .search button");
const usersList = document.querySelector(".users .user-list");

customSearchBar.addEventListener("click", () => {
    customSearchBar.classList.toggle("active");
    customSearchBar.focus();
    customSearchBtn.classList.toggle("active");
    customSearchBar.value = "";
});

customSearchBar.onkeyup = () => {
    let searchTerm = customSearchBar.value;
    if (searchTerm != "") {
        customSearchBar.classList.add("active");
    } else {
        customSearchBar.classList.remove("active");
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/search.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}




setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/users.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (!customSearchBar.classList.contains("active")) {
                    usersList.innerHTML = data;
                }
            }

        }
    }
    xhr.send(); // Send the XMLHttpRequest
}, 500);
