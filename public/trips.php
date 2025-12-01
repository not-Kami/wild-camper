<?php
// Page des voyages
?>

<section class="trips-hero">
    <h1>Discover Amazing Destinations</h1>
    <p>Explore our curated travel itineraries and destinations</p>
</section>

<section class="trips-content">
    <div class="trips-intro">
        <h2>Your Next Adventure Awaits</h2>
        <p>Whether you're looking for a scenic road trip through Europe, an off-road adventure in Australia, or a family-friendly journey, we have the perfect itinerary for you.</p>
    </div>
    
    <div class="trips-grid">
        <div class="trip-card">
            <h3>European Road Trip</h3>
            <p>Explore the beautiful landscapes of Europe with our carefully planned routes through France, Spain, and Italy.</p>
        </div>
        <div class="trip-card">
            <h3>Australian Outback</h3>
            <p>Experience the raw beauty of the Australian outback with our rugged adventure packages.</p>
        </div>
        <div class="trip-card">
            <h3>Family Adventures</h3>
            <p>Perfect family-friendly destinations and itineraries for creating lasting memories.</p>
        </div>
    </div>
</section>

<style>
.trips-hero {
    background-color: var(--second-bg-color);
    padding: var(--spacing-xlarge);
    text-align: center;
    color: var(--white-text);
}

.trips-hero h1 {
    font-family: var(--font-secondary);
    font-size: var(--font-size-h1);
    color: var(--light-grey);
    margin: 0 0 var(--spacing-medium) 0;
}

.trips-hero p {
    font-size: var(--font-size-h4);
    color: var(--light-grey);
    margin: 0;
}

.trips-content {
    padding: var(--spacing-xlarge);
    background-color: var(--main-bg-color);
}

.trips-intro {
    max-width: 800px;
    margin: 0 auto var(--spacing-xlarge);
    text-align: center;
}

.trips-intro h2 {
    font-family: var(--font-secondary);
    font-size: var(--font-size-h2);
    color: var(--white-text);
    margin: 0 0 var(--spacing-medium) 0;
}

.trips-intro p {
    font-size: var(--font-size-paragraph);
    color: var(--light-grey);
    line-height: 1.6;
}

.trips-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-large);
    max-width: 1200px;
    margin: 0 auto;
}

.trip-card {
    background-color: var(--second-bg-color);
    padding: var(--spacing-large);
    border-radius: 12px;
    color: var(--white-text);
}

.trip-card h3 {
    font-family: var(--font-primary);
    font-size: var(--font-size-h3);
    color: var(--light-grey);
    margin: 0 0 var(--spacing-medium) 0;
}

.trip-card p {
    font-size: var(--font-size-paragraph);
    color: var(--light-grey);
    line-height: 1.6;
    margin: 0;
}

@media (max-width: 768px) {
    .trips-grid {
        grid-template-columns: 1fr;
    }
}
</style>

