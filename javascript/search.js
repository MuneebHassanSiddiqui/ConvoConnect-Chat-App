const searchBar = document.querySelector(".users .search input");
const searchBtn = document.querySelector(".users .search button");

// Add event listener to the search button
searchBtn.addEventListener("click", () => {
    // Toggle the "active" class on the search bar
    searchBar.classList.toggle("active");
    // Focus on the search bar after toggling
    searchBar.focus();
    // Toggle the "active" class on the search button
    searchBtn.classList.toggle("active");
});