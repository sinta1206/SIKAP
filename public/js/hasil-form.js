document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('formEditHasil');
    const submitBtn = document.querySelector('.btn-submit');

    form.addEventListener('submit', () => {

        submitBtn.classList.add('ng');

        submitBtn.innerHTML = 'Menyimpan...';

    });

});

