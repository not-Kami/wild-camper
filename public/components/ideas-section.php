<section class="ideas-section">
    <div class="ideas-content">
        <div class="ideas-text">
            <h2>Need ideas for your next adventure?</h2>
            <p>Hop On Board – Let Us Guide Your Next Adventure</p>
        </div>
        <div class="ideas-logo" id="ideasLogo">
            <img src="/img/click me.svg" alt="Click me" class="click-me-svg" id="clickMe">
            <img src="/img/WildCamper - logo inverted.svg" alt="WildCampers Logo" class="logo-mirror" id="logoMirror">
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const clickMe = document.getElementById('clickMe');
    const logoMirror = document.getElementById('logoMirror');
    const ideasText = document.querySelector('.ideas-text');
    
    if (clickMe && logoMirror) {
        clickMe.addEventListener('click', function() {
            // Faire disparaître le click me et le texte
            clickMe.style.opacity = '0';
            clickMe.style.transform = 'scale(0)';
            clickMe.style.transition = 'all 0.5s ease';
            
            if (ideasText) {
                ideasText.style.opacity = '0';
                ideasText.style.transform = 'translateX(-20px)';
                ideasText.style.transition = 'all 0.5s ease';
            }
            
            // Faire avancer la voiture (logo animé)
            setTimeout(function() {
                logoMirror.style.transform = 'translateX(200px) scale(1.2)';
                logoMirror.style.transition = 'transform 2s ease-out';
            }, 500);
            
            // Réinitialiser après 5 secondes
            setTimeout(function() {
                clickMe.style.opacity = '1';
                clickMe.style.transform = 'scale(1)';
                if (ideasText) {
                    ideasText.style.opacity = '1';
                    ideasText.style.transform = 'translateX(0)';
                }
                logoMirror.style.transform = 'translateX(0) scale(1)';
            }, 5000);
        });
    }
});
</script>

