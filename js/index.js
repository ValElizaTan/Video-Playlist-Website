var slideIndex = 1;     /* An array called slides*/
showSlides(slideIndex);       /* Used to display slide  each side*/

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
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

var videos = document.querySelectorAll('video');
for (var i = 0; i < videos.length; i++)
    videos[i].addEventListener('play', function () { pauseAll(this) }, true);


function pauseAll(elem) {
    for (var i = 0; i < videos.length; i++) {

        //Is this the one we want to play?
        if (videos[i] == elem) continue;

        //Have we already played it && is it already paused?
        if (videos[i].played.length > 0 && !videos[i].paused) {
            // Then pause it now
            videos[i].pause();
        }
    }
}

