document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    const resultCount = document.querySelector('.results-count');

    // =========================
    // LIVE SEARCH
    // =========================
    if(searchInput && tableBody){

        const rows = tableBody.querySelectorAll('tr');

        searchInput.addEventListener('keyup', () => {

            const keyword = searchInput.value.toLowerCase();
            let count = 0;

            rows.forEach(row => {

                if(row.cells.length < 3) return;

                const nik =
                    row.cells[1].textContent.toLowerCase();

                const nama =
                    row.cells[2].textContent.toLowerCase();

                if(
                    nik.includes(keyword) ||
                    nama.includes(keyword)
                ){
                    row.style.display = '';
                    count++;
                }
                else{
                    row.style.display = 'none';
                }

            });

            if(resultCount){
                resultCount.textContent =
                    `${count} hasil ditemukan`;
            }

        });

    }

    // =========================
    // DELETE CONFIRM
    // =========================
    document
        .querySelectorAll('.btn-delete')
        .forEach(btn => {

            btn.addEventListener('click', (e) => {

                if(
                    !confirm(
                        'Yakin ingin menghapus data ini?'
                    )
                ){
                    e.preventDefault();
                }

            });

        });

    // =========================
    // DRAG & DROP UPLOAD
    // =========================
    const dropzone =
        document.querySelector('.upload-area');

    const fileInput =
        document.getElementById('fileInput');

    if(dropzone && fileInput){

        dropzone.addEventListener('dragover', e => {

            e.preventDefault();
            dropzone.classList.add('dragover');

        });

        dropzone.addEventListener('dragleave', () => {

            dropzone.classList.remove('dragover');

        });

        dropzone.addEventListener('drop', e => {

            e.preventDefault();

            dropzone.classList.remove('dragover');

            const files = e.dataTransfer.files;

            if(files.length > 0){

                fileInput.files = files;

                fileInput
                    .closest('form')
                    .submit();

            }

        });

    }

    // =========================
    // ROW CLICK EFFECT
    // =========================
    if(tableBody){

        tableBody.addEventListener('click', e => {

            const row = e.target.closest('tr');

            if(!row) return;

            row.style.backgroundColor =
                '#f0f7ff';

            setTimeout(() => {

                row.style.backgroundColor = '';

            }, 250);

        });

    }

});
