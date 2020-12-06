let userMenu = document.querySelector('.menu__user');
let userItem = document.querySelector('.menu__about-user');
let userName = document.querySelector('.menu__user-name');

userMenu.addEventListener('click', function () {
    userItem.classList.toggle('menu__user_open');
    userName.classList.toggle('menu__user-name-open');
    userName.classList.toggle('menu__user-name');
});