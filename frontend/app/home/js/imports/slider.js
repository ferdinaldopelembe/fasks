export function initPageSlider() {
    const buttons = document.querySelectorAll('.menu-button');
    const toggleButton = document.querySelector('.toggle-menu');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            showPage(button);
        });
    });

    toggleButton.addEventListener('click', () => {
        toggleMenu()
    });
}

function toggleMenu() {
    const menu = document.getElementById('side-menu');
    const compact = !menu.classList.contains('side-menu-compact');
    const appDescription = document.querySelector('.app-description');
    const menuButtonTitles = document.querySelectorAll('.menu-button-title');
    const icon = document.querySelector('.toggle-menu-icon');

    if (compact) {
        appDescription.classList.add('hidden');
        menuButtonTitles.forEach(title => {
            title.classList.add('hidden');
        });
        menu.classList.remove('side-menu');
        menu.classList.add('side-menu-compact');
        icon.classList.remove('fa-chevron-left');
        icon.classList.add('fa-chevron-right');
    } else {
        appDescription.classList.remove('hidden');
        menuButtonTitles.forEach(title => {
            title.classList.remove('hidden');
        });
        menu.classList.remove('side-menu-compact');
        menu.classList.add('side-menu');
        icon.classList.remove('fa-chevron-right');
        icon.classList.add('fa-chevron-left');
    }
}

function showPage(button) {
    const selectedPage = document.getElementById(button.getAttribute('destination'));
    const buttons = document.querySelectorAll('.menu-button');
    buttons.forEach(button => {
        const page = document.getElementById(button.getAttribute('destination'));
        page.classList.add('hidden');
        button.classList.remove('selected');
    });
    selectedPage.classList.remove('hidden');
    button.classList.add('selected');
}