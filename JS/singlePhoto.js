document.addEventListener('DOMContentLoaded' , function(){
    addDescriptionListeners();
});

addDescriptionListeners = () => {
    document.querySelector(".tab1").addEventListener('click', () => setDetails("Description"));
    document.querySelector(".tab2").addEventListener('click', () => setDetails("Details"));
    document.querySelector(".tab3").addEventListener('click', () => setDetails("Map"));
    document.querySelector(".picInfo").addEventListener('mouseover', (e) => showMouseOver(e));
    document.querySelector(".picInfo").addEventListener('mouseout', () => hideMouseOver());
    document.querySelector(".picInfo").addEventListener('mousemove', (e) => showMouseOver(e))
    if(document.querySelector(".favoritesButton"))
        document.querySelector(".favoritesButton").addEventListener('click', (e) => addToFavorites(e));
}

addToFavorites = (e) => {
    fetch(`favoritesHelper.inc.php?imageid=${e.target.dataset.imageid}`)
        .then(data => data.json())
        .then(data => {
            console.log(`Added: data`);
            if(data){
                document.querySelector(".favoritesButton").setAttribute("disabled", "true");
                document.querySelector(".favoritesButton").textContent = "Added to Favorites!";
            }
        });
}

setDetails = type => {
    let info = document.querySelector("#info");
    if(type === "Description"){
        document.querySelector(".picDetail").classList.add("Hide");
        document.querySelector(".picMap").classList.add("Hide");
        document.querySelector(".picDescription").classList.remove("Hide");
    }
    else if (type === "Details"){
        document.querySelector(".picDetail").classList.remove("Hide");
        document.querySelector(".picMap").classList.add("Hide");
        document.querySelector(".picDescription").classList.add("Hide");
    }
    else if (type === "Map"){
        document.querySelector(".picDetail").classList.add("Hide");
        document.querySelector(".picMap").classList.remove("Hide");
        document.querySelector(".picDescription").classList.add("Hide");
    }
}

showMouseOver = e => {
    let top = e.screenY - 275;
    let left = e.screenX + 5;
    document.querySelector(".hoverDetails").classList.remove("Invisible");
    document.querySelector(".hoverDetails").setAttribute('style', `top: ${top}px; left: ${left}px`);
}

hideMouseOver = () => {
    document.querySelector(".hoverDetails").classList.add("Invisible");
}