document.addEventListener('DOMContentLoaded', () => {
    addListeners();
});

addListeners = () => {
    document.querySelector("#login").addEventListener('click', (e) => login(e));
    document.querySelector("#join").addEventListener('click', (e) => join(e));
}

login = e => {
    e.preventDefault();
    console.log("LOGIN");
    fetch('./cities.php').then(data => data.json()).then(data => console.log(data));
}

join = e => {
    e.preventDefault();
    console.log("JOIN");
    fetch("./cities.php?iso='GR'").then(data => data.json()).then(data => console.log(data));
}