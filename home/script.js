// script.js

const slider = document.getElementById('slider');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const pauseBtn = document.getElementById('pauseBtn');
const indicator = document.getElementById('indicator');

const totalSlides = 4;
let currentSlide = 1;
let autoPlayInterval;
let isPaused = false;

function goToSlide(slideIndex) {
    if (slideIndex > totalSlides) slideIndex = 1;
    if (slideIndex < 1) slideIndex = totalSlides;

    currentSlide = slideIndex;
    indicator.innerText = `${currentSlide} / ${totalSlides}`;

    const slideWidth = slider.clientWidth;
    slider.scrollLeft = (currentSlide - 1) * slideWidth;
}

nextBtn.addEventListener('click', () => {
    goToSlide(currentSlide + 1);
    resetAutoPlay();
});

prevBtn.addEventListener('click', () => {
    goToSlide(currentSlide - 1);
    resetAutoPlay();
});

function startAutoPlay() {
    autoPlayInterval = setInterval(() => {
        goToSlide(currentSlide + 1);
    }, 3000);
}

function resetAutoPlay() {
    clearInterval(autoPlayInterval);

    if (!isPaused) startAutoPlay();
}

pauseBtn.addEventListener('click', () => {
    isPaused = !isPaused;

    if (isPaused) {
        clearInterval(autoPlayInterval);
        pauseBtn.innerText = "▶";
    } else {
        startAutoPlay();
        pauseBtn.innerText = "||";
    }
});

slider.addEventListener('scroll', () => {
    const slideWidth = slider.clientWidth;
    const scrollPosition = slider.scrollLeft;

    const newSlide =
        Math.round(scrollPosition / slideWidth) + 1;

    if (
        newSlide !== currentSlide &&
        newSlide >= 1 &&
        newSlide <= totalSlides
    ) {
        currentSlide = newSlide;
        indicator.innerText =
            `${currentSlide} / ${totalSlides}`;
    }
});

startAutoPlay();


// ======================================
// THUMBNAIL IMAGE
// ======================================

const mainImage = document.getElementById("mainImage");

const thumbnails =
    document.querySelectorAll(".thumbnail");

thumbnails.forEach((thumb) => {

    thumb.addEventListener("click", function () {

        mainImage.src = this.src;

        thumbnails.forEach((item) => {
            item.classList.remove(
                "border-4",
                "border-purple-600"
            );
        });

        this.classList.add(
            "border-4",
            "border-purple-600"
        );

    });

});