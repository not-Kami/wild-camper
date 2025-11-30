<section class="about-hero">
    <div class="about-hero-content">
        <h1>About WildCampers</h1>
        <h2>Your Ultimate Adventure Companion</h2>
    </div>
</section>

<section class="about-section">
    <div class="about-content">
        <p>Welcome to WildCampers, your premier destination for adventure vehicle rentals. We specialize in providing rugged, reliable vehicles designed for all conditions, including overnight stays in the great outdoors.</p>
        
        <h3>Our Mission</h3>
        <p>At WildCampers, we believe that adventure should be accessible to everyone. Whether you're an outdoor enthusiast, a road trip lover, or simply seeking an adventurous getaway, we provide the perfect solution for exploring the great outdoors with comfort and convenience.</p>
        
        <h3>Why Choose Us?</h3>
        <ul>
            <li><strong>Diverse Fleet:</strong> From 4x4 vehicles to luxury vans, we have the perfect vehicle for your adventure</li>
            <li><strong>All Conditions Ready:</strong> Our vehicles are equipped to handle any terrain and weather condition</li>
            <li><strong>Overnight Capable:</strong> Many of our vehicles are equipped for comfortable overnight stays</li>
            <li><strong>Expert Support:</strong> Our team is here to help you plan the perfect adventure</li>
        </ul>
        
        <h3>Our Story</h3>
        <p>WildCampers was born from a passion for adventure and exploration. We understand the thrill of discovering new places and the freedom that comes with hitting the open road. That's why we've curated a fleet of vehicles that can take you anywhere your heart desires.</p>
    </div>
</section>

<style>
.about-hero {
    background-image: url('/img/hero_couple.png');
    background-size: cover;
    background-position: center;
    min-height: 50vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white-text);
    text-align: center;
    padding: var(--spacing-xlarge);
}

.about-hero-content h1 {
    font-size: var(--font-size-h1);
    color: var(--white-text);
    margin-bottom: var(--spacing-medium);
}

.about-hero-content h2 {
    font-family: var(--font-secondary);
    font-size: var(--font-size-h2);
    color: var(--light-grey);
}

.about-section {
    padding: var(--spacing-xlarge);
    background-color: var(--main-bg-color);
    color: var(--white-text);
}

.about-content {
    max-width: 900px;
    margin: 0 auto;
}

.about-content h1 {
    font-size: var(--font-size-h1);
    color: var(--white-text);
    margin-bottom: var(--spacing-medium);
}

.about-content h2 {
    font-family: var(--font-secondary);
    font-size: var(--font-size-h2);
    color: var(--light-grey);
    margin-bottom: var(--spacing-large);
}

.about-content h3 {
    font-size: var(--font-size-h3);
    color: var(--white-text);
    margin-top: var(--spacing-large);
    margin-bottom: var(--spacing-medium);
}

.about-content p {
    font-size: var(--font-size-paragraph);
    line-height: 1.6;
    margin-bottom: var(--spacing-medium);
    color: var(--light-grey);
}

.about-content ul {
    list-style-type: disc;
    padding-left: var(--spacing-large);
    margin-bottom: var(--spacing-medium);
}

.about-content li {
    margin-bottom: var(--spacing-small);
    color: var(--light-grey);
    line-height: 1.6;
}

.about-content strong {
    color: var(--white-text);
}
</style>

<?php
// Afficher le formulaire de contact
include __DIR__ . '/components/contact.php';
?>

