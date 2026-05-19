document.addEventListener('DOMContentLoaded', () => {

    // =========================
    // SEARCH TABLE
    // =========================
    const searchInput = document.querySelector('.search-box input');

    if(searchInput){

        searchInput.addEventListener('input', function () {

            const searchText = this.value.toLowerCase();

            const tableRows = document.querySelectorAll('#tableBody tr');

            tableRows.forEach(row => {

                // Hindari error kalau row kosong
                if(row.cells.length > 2){

                    const nikText = row.cells[1].textContent.toLowerCase();
                    const namaText = row.cells[2].textContent.toLowerCase();

                    if (
                        nikText.includes(searchText) ||
                        namaText.includes(searchText)
                    ) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }

                }

            });

        });

    }

    // =========================
    // DELETE CONFIRMATION
    // =========================
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {

        button.addEventListener('click', function (e) {

            const confirmDelete = confirm('Yakin ingin menghapus data ini?');

            if(!confirmDelete){
                e.preventDefault();
            }

        });

    });

    // =========================
    // DRAG & DROP UPLOAD
    // =========================
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');

    if(dropzone && fileInput){

        // Klik upload
        dropzone.addEventListener('click', () => {
            fileInput.click();
        });

        // Drag over
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });

        // Drag leave
        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('dragover');
        });

        // Drop file
        dropzone.addEventListener('drop', (e) => {

            e.preventDefault();

            dropzone.classList.remove('dragover');

            const files = e.dataTransfer.files;

            if(files.length > 0){

                fileInput.files = files;

                // Auto submit form upload
                fileInput.closest('form').submit();

            }

        });

    }

});
