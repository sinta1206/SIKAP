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

// Ripple Effect Profile Card
const profileCard = document.querySelector('.profile-card');

if(profileCard){

    profileCard.addEventListener('click', function(e){

        const circle = document.createElement('span');

        const diameter = Math.max(
            this.clientWidth,
            this.clientHeight
        );

        circle.style.width = circle.style.height = diameter + 'px';

        circle.style.left =
            e.clientX -
            this.getBoundingClientRect().left -
            diameter / 2 + 'px';

        circle.style.top =
            e.clientY -
            this.getBoundingClientRect().top -
            diameter / 2 + 'px';

        circle.classList.add('ripple');

        const ripple = this.querySelector('.ripple');

        if(ripple){
            ripple.remove();
        }

        this.appendChild(circle);
    });

}
