let userMenu = document.querySelector('.menu__user');
let userItem = document.querySelector('.menu__about-user-progress');
let userName = document.querySelector('.menu__user-name');

userMenu.addEventListener('click', function () {
    userItem.classList.toggle('menu__about-user-progress--open');
    userName.classList.toggle('menu__user-name-marker--close');
    userName.classList.toggle('menu__user-name-marker--open');
});