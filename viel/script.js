document.addEventListener("DOMContentLoaded", function() {
    const track = document.querySelector(".carousel-track");
    const items = document.querySelectorAll(".carousel-item");
    const prevButton = document.querySelector(".carousel-prev");
    const nextButton = document.querySelector(".carousel-next");

    let index = 0;

    // Definindo intervalo de 3 segundos para trocar automaticamente
    setInterval(() => {
        index = (index + 1) % items.length;
        updateCarousel();
    }, 3000);

    nextButton.addEventListener("click", () => {
        index = (index + 1) % items.length;
        updateCarousel();
    });

    prevButton.addEventListener("click", () => {
        index = (index - 1 + items.length) % items.length;
        updateCarousel();
    });

    function updateCarousel() {
        const itemWidth = items[1].offsetWidth; // Use o tamanho da segunda imagem
        track.style.transform = `translateX(${-index * itemWidth}px)`;
    }
});
