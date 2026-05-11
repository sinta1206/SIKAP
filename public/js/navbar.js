function handleLogout() {
    const userConfirm = confirm("Apakah Anda yakin ingin keluar dari sistem?");
    if (userConfirm) {
        console.log("Proses logout berhasil.");
        // nanti bisa diarahkan:
        // window.location.href = '/login';
    }
}

// tombol close (X)
document.querySelector('.close-btn')?.addEventListener('click', () => {
    console.log("Navigasi ditutup");
});
