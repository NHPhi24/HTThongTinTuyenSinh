// Chờ html load xong mới chạy script
document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".carousel-track");
    const items = document.querySelectorAll(".item-carousel");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    let currentIndex = 0;

    function getItemWidth() {
      const style = window.getComputedStyle(items[0]);
      const marginRight = parseFloat(style.marginRight);
      return items[0].offsetWidth + marginRight;
    }

    function updateCarousel() {
      const itemWidth = getItemWidth();
      track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
    }

    nextBtn.addEventListener("click", function () {
      if (currentIndex < items.length - 3) {
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

    updateCarousel();
});

