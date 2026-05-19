document.addEventListener('DOMContentLoaded', () => {

    const form = document.querySelector('form');
    const btnBatal = document.querySelector('.btn-batal');

    // 1. FUNGSI TOMBOL SIMPAN
    form.addEventListener('submit', (e) => {

        // Ambil semua data form
        const formData = new FormData(form);
        const dataPenduduk = Object.fromEntries(formData.entries());

        console.log("Data yang akan diupdate:", dataPenduduk);

        // VALIDASI SEDERHANA
        if (!dataPenduduk.nik || !dataPenduduk.nama) {

            e.preventDefault();

            alert("NIK dan Nama wajib diisi!");

            return;
        }

        // VALIDASI NIK
        if (dataPenduduk.nik.length !== 16) {

            e.preventDefault();

            alert("NIK harus terdiri dari 16 digit!");

            return;
        }

        // KONFIRMASI UPDATE
        const confirmUpdate = confirm(
            "Apakah Anda yakin ingin menyimpan perubahan data?"
        );

        if (!confirmUpdate) {

            e.preventDefault();

        }

    });

    // 2. FUNGSI TOMBOL BATAL
    if(btnBatal){

        btnBatal.addEventListener('click', () => {

            const confirmCancel = confirm(
                "Apakah Anda yakin ingin membatalkan? Perubahan data tidak akan disimpan."
            );

            if(confirmCancel){

                window.location.href = "/penduduk";

            }

        });

    }

    // 3. FORMAT NIK (HANYA ANGKA)
    const inputNIK = document.querySelector('input[name="nik"]');

    if(inputNIK){

        inputNIK.addEventListener('input', (e) => {

            e.target.value = e.target.value.replace(/[^0-9]/g, '');

        });

    }

});
