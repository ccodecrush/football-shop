document.addEventListener('DOMContentLoaded', function() {
  const iconMenu = document.querySelector('.icon-menu');
  const menuBody = document.querySelector('.container__navigation');
  const body = document.querySelector('body');

  if (iconMenu && menuBody && body) {
    const initialActive = iconMenu.classList.contains('_active');

    function toggleMenu() {
      iconMenu.classList.toggle('_active');
      menuBody.classList.toggle('_active');

      if (menuBody.classList.contains('_active')) {
        lockScroll();
      } else {
        unlockScroll();
      }
    }

    if (initialActive) {
      toggleMenu();
    }

    iconMenu.addEventListener('click', toggleMenu);
  } else {
    console.error('Nie znaleziono elementów');
  }
});

function lockScroll() {
  const body = document.querySelector('body');
  body.classList.add('scroll-lock');
}

function unlockScroll() {
  const body = document.querySelector('body');
  body.classList.remove('scroll-lock');
}
