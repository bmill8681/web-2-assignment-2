document.addEventListener('DOMContentLoaded', () => {
    addIndexListeners();
});

addIndexListeners = () => {
        document.querySelector("#login").addEventListener('click', (e) => login(e));
        document.querySelector("#join").addEventListener('click', (e) => join(e));
}

login = e => {
    window.location.href = "login.php";
}

join = e => {
    window.location.href = "signup.php";
}
