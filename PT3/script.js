const header = document.querySelector("header");

window.addEventListener("scroll", function() {
    header.classList.toggle ("sticky", window.scrollY > 0);
});

let menu = document.querySelector("#menu-icon");
let navlist = document.querySelector(".navlist");

menu.onclick = () => {
    menu.classList.toggle("bx-x");
    navlist.classList.toggle("open");
};

window.onscroll = () => {
    menu.classList.remove("bx-x");
    navlist.classList.remove("open");
}

function darkmode() {
    var SetTheme = document.body;

    SetTheme.classList.toggle("dark-mode");

    if (SetTheme.classList.contains("dark-mode")) {
        // Mode gelap diaktifkan
        document.documentElement.style.setProperty("--background-color", "#242424");
        document.documentElement.style.setProperty("--text-color", "#ffffff");
        document.querySelector(".home").style.backgroundColor = "#121212";
        document.querySelector(".aboutme").style.backgroundColor = "#121212";
        document.querySelector(".contact").style.backgroundColor = "#111111";
        document.querySelector(".last-text").style.background = "#111111";
        document.querySelector(".contact").style.color = "#ffffff";

        const infoElements = document.querySelectorAll(".info p, .info span, .info h2");
        infoElements.forEach(function(element) {
            element.style.color = "#ffffff"; 
        });

        // Mengubah warna teks pada elemen "aboutme" menjadi putih
        const aboutmeElements = document.querySelectorAll(".aboutme p, .aboutme span, .aboutme h2");
        aboutmeElements.forEach(function(element) {
            element.style.color = "#ffffff"; 
        });
    } else {
        // Mode gelap dinonaktifkan
        document.documentElement.style.setProperty("--background-color", "#ffffff");
        document.documentElement.style.setProperty("--text-color", "#111111");
        document.querySelector(".home").style.backgroundColor = "#FAF0E6";
        document.querySelector(".aboutme").style.backgroundColor = "#FAF0E6";
        document.querySelector(".contact").style.backgroundColor = ""; 
        document.querySelector(".contact").style.color = "";
        document.querySelector(".last-text").style.background = "";

        const infoElements = document.querySelectorAll(".info p, .info span, .info h2");
        infoElements.forEach(function(element) {
            element.style.color = ""; 
        });

        
        const aboutmeElements = document.querySelectorAll(".aboutme p, .aboutme span, .aboutme h2");
        aboutmeElements.forEach(function(element) {
            element.style.color = ""; 
        });
    }
}

const profileImage = document.getElementById("profile-image");

profileImage.addEventListener("click", function () {
    const isFlipped = window.getComputedStyle(profileImage).getPropertyValue("transform") === "matrix(-1, 0, 0, 1, 0, 0)";
    
    if (isFlipped) {
        profileImage.style.transform = "scaleX(1)";
    } else {
        profileImage.style.transform = "scaleX(-1)";
    }
    profileImage.style.cursor = "pointer";
});

const spanHuda = document.querySelector(".info span");
let isWhite = false;

spanHuda.addEventListener("click", function() {
    if (isWhite) {
        spanHuda.style.color = "";
    } else {
        spanHuda.style.color = "white";
    }

    isWhite = !isWhite;
});


window.addEventListener('load', function() {
    
    document.getElementById('overlay').style.display = 'block';
    
    document.getElementById('popup').style.display = 'block';
});

document.querySelector('.close').addEventListener('click', function() {
    
    document.getElementById('popup').style.display = 'none';
});

document.getElementById('redeemBtn').addEventListener('click', function() {
    
    document.getElementById('popup').style.display = 'none';
    
    document.getElementById('overlay').style.display = 'none';
});





