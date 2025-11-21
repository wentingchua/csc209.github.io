
function plusSlides(n) {
    // console.log(currentFolder);
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    // var folderDiv = document.getElementById(currentFolder); //only access div of currently selected folder
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}

function handleDropdownChange() {
    var dropdown = document.getElementById("dropdown");
    var selected = dropdown.value;
    //handle slides
    ////hide all
    var allFolders = document.getElementsByClassName("folder-slides");
    for (var i = 0; i < allFolders.length; i++) {
        allFolders[i].style.display = "none";
    }
    ////show only selected
    document.getElementById(selected).style.display = "block";
    currentFolder = selected;
    slideIndex = 1;
    showSlides(1);
    //handle dots
    var allDots = document.getElementsByClassName("folder-dots");
    ////hide all
    for (var i = 0; i < allDots.length; i++) {
        allDots[i].style.display = "none";
    }
    ////show only selected
    document.getElementById("dots-" + selected).style.display = "inline-block";
}

var slideIndex = 1;
showSlides(slideIndex);
