// Slider functionality
const slider = document.querySelector('.slider');
const slides = slider.querySelectorAll('img');
let currentSlide = 0;

function showSlide(n) {
  slides.forEach(slide => {
    slide.classList.remove('active');
  });
  slides[n].classList.add('active');
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}

setInterval(nextSlide, 5000); // Change slide every 5 seconds