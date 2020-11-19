var userMenu = document.querySelector('.menu__user');
var userItem = document.querySelector('.menu__about-user');

userMenu.addEventListener('click', function () {
    userItem.classList.toggle('menu__user_open');
})