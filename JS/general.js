document.addEventListener('DOMContentLoaded', () => {
    addGeneralListeners();
});
addGeneralListeners = () => {
    document.querySelector("body nav button").addEventListener('click', (e) => toggleNav(e));
}

toggleNav = (e) => {
    e.preventDefault();
    document.querySelector("body").classList.toggle("mobileNavBody");
    document.querySelector("body nav").classList.toggle("mobileNav");
}