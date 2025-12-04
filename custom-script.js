document.addEventListener("DOMContentLoaded", function() {
    // Loading Bar Logic
    const loadingBar = document.getElementById('loading-bar');
    if (loadingBar) {
        loadingBar.style.width = '90%';
        window.addEventListener('load', () => {
            loadingBar.style.width = '100%';
            setTimeout(() => { loadingBar.style.opacity = '0'; }, 500);
        });
    }

    // Personalized Name Logic
    const nameModalElement = document.getElementById('nameModal');
    const nameForm = document.getElementById('nameForm');
    const visitorNameInput = document.getElementById('visitorNameInput');
    const dynamicHeroTitle = document.getElementById('dynamic-hero-title');
    const heroParagraph = document.getElementById('hero-paragraph');
    const myName = 'Ghafira Anindya Pasha'; // Default name
    const originalParagraphText = 'Selamat datang di dunia digital Ghafira. Sebagai seorang siswa Rekayasa Perangkat Lunak, Ghafira bersemangat mengubah ide menjadi solusi digital yang inovatif. Jelajahi portofolio untuk melihat karya-karya Ghafira.';

    if (nameModalElement && dynamicHeroTitle && heroParagraph) {
        const storedName = sessionStorage.getItem('visitorName');

        if (storedName) {
            dynamicHeroTitle.textContent = storedName;
            heroParagraph.textContent = `Selamat datang, ${storedName}! ${originalParagraphText}`;
        } else {
            // If no name is stored, show the modal
            const nameModal = new bootstrap.Modal(nameModalElement);
            nameModal.show();

            nameForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const visitorName = visitorNameInput.value.trim();
                if (visitorName) {
                    sessionStorage.setItem('visitorName', visitorName);
                    dynamicHeroTitle.textContent = visitorName;
                    heroParagraph.textContent = `Selamat datang, ${visitorName}! ${originalParagraphText}`;
                    
                    // "Surprise" animation
                    dynamicHeroTitle.classList.add('animate__tada');
                    dynamicHeroTitle.addEventListener('animationend', () => {
                        dynamicHeroTitle.classList.remove('animate__tada');
                    }, { once: true });

                    nameModal.hide();
                } else {
                    // Fallback if name is empty
                    dynamicHeroTitle.textContent = myName;
                    nameModal.hide();
                }
            });
        }
    }

    // tsParticles Initialization
    const particlesContainer = document.getElementById('tsparticles');
    if (particlesContainer) {
        tsParticles.load('tsparticles', {
            fpsLimit: 60,
            interactivity: {
                events: {
                    onHover: {
                        enable: true,
                        mode: 'repulse',
                    },
                    onClick: {
                        enable: true,
                        mode: 'push',
                    },
                    resize: true,
                },
                modes: {
                    push: { quantity: 4 },
                    repulse: { distance: 150, duration: 0.4 },
                },
            },
            particles: {
                color: { value: '#ffffff' },
                links: {
                    color: '#ffffff',
                    distance: 150,
                    enable: true,
                    opacity: 0.5,
                    width: 1,
                },
                collisions: { enable: true },
                move: {
                    direction: 'none',
                    enable: true,
                    outModes: { default: 'bounce' },
                    random: false,
                    speed: 2,
                    straight: false,
                },
                number: {
                    density: { enable: true, area: 800 },
                    value: 80,
                },
                opacity: { value: 0.5 },
                shape: { type: 'circle' },
                size: { value: { min: 1, max: 5 } },
            },
            detectRetina: true,
        });
    }
});