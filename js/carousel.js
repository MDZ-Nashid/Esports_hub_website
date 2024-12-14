let slideIndex = 0;
const slides = document.querySelectorAll('.carousel-item');

function showSlide(index) {
    slideIndex = (index + slides.length) % slides.length;
    document.querySelector('.carousel-inner').style.transform = `translateX(-${slideIndex * 100}%)`;
}

function nextSlide() {
    showSlide(slideIndex + 1);
}

function prevSlide() {
    showSlide(slideIndex - 1);
}

// Auto-slide every 5 seconds
setInterval(() => nextSlide(), 5000);

