document.addEventListener("DOMContentLoaded", function () {
  const track = document.querySelector(".carousel-track");
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");
  const items = document.querySelectorAll(".item-carousel");
  let currentIndex = 0;

  // Tính tổng chiều rộng mỗi item bao gồm margin bên phải
  function getItemWidth() {
    const style = window.getComputedStyle(items[0]);
    const marginRight = parseFloat(style.marginRight);
    return items[0].offsetWidth + marginRight;
  }

  function updateCarousel() {
    const itemWidth = getItemWidth();
    const maxIndex = items.length - 1;
    // Đảm bảo currentIndex không vượt quá maxIndex
    if (currentIndex > maxIndex) currentIndex = maxIndex;
    if (currentIndex < 0) currentIndex = 0;

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
