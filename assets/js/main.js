// Controle do Menu Mobile
document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuLinks = mobileMenu.querySelectorAll('a');
    
    // Função para alternar o menu
    function toggleMenu() {
        mobileMenu.classList.toggle('hidden');
        
        // Adiciona uma pequena animação de fade
        if (!mobileMenu.classList.contains('hidden')) {
            mobileMenu.style.opacity = '0';
            setTimeout(() => {
                mobileMenu.style.opacity = '1';
            }, 10);
        }
    }
    
    // Evento de clique no botão do menu
    menuButton.addEventListener('click', toggleMenu);
    
    // Fecha o menu ao clicar em um link
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    });
    
    // Fecha o menu ao clicar fora dele
    document.addEventListener('click', (e) => {
        if (!menuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
            mobileMenu.classList.add('hidden');
        }
    });
});

// Fecha o menu mobile ao clicar em um link
const mobileMenuLinks = mobileMenu.querySelectorAll('a');
mobileMenuLinks.forEach(link => {
    link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
    });
}); 