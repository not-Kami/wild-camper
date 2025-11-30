<section class="explore-section">
    <h2 class="explore-title">Explore Beyond Borders</h2>
    <div class="explore-content">
        <div class="explore-text">
            <p>Discover the freedom to explore new horizons with our range of fully equipped campervans and Jeeps. Whether you're planning a scenic road trip across Europe or an off-the-beaten-path journey in Australia, embark on an unforgettable experience tailored to your wanderlust.</p>
            <a href="/index.php?page=booking" class="explore-button">Book now!</a>
        </div>
    </div>
</section>

<style>
.explore-section {
    background-color: var(--second-bg-color);
    background-image: url('/img/image-removebg-preview 1.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: var(--spacing-xlarge);
    min-height: 800px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    position: relative;
}

.explore-title {
    font-family: "Roboto", Helvetica;
    font-weight: 700;
    font-size: 40px;
    color: var(--white-text);
    margin: 0 0 var(--spacing-xlarge) 0;
    padding-top: 80px;
    text-align: center;
    width: 100%;
}

.explore-content {
    max-width: 1400px;
    width: 100%;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.explore-text {
    color: var(--white-text);
    display: flex;
    flex-direction: column;
    gap: var(--spacing-large);
    align-items: flex-end;
    text-align: right;
    max-width: 546px;
    margin-right: 114px;
}

.explore-button {
    background-color: var(--kaki-green);
    color: var(--white-text);
    padding: 12px 32px;
    border-radius: 50px;
    text-decoration: none;
    font-family: "Roboto", Helvetica;
    font-weight: 700;
    font-size: 16px;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.explore-button:hover {
    background-color: var(--accent-brown);
}

.explore-text p {
    font-size: var(--font-size-paragraph);
    line-height: 1.6;
    color: var(--light-grey);
    margin: 0;
}

@media (max-width: 1024px) {
    .explore-content {
        justify-content: center;
    }
    
    .explore-text {
        margin-right: 0;
        align-items: center;
        text-align: center;
        max-width: 100%;
    }
}
</style>

