//  Javascript file for the home page

// Alertes
document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner l'alerte
    const alert = document.getElementById('alert');

    // Masquer l'alerte après 5 secondes
    if (alert) {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000); // 5000 millisecondes = 5 secondes
    }
});

// ------------------------------------------------------------------------------------------------
//  Diaporama 

document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelector('.slide-images');
    const totalSlides = slides.children.length;
    let currentIndex = 0;
    let slideInterval;

    // Fonction pour démarrer le diaporama
    const startSlideshow = () => {
        slideInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalSlides; 
            slides.style.transform = `translateX(-${currentIndex * 100}%)`;
        }, 3000);
    };

    // Fonction pour arrêter le diaporama
    const stopSlideshow = () => {
        clearInterval(slideInterval);
    };

    // Démarrage initial du diaporama
    startSlideshow();

    // Ajout des événements de hover
    slides.addEventListener('mouseenter', stopSlideshow);
    slides.addEventListener('mouseleave', startSlideshow);

    // Event slider
    const eventCards = document.querySelector('.event-cards');
    const prevBtn = document.querySelector('.nav-btn.prev');
    const nextBtn = document.querySelector('.nav-btn.next');
    const cardWidth = 300 + 20; // Inclure l'espace entre les cartes
    let currentEventIndex = 0;

    nextBtn.addEventListener('click', () => {
        if (currentEventIndex < eventCards.children.length - 3) {
            currentEventIndex++;
            eventCards.style.transform = `translateX(-${currentEventIndex * cardWidth}px)`;
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentEventIndex > 0) {
            currentEventIndex--;
            eventCards.style.transform = `translateX(-${currentEventIndex * cardWidth}px)`;
        }
    });
});
//------------------------------------------------------------------------------------------------


// section des  partenaires
document.addEventListener('DOMContentLoaded', function () {
    const partnersList = document.querySelector('.partners-list');
    const prevBtn = document.querySelector('.p-nav-btn.prev');
    const nextBtn = document.querySelector('.p-nav-btn.next');

    let scrollIndex = 0;
    const cardWidth = 170; // Width of the card + gap
    const visibleCards = Math.floor(partnersList.offsetWidth / cardWidth);

    nextBtn.addEventListener('click', () => {
        if (scrollIndex < partnersList.children.length - visibleCards) {
            scrollIndex++;
            partnersList.style.transform = `translateX(-${scrollIndex * cardWidth}px)`;
        }
    });

    prevBtn.addEventListener('click', () => {
        if (scrollIndex > 0) {
            scrollIndex--;
            partnersList.style.transform = `translateX(-${scrollIndex * cardWidth}px)`;
        }
    });
});

//------------------------------------------------------------------------------------------------