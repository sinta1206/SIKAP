document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', function() {

        // Hapus semua active
        document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));

        // Hapus arrow lama
        const existingArrow = document.querySelector('.arrow');
        if (existingArrow) existingArrow.remove();

        // Tambah active
        this.classList.add('active');

        // Tambah arrow hanya di dashboard
        if (this.innerText.includes('Dashboard')) {
            const arrow = document.createElement('i');
            arrow.className = 'fa-solid fa-chevron-right arrow';
            arrow.style.marginLeft = 'auto';
            this.appendChild(arrow);
        }
    });
});
