let index = 0;
function showSlide() {
    const carousel = document.getElementById('carousel');
    const cards = document.querySelectorAll('.card');
    const totalSlides = cards.length;
    if (index < 0) index = totalSlides - 1;
    if (index >= totalSlides) index = 0;
    carousel.style.transform = `translateX(${-index * 380}px)`;
}
function prevSlide() {
    index--;
    showSlide();
}
function nextSlide() {
    index++;
    showSlide();
}
