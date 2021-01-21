let addPointsButton = document.querySelector('.actions__add-points');
let addPointsForm = document.querySelector('.actions__form-add');

addPointsButton.addEventListener('click', function () {
    addPointsForm.classList.toggle('actions__form--open');
});
