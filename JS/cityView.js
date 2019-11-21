document.addEventListener('DOMContentLoaded', () => {
    addListeners();
});

addListeners = () => {
    document.getElementById("fetchALL").addEventListener('click', (e) => fetchALL(e));
    document.getElementById("fetchISO").addEventListener('click', (e) => fetchISO(e));
}

fetchALL = e => {
    if (e.target.id === "fetchALL") {
        e.stopPropagation();
        fetch('./cities.php').then(data => data.json()).then(data => console.log(data));
    }

}

fetchISO = e => {
    if (e.target.id === "fetchISO") {
        // e.stopPropagation();
        fetch("./cities.php?iso='gr'").then(data => data.json()).then(data => console.log(data));
    }
}