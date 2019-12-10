document.addEventListener('DOMContentLoaded', () => {
    addIndexListeners();
});

addIndexListeners = () => {
    if(document.querySelector("#login"))
        document.querySelector("#login").addEventListener('click', (e) => login(e));
    if(document.querySelector("#join"))
        document.querySelector("#join").addEventListener('click', (e) => join(e));
}

login = e => {
    window.location.href = "login.php";
}

join = e => {
    window.location.href = "signup.php";
}
