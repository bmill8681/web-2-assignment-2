document.addEventListener('DOMContentLoaded', () => {
    addIndexListeners();
});
addIndexListeners = () => {
        document.querySelector("#login").addEventListener('click', (e) => login(e));
        document.querySelector("#join").addEventListener('click', (e) => join(e));
        // document.querySelector("#searchButton").addEventListener('click', e => searchImages(e));
}

login = e => {
    window.location.href = "login.php";
}

join = e => {
<<<<<<< HEAD
    console.log("Join Clicked!")
}

// searchImages = e => {
//     e.preventDefault();

// }
=======
    window.location.href = "signup.php";
}
>>>>>>> 8f19e01c00141dd6a2180d629dbd6868d1c935ea
