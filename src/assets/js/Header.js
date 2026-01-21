document.addEventListener('DOMContentLoaded', function() {
    
    // ===== HEADER STICKY =====
    let lastScrollTop = 0;
    const header = document.querySelector('.header');

    window.addEventListener('scroll', () => {
        let st = window.pageYOffset || document.documentElement.scrollTop;
        if (st > lastScrollTop && st > header.offsetHeight) {
            // Scroll vers le bas, cacher le header
            header.classList.add('hide');
        } else {
            // Scroll vers le haut, montrer le header
            header.classList.remove('hide');
        }
        lastScrollTop = st <= 0 ? 0 : st;
    });

    header.classList.add('slide-down-animation');

    // ===== BOUTON CONNEXION =====
    const connectBtn = document.querySelector('.header_connect-btn');
    if(connectBtn) {
        connectBtn.addEventListener('click', function() {
            window.location.href = BASE_URL + 'connexion';
        });
    }

    // ===== REDIRECTION LOGO =====
    const logoAccueil = document.getElementById('logo_accueil');
    if(logoAccueil) {
        logoAccueil.addEventListener('click', function() {
            window.location.href = BASE_URL + 'accueil';
        });
    }

    // ===== REDIRECTION NOTIFICATIONS =====
    const notifications = document.getElementById('notifications');
    if(notifications) {
        notifications.addEventListener('click', function() {
            window.location.href = BASE_URL + 'notifications';
        });
    }

    // ===== REDIRECTION PROFIL =====
    const profil = document.getElementById('profil');
    if(profil) {
        profil.addEventListener('click', function() {
            window.location.href = BASE_URL + 'profil';
        });
    }
});