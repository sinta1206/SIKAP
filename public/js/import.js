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

function toggleInfo(id)
{
    const allBoxes =
        document.querySelectorAll('.detail-box');

    allBoxes.forEach(box => {

        if(box.id !== id){
            box.style.display = 'none';
        }

    });

    const selected =
        document.getElementById(id);

    if(selected.style.display === 'block'){
        selected.style.display = 'none';
    }else{
        selected.style.display = 'block';
    }
}

function closeInfo(id)
{
    document.getElementById(id).style.display = 'none';
}


// ======================================
// RIPPLE EFFECT BUTTON TAMBAH DATA
// ======================================

const addButton =
    document.querySelector('.btn-add-data');

if(addButton){

    addButton.addEventListener('click', function(e){

        const circle =
            document.createElement('span');

        const diameter =
            Math.max(
                this.clientWidth,
                this.clientHeight
            );

        circle.style.width =
            circle.style.height =
            `${diameter}px`;

        circle.style.left =
            `${e.offsetX - diameter/2}px`;

        circle.style.top =
            `${e.offsetY - diameter/2}px`;

        circle.classList.add('ripple');

        const ripple =
            this.querySelector('.ripple');

        if(ripple){
            ripple.remove();
        }

        this.appendChild(circle);

    });

}
