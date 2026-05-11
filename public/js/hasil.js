document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');

    if (!searchInput || !tableBody) return;

    const rows = tableBody.getElementsByTagName('tr');

    // SEARCH
    searchInput.addEventListener('keyup', function() {
        const keyword = searchInput.value.toLowerCase();
        let count = 0;

        for (let i = 0; i < rows.length; i++) {
            const nik = rows[i].cells[1]?.textContent.toLowerCase() || '';
            const nama = rows[i].cells[2]?.textContent.toLowerCase() || '';

            if (nik.includes(keyword) || nama.includes(keyword)) {
                rows[i].style.display = "";
                count++;
            } else {
                rows[i].style.display = "none";
            }
        }

        document.querySelector('.results-count').textContent = `${count} hasil ditemukan`;
    });

    // klik row
    tableBody.addEventListener('click', (e) => {
        const tr = e.target.closest('tr');
        if (tr) {
            tr.style.backgroundColor = "#f0f7ff";
            setTimeout(() => {
                tr.style.backgroundColor = "";
            }, 200);
        }
    });

});
