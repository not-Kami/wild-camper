<section class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Welcome to <span class="logo-text">WildCampers</span></h1>
            <p>Your Ultimate Adventure Companion!</p>
        </div>
        <a href="/index.php?page=booking" class="button hero-button">BOOK NOW</a>
    </div>
</section>

<style>
.hero {
    background-image: url('/img/hero_land_rover.png');
    background-size: cover;
    background-position: center;
    min-height: 70vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: var(--spacing-xlarge);
    box-sizing: border-box;
    position: relative;
}

.hero-content {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 32px;
    max-width: 546px;
    margin-right: 114px;
}

.hero-text {
    display: flex;
    flex-direction: column;
    gap: 25px;
    align-items: flex-start;
}

.hero-text h1 {
    font-family: var(--h1-font-family, "Roboto", Helvetica);
    font-weight: 700;
    font-size: 40px;
    color: var(--light-grey);
    margin: 0;
    line-height: normal;
}

.hero-text h1 .logo-text {
    font-family: var(--font-secondary, "Yellowtail", cursive);
    font-weight: 400;
}

.hero-text p {
    font-family: var(--h1-font-family, "Roboto", Helvetica);
    font-weight: 700;
    font-size: 24px;
    color: var(--light-grey);
    margin: 0;
    line-height: normal;
}

.hero-button {
    width: 146px;
    height: 39px;
    background-color: var(--kaki-green);
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--btn-font-family, "Roboto", Helvetica);
    font-weight: 700;
    font-size: 16px;
    color: var(--white-text);
    text-decoration: none;
    margin-left: 114px;
    transition: all 0.3s ease;
}

.hero-button:hover {
    background-color: var(--accent-brown);
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .hero {
        justify-content: center;
        align-items: center;
        padding: var(--spacing-large) var(--spacing-medium);
        min-height: 60vh;
    }
    
    .hero-content {
        margin-right: 0;
        align-items: center;
        text-align: center;
        max-width: 100%;
        gap: var(--spacing-large);
    }
    
    .hero-text {
        align-items: center;
        gap: var(--spacing-medium);
    }
    
    .hero-text h1 {
        font-size: 28px;
        text-align: center;
        line-height: 1.3;
    }
    
    .hero-text h1 .logo-text {
        display: block;
        font-size: 32px;
    }
    
    .hero-text p {
        font-size: 18px;
        text-align: center;
    }
    
    .hero-button {
        margin-left: 0;
        width: 130px;
        height: 36px;
        font-size: 14px;
        align-self: center;
        margin-right: 0;
    }
    
    .hero-content {
        align-items: center !important;
    }
}
</style>
