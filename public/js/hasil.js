document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    const resultCount = document.querySelector('.results-count');

    if (!searchInput || !tableBody) return;

    const rows = tableBody.getElementsByTagName('tr');

    // =========================
    // SEARCH DATA (NIK & NAMA)
    // =========================
    searchInput.addEventListener('keyup', function () {

        const keyword = searchInput.value.toLowerCase();
        let count = 0;

        for (let i = 0; i < rows.length; i++) {

            // Hindari row kosong
            if (rows[i].cells.length <= 1) continue;

            const nik = rows[i].cells[1]?.textContent.toLowerCase() || '';
            const nama = rows[i].cells[2]?.textContent.toLowerCase() || '';

            if (nik.includes(keyword) || nama.includes(keyword)) {

                rows[i].style.display = '';
                count++;

            } else {

                rows[i].style.display = 'none';

            }
        }

        // Update jumlah hasil
        if (resultCount) {
            resultCount.textContent = `${count} hasil ditemukan`;
        }

    });

    // =========================
    // EFEK KLIK ROW
    // =========================
    tableBody.addEventListener('click', (e) => {

        const tr = e.target.closest('tr');

        if (tr) {

            tr.style.backgroundColor = '#f0f7ff';

            setTimeout(() => {
                tr.style.backgroundColor = '';
            }, 200);

        }

    });

    // =========================
    // PRINT
    // =========================
    const printBtn = document.querySelector('.btn-red');

    if (printBtn) {

        printBtn.addEventListener('click', () => {
            window.print();
        });

    }

});
