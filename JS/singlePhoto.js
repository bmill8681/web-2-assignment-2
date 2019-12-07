document.addEventListener('DOMContentLoaded' , function(){
    addDescriptionListeners();
});

addDescriptionListeners = () => {
    document.querySelector(".tab1").addEventListener('click', () => setDetails("Description"));
    document.querySelector(".tab2").addEventListener('click', () => setDetails("Details"));
    document.querySelector(".tab3").addEventListener('click', () => setDetails("Map"));
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