document.addEventListener('DOMContentLoaded', () => {
    addListeners();
});

addListeners = () => {
        document.querySelector("#login").addEventListener('click', (e) => login(e));
        document.querySelector("#join").addEventListener('click', (e) => join(e));
        // document.querySelector("#searchButton").addEventListener('click', e => searchImages(e));
}

login = e => {
    console.log("Login Clicked!");
}

join = e => {
    console.log("Join Clicked!")
}

// searchImages = e => {
//     e.preventDefault();

// }