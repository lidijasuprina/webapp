function open_modal_gallery() {
    document.getElementById("myModal").style.display = "block";
}

function close_modal_gallery() {
    document.getElementById("myModal").style.display = "none";
}

var slide_index_gallery = 1;
show_slides(slide_index_gallery);

function plus_slides(n) {
    show_slides(slide_index_gallery += n);
}

function current_slide(n) {
    show_slides(slide_index_gallery = n);
}

function show_slides(n) {
    var i;
    var slides = document.getElementsByClassName("my_slides_gallery");
    var dots = document.getElementsByClassName("demo_gallery");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slide_index_gallery = 1}
    if (n < 1) {slide_index_gallery = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slide_index_gallery-1].style.display = "block";
    dots[slide_index_gallery-1].className += " active";
    captionText.innerHTML = dots[slide_index_gallery-1].alt;
}