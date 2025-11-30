<section class="ideas-section">
    <div class="ideas-content">
        <div class="ideas-text">
            <h2>Need ideas for your next adventure?</h2>
            <p>Hop On Board – Let Us Guide Your Next Adventure</p>
        </div>
        <div class="ideas-logo">
            <img src="/img/click me.svg" alt="Click me" class="click-me-svg">
            <img src="/img/WildCamper - logo inverted.svg" alt="WildCampers Logo" class="logo-mirror">
        </div>
    </div>
</section>

<style>
.ideas-section {
    background-color: var(--main-bg-color);
    padding: var(--spacing-xlarge);
    text-align: center;
}

.ideas-content {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    gap: var(--spacing-xlarge);
}

.ideas-text {
    flex: 1;
    text-align: left;
}

.ideas-text h2 {
    font-family: "Roboto", Helvetica;
    font-size: var(--font-size-h1);
    color: var(--kaki-green);
    font-weight: 700;
    margin: 0 0 var(--spacing-medium) 0;
}

.ideas-text p {
    font-family: "Roboto", Helvetica;
    font-size: var(--font-size-h3);
    color: var(--light-grey);
    margin: 0;
}

.ideas-logo {
    position: relative;
    width: 200px;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.logo-mirror {
    width: 100%;
    height: 100%;
    object-fit: contain;
    position: relative;
    top: 20px;
}

.click-me-svg {
    position: absolute;
    top: -50px;
    right: -70px;
    width: 132px;
    height: 80px;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@media (max-width: 768px) {
    .ideas-content {
        flex-direction: column;
        align-items: center;
        gap: var(--spacing-large);
    }
    
    .ideas-text {
        text-align: center;
    }
    
    .ideas-text h2 {
        font-size: var(--font-size-h2);
    }
    
    .ideas-text p {
        font-size: var(--font-size-paragraph);
    }
    
    .ideas-logo {
        width: 150px;
        height: 150px;
    }
    
    .click-me-svg {
        top: -40px;
        right: -50px;
        width: 100px;
        height: 60px;
    }
}
</style>

