<section class="carousel-section">
<div id="splide" class="splide">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide item-card">
                <h3>Dodge Ram</h3>
                <div class="image" style="background-image: url('public/img/dodge_ram.png');"></div>
                <div class="description">
                    <p>Description</p>
                    <a href="#" class="button">Learn More</a>
                </div>
            </li>
            <li class="splide__slide item-card">
                <h3>Jeep Wrangler</h3>
                <div class="image" style="background-image: url('public/img/jeep_wrangler.png');"></div>
                <div class="description">
                    <p>Description</p>
                    <a href="#" class="button">Learn More</a>
                </div>
            </li>
            <li class="splide__slide item-card">
                <h3>Land Rover Discovery</h3>
                <div class="image" style="background-image: url('public/img/land_rover_discovery.png');"></div>
                <div class="description">
                    <p>Description 3</p>
                    <a href="#" class="button">Learn More</a>
                </div>
            </li>
            <li class="splide__slide item-card">
                <h3>Mercedes Viano</h3>
                <div class="image" style="background-image: url('public/img/mercedes_viano.png');"></div>
                <div class="description">
                    <p>Description</p>
                    <a href="#" class="button">Learn More</a>
                </div>
            </li>
            <li class="splide__slide item-card">
                <h3>Nissan Patrol</h3>
                <div class="image" style="background-image: url('public/img/nissan_patrol.png');"></div>
                <div class="description">
                    <p>Description</p>
                    <a href="#" class="button">Learn More</a>
                </div>
            </li>
            <li class="splide__slide item-card">
                <h3>Range Rover</h3>
                <div class="image" style="background-image: url('public/img/range_rover.png');"></div>
                <div class="description">
                    <p>Description</p>
                    <a href="#" class="button">Learn More</a>
                </div>
            </li>
            <li class="splide__slide item-card">
                <h3>Toyota Hilux</h3>
                <div class="image" style="background-image: url('public/img/toyota_hilux.png');"></div>
                <div class="description">
                    <p>Description</p>
                    <a href="#" class="button">Learn More</a>
                </div>
            </li>
            <li class="splide__slide item-card">
                <h3>Volvo XC90</h3>
                <div class="image" style="background-image: url('public/img/volvo_xc90.png');"></div>
                <div class="description">
                    <p>Description</p>
                    <a href="#" class="button">Learn More</a>
                </div>
            </li>
            <li class="splide__slide item-card">
                <h3>Volkswagen Caravelle</h3>
                <div class="image" style="background-image: url('public/img/vw_caravelle.png');"></div>
                <div class="description">
                    <p>Description</p>
                    <a href="#" class="button">Learn More</a>
                </div>
            </li>
        </ul>
    </div>
</div>



</section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('#splide', {
                type   : 'loop',
                perPage: 3,
                perMove: 1,
                autoplay: true,
            }).mount();
        });
    </script>
