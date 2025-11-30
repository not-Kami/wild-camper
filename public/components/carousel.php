<?php
// Inclure les composants nécessaires
include __DIR__ . '/vehicle-card.php';
include __DIR__ . '/carousel-card.php';
?>

<section class="carousel-section">
    <div class="carousel-container">
        <?php
        // Afficher les 3 premiers véhicules dans le carousel
        $featuredVehicles = array_slice($vehicles, 0, 3);
        foreach ($featuredVehicles as $vehicle) {
            renderCarouselCard(
                $vehicle['image'],
                $vehicle['name'],
                $vehicle['description'],
                '#'
            );
        }
        ?>
    </div>
</section>

<style>
.carousel-section {
    background-color: var(--main-bg-color);
    padding: 60px 1rem;
    width: 100%;
    box-sizing: border-box;
}

.carousel-container {
    display: flex;
    gap: 4rem;
    justify-content: center;
    align-items: stretch;
    max-width: 100%;
    margin: 0 auto;
    flex-wrap: nowrap;
    padding: 0 2rem;
}

.carousel-card {
    width: 300px;
    height: 446px;
    flex: 0 0 300px;
    max-width: 300px;
    background-color: #1e1e1e;
    border-radius: 20px 0 16px 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
    position: relative;
}

.card-header {
    width: 100%;
    height: 49px; /* 10.99% de 446px */
    background-color: #d9d9d9;
    padding: 15px 58px;
    border-radius: 20px 0 0 0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    position: relative;
    z-index: 2;
    box-sizing: border-box;
}

.card-image {
    width: 100%;
    height: 218px; /* 48.88% de 446px */
    overflow: hidden;
    background-color: #d9d9d9;
    position: relative;
    flex-shrink: 0;
    z-index: 1;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card-header h3 {
    font-family: "Roboto", Helvetica;
    font-weight: 700;
    font-size: 16px;
    color: var(--kaki-green);
    margin: 0;
    text-align: center;
}

.card-content {
    width: 100%;
    height: 179px; /* 40.13% de 446px */
    background-color: #1e1e1e;
    padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    position: relative;
    flex-shrink: 0;
    box-sizing: border-box;
}

.card-content p {
    width: 85.26%;
    margin: 20px auto 0 auto;
    padding: 0 7.37%;
    font-family: "Roboto", Helvetica;
    font-weight: 700;
    font-size: 12px;
    color: #ffffff;
    line-height: 1.5;
    text-align: center;
    display: block;
    flex-grow: 1;
}

.card-learn-more {
    width: 48.42%;
    min-width: 120px;
    height: 48px;
    margin: auto auto 20px auto;
    background-color: var(--kaki-green);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: "Roboto", Helvetica;
    font-weight: 700;
    font-size: 16px;
    color: #ffffff;
    text-decoration: none;
    transition: background-color 0.3s ease;
    flex-shrink: 0;
    position: relative;
    box-sizing: border-box;
}

.card-learn-more:hover {
    background-color: var(--accent-brown);
    /* Pas de transform pour éviter le décalage */
}

/* Responsive */
@media (max-width: 1200px) {
    .carousel-section {
        padding: 60px 1rem;
    }
    
    .carousel-container {
        gap: 3rem;
        padding: 0 1.5rem;
    }
}

@media (max-width: 1024px) {
    .carousel-section {
        padding: 50px 1rem;
    }
    
    .carousel-container {
        gap: 2.5rem;
        padding: 0 1rem;
    }
}

@media (max-width: 768px) {
    .carousel-container {
        flex-direction: column;
        align-items: center;
        gap: var(--spacing-large);
        flex-wrap: wrap;
    }
    
    .carousel-card {
        width: 100%;
        max-width: 400px;
        flex: 0 0 auto;
    }
}
</style>
