function handleAction(type) {
    console.log("Membuka menu: " + type);

    if(type === 'Klasifikasi') {
        alert("Memulai proses klasifikasi data penduduk...");
    } else if(type === 'Hasil') {
        alert("Menuju halaman Tabel Kelayakan.");
    } else if(type === 'Kriteria') {
        alert("Membuka pengaturan kriteria pemilu.");
    }
}

// aman biar tidak error
document.querySelectorAll('.action-item').forEach(item => {
    item.addEventListener('click', function() {
        this.style.borderColor = '#3b82f6';
        setTimeout(() => {
            this.style.borderColor = '#e5e7eb';
        }, 300);
    });
});
