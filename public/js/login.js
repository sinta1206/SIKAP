document.addEventListener('DOMContentLoaded', () => {

    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // SIMULASI ROLE
        if (username === "admin" && password === "12345") {

            alert("Login sebagai ADMIN");
            window.location.href = "/dashboard-admin";

        } else if (username === "panitia" && password === "12345") {

            alert("Login sebagai PANITIA");
            window.location.href = "/dashboard-panitia";

        } else {

            alert("Username atau password salah");

        }
    });

});
