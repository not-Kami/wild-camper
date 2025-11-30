<div class="contact-section">
    <div class="contact-info">
        <h3>Ready for Adventure?</h3>
        <p>Connect with us to start your journey! Fill out the form below and a member of our TrailBlazer Rentals team will get back to you shortly to help gear up for your next great escape.</p>
    </div>
    <div class="contact-form">
        <form action="" method="POST">
            <div class="form-group">
                <input type="text" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <textarea id="message" name="message" placeholder="Message" required></textarea>
            </div>
            <button type="submit" class="button submit-btn">Submit</button>
        </form>
    </div>
</div>

<style>
.contact-section {
    background-color: var(--second-bg-color);
    padding: var(--spacing-xlarge);
    display: flex;
    gap: 179px;
    align-items: center;
    justify-content: center;
    width: 100%;
    box-sizing: border-box;
}

.contact-info {
    flex: 0 0 426px;
    max-width: 426px;
}

.contact-info h3 {
    font-family: "Roboto", Helvetica;
    font-weight: 700;
    font-size: 32px;
    color: var(--light-grey);
    margin: 0 0 var(--spacing-medium) 0;
}

.contact-info p {
    font-family: "Roboto", Helvetica;
    font-weight: 400;
    font-size: 16px;
    color: var(--light-grey);
    line-height: 1.6;
    margin: 0;
}

.contact-form {
    flex: 1;
    max-width: 428px;
}

.form-group {
    margin-bottom: var(--spacing-medium);
    position: relative;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 15px 20px;
    background-color: #d9d9d9;
    border: none;
    border-radius: 23px;
    font-family: "Roboto", Helvetica;
    font-weight: 700;
    font-size: 16px;
    color: #1e1e1e;
    box-sizing: border-box;
}

.form-group input {
    height: 50px;
}

.form-group textarea {
    height: 200px;
    resize: vertical;
    font-family: "Roboto", Helvetica;
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: #1e1e1e;
    opacity: 1;
    font-family: "Roboto", Helvetica;
    font-weight: 700;
    font-size: 16px;
}

.submit-btn {
    width: 120px;
    height: 47px;
    background-color: var(--kaki-green);
    border-radius: 34.5px;
    border: none;
    font-family: "Roboto", Helvetica;
    font-weight: 700;
    font-size: 16px;
    color: #ffffff;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: var(--spacing-medium);
}

.submit-btn:hover {
    background-color: var(--accent-brown);
}

@media (max-width: 1024px) {
    .contact-section {
        flex-direction: column;
        gap: var(--spacing-xlarge);
        padding: var(--spacing-large);
    }
    
    .contact-info,
    .contact-form {
        width: 100%;
        max-width: 500px;
    }
}
</style>
