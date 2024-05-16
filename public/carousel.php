<div class="carousel">
    <div class="carousel-wrapper">
        <div class="item-card">
            <h3>Dodge Ram</h3>
            <img src="img/dodge_ram.png" alt="Dodge Ram">
            <p>Starting at $400 a week</p>
            <button class="button">Learn More</button>
        </div>
        <div class="item-card">
            <h3>Jeep Wrangler</h3>
            <img src="img/jeep_wrangler.png" alt="Jeep Wrangler">
            <p>Starting at $450 a week</p>
            <button class="button">Learn More</button>
        </div>
        <div class="item-card">
            <h3>Land Rover Discovery</h3>
            <img src="img/land_rover_discovery.png" alt="Land Rover Discovery">
            <p>Starting at $500 a week</p>
            <button class="button">Learn More</button>
        </div>
        <div class="item-card">
            <h3>Mercedes Viano</h3>
            <img src="img/mercedes_viano.png" alt="Mercedes Viano">
            <p>Starting at $550 a week</p>
            <button class="button">Learn More</button>
        </div>
        <div class="item-card">
            <h3>Nissan Patrol</h3>
            <img src="img/nissan_patrol.png" alt="Nissan Patrol">
            <p>Starting at $600 a week</p>
            <button class="button">Learn More</button>
        </div>
        <div class="item-card">
            <h3>Range Rover</h3>
            <img src="img/range_rover.png" alt="Range Rover">
            <p>Starting at $650 a week</p>
            <button class="button">Learn More</button>
        </div>
        <div class="item-card">
            <h3>Toyota Hilux</h3>
            <img src="img/toyota_hilux.png" alt="Toyota Hilux">
            <p>Starting at $700 a week</p>
            <button class="button">Learn More</button>
        </div>
        <div class="item-card">
            <h3>Volvo XC90</h3>
            <img src="img/volvo_xc90.png" alt="Volvo XC 90">
            <p>Starting at $750 a week</p>
            <button class="button">Learn More</button>
        </div>
        <div class="item-card">
            <h3>Volkswagen Caravelle</h3>
            <img src="img/vw_caravelle.png" alt="Volkswagen Caravelle">
            <p>Starting at $800 a week</p>
            <button class="button">Learn More</button>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.carousel');
    const carouselWrapper = document.querySelector('.carousel-wrapper');
    const items = document.querySelectorAll('.item-card');
    const prevButton = document.createElement('button');
    const nextButton = document.createElement('button');

    prevButton.classList.add('carousel-button', 'left');
    nextButton.classList.add('carousel-button', 'right');

    prevButton.innerHTML = '&#9664;'; // Left arrow
    nextButton.innerHTML = '&#9654;'; // Right arrow

    carousel.appendChild(prevButton);
    carousel.appendChild(nextButton);

    let index = 1;

    // Clone first and last items
    const firstClone = items[0].cloneNode(true);
    const lastClone = items[items.length - 1].cloneNode(true);

    // Add classes for identification
    firstClone.classList.add('clone');
    lastClone.classList.add('clone');

    // Append clones to the wrapper
    carouselWrapper.appendChild(firstClone);
    carouselWrapper.insertBefore(lastClone, items[0]);

    // Update the items NodeList after cloning
    const updatedItems = document.querySelectorAll('.item-card');

    function updateCarousel() {
        const itemWidth = updatedItems[0].offsetWidth;
        carouselWrapper.style.transform = `translateX(${-index * itemWidth}px)`;
    }

    function jumpToEnd() {
        const itemWidth = updatedItems[0].offsetWidth;
        carouselWrapper.classList.add('no-transition');
        index = updatedItems.length - 2;
        carouselWrapper.style.transform = `translateX(${-index * itemWidth}px)`;
        setTimeout(() => {
            carouselWrapper.classList.remove('no-transition');
        }, 50);
    }

    function jumpToStart() {
        const itemWidth = updatedItems[0].offsetWidth;
        carouselWrapper.classList.add('no-transition');
        index = 1;
        carouselWrapper.style.transform = `translateX(${-index * itemWidth}px)`;
        setTimeout(() => {
            carouselWrapper.classList.remove('no-transition');
        }, 50);
    }

    prevButton.addEventListener('click', () => {
        if (index > 0) {
            index--;
            updateCarousel();
        }

        if (index === 0) {
            setTimeout(jumpToEnd, 300);
        }
    });

    nextButton.addEventListener('click', () => {
        if (index < updatedItems.length - 1) {
            index++;
            updateCarousel();
        }

        if (index === updatedItems.length - 1) {
            setTimeout(jumpToStart, 300);
        }
    });

    window.addEventListener('resize', updateCarousel);

    // Initialize carousel position
    updateCarousel();
});

</script>