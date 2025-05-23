document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".carousel-track");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const items = document.querySelectorAll(".item-carousel");
    let currentIndex = 0;

    function updateCarousel() {
        const itemWidth = items[0].offsetWidth + 10; // Thêm khoảng cách giữa các phần tử
        track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
    }

    nextBtn.addEventListener("click", function () {
        if (currentIndex < items.length - 1) {
            currentIndex++;
            updateCarousel();
        }
    });

    prevBtn.addEventListener("click", function () {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    });
});