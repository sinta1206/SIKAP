document.addEventListener('DOMContentLoaded', () => {

    // ===== ACTION HANDLER =====
    function handleAction(type) {

        console.log("Membuka menu:", type);

        switch (type) {

            case 'Klasifikasi':
                window.location.href = "/klasifikasi";
                break;

            case 'Hasil':
                window.location.href = "/hasil";
                break;

            case 'Kriteria':
                alert("Fitur pengaturan kriteria akan segera tersedia.");
                break;

            case 'Import':
                window.location.href = "/penduduk";
                break;

            default:
                console.log("Action tidak dikenali:", type);
        }
    }

    // expose ke global (karena dipakai di onclick blade)
    window.handleAction = handleAction;


    // ===== EFFECT CLICK NIMBUL =====
    const items = document.querySelectorAll('.action-item');

    if (items.length > 0) {

        items.forEach(item => {

            item.addEventListener('click', function () {

                // efek border animasi
                this.style.borderColor = '#3b82f6';

                setTimeout(() => {
                    this.style.borderColor = '#e5e7eb';
                }, 250);

            });

        });

    }

});
