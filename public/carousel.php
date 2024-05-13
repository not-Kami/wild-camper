

    <style>
        .carousel {
            display: flex;
            overflow-x: scroll;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .item-card {
            flex: 0 0 auto;
            width: calc(100% / 3); /* Adjusts the width to show 3 cards */
            scroll-snap-align: start;
            padding: 0 10px;
        }
    </style>

    <div class="carousel">
        <div class="item-card">
            <img src="img/dodge_ram.png" alt="Image 1">
            <h3>Title 1</h3>
            <p>Description 1</p>
            <a href="#" class="learn-more">Learn More</a>
        </div>
        <div class="item-card">
            <img src="img/jeep_wrangler.png" alt="Image 2">
            <h3>Title 2</h3>
            <p>Description 2</p>
            <a href="#" class="learn-more">Learn More</a>
        </div>
        <div class="item-card">
            <img src="img/land_rover_discovery.png" alt="Image 3">
            <h3>Title 3</h3>
            <p>Description 3</p>
            <a href="#" class="learn-more">Learn More</a>
        </div>
        <div class="item-card">
            <img src="img/mercedes_viano.png" alt="Image 1">
            <h3>Title 1</h3>
            <p>Description 1</p>
            <a href="#" class="learn-more">Learn More</a>
        </div>
        <div class="item-card">
            <img src="img/nissan_patrol.png" alt="Image 2">
            <h3>Title 2</h3>
            <p>Description 2</p>
            <a href="#" class="learn-more">Learn More</a>
        </div>
        <div class="item-card">
            <img src="img/range_rover.png" alt="Image 3">
            <h3>Title 3</h3>
            <p>Description 3</p>
            <a href="#" class="learn-more">Learn More</a>
        </div>
        <div class="item-card">
            <img src="img/toyota-hilux.png" alt="Image 1">
            <h3>Title 1</h3>
            <p>Description 1</p>
            <a href="#" class="learn-more">Learn More</a>
        </div>
        <div class="item-card">
            <img src="img/volov.png" alt="Image 2">
            <h3>Title 2</h3>
            <p>Description 2</p>
            <a href="#" class="learn-more">Learn More</a>
        </div>
        <div class="item-card">
            <img src="img/dodge_ram.png" alt="Image 3">
            <h3>Title 3</h3>
            <p>Description 3</p>
            <a href="#" class="learn-more">Learn More</a>
        </div>
    </div>

    <script>
        const carousel = document.querySelector('.carousel');
        let currentIndex = 0;
        let isDragging = false;
        let startX, scrollLeft;

        function showImage(index) {
            const images = carousel.querySelectorAll('img');
            images.forEach((image, i) => {
                if (i === index) {
                    image.style.display = 'block';
                } else {
                    image.style.display = 'none';
                }
            });
        }

        function moveImage(e) {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX || e.touches[0].pageX;
            const walk = (x - startX) * 3; //scroll-fast
            carousel.scrollLeft = scrollLeft - walk;
            let index = Math.round(carousel.scrollLeft / carousel.offsetWidth);
            if (index >= carousel.querySelectorAll('img').length) {
                index = 0;
                carousel.scrollLeft = 0;
            } else if (index < 0) {
                index = carousel.querySelectorAll('img').length - 1;
                carousel.scrollLeft = carousel.offsetWidth * index;
            }
            currentIndex = index;
            showImage(currentIndex);
        }

        carousel.addEventListener('mousedown', (e) => {
            isDragging = true;
            carousel.style.cursor = 'grabbing';
            startX = e.pageX;
            scrollLeft = carousel.scrollLeft;
        });

        carousel.addEventListener('touchstart', (e) => {
            isDragging = true;
            startX = e.touches[0].pageX;
            scrollLeft = carousel.scrollLeft;
        });

        carousel.addEventListener('mouseup', () => {
            isDragging = false;
            carousel.style.cursor = 'grab';
        });

        carousel.addEventListener('mouseleave', () => {
            isDragging = false;
        });

        carousel.addEventListener('touchend', () => {
            isDragging = false;
        });

        carousel.addEventListener('mousemove', moveImage);
        carousel.addEventListener('touchmove', moveImage);
    </script>