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
    }, 300); // Change the time (in milliseconds) as needed
};

const text1 = "Transform boundaries into bridges";
const text2 = "Revolutionize lives with the power of languages";
const loadingTextElement1 = document.getElementById("loading-text-1");
const loadingTextElement2 = document.getElementById("loading-text-2");
let index1 = 0;
let index2 = 0;

function typeText1() {
    if (index1 < text1.length) {
        loadingTextElement1.innerHTML += text1.charAt(index1);
        index1++;
        const typingSpeed = 20; 
        setTimeout(typeText1, typingSpeed); // Adjust typing speed
    } else {
        // Start typing the second line after the first line is done
        setTimeout(typeText2, 50); 
    }
}

function typeText2() {
    if (index2 < text2.length) {
        loadingTextElement2.innerHTML += text2.charAt(index2);
        index2++;
        const typingSpeed =20; // Random speed between 50 and 150ms
        setTimeout(typeText2, typingSpeed); // Adjust typing speed
    }
}

typeText1(); // Start typing effect for the first line