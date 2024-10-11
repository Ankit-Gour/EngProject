// nav menu style
var nav = $("#navbarSupportedContent");
var btn = $(".custom_menu-btn");
btn.click
btn.click(function (e) {

    e.preventDefault();
    nav.toggleClass("lg_nav-toggle");
    document.querySelector(".custom_menu-btn").classList.toggle("menu_btn-style")
});


function getCurrentYear() {
    var d = new Date();
    var currentYear = d.getFullYear()

    $("#displayDate").html(currentYear);
}

getCurrentYear();


window.onload = function() {
    // Hide the loader after a brief period (simulate loading time)
    setTimeout(() => {
        const loader = document.getElementById("loader");
        const content = document.getElementById("content");
        
        // Remove the loader from the DOM
        loader.style.display = "none";
        content.style.display = "flex"; // Show the content
    }, 200); // Change the time (in milliseconds) as needed
};
