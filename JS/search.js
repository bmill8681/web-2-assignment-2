window.addEventListener('DOMContentLoaded', () => {
    addListeners();
});

addListeners = () => {
    addFilterButtonListeners();
}

addFilterButtonListeners = () => {
    document.querySelector("#filterWrapper").addEventListener('click', e => {
        if(e.target.classList.contains("FilterButtonActive")){
            console.log("Already Active");
            return;
        }
        if(e.target.classList.contains("FilterClass")){ 
            let list = document.querySelectorAll(".FilterClass");
            if(list === undefined) return;
            list.forEach(item => console.log(item));
            let oldActive = list.find(item => item.classList.contains("FilterButtonActive"));
            oldActive.classList.remove("FilterButtonActive");
            oldActive.classList.add("FilterButton");
        }
        e.target.classList.add("FilterButtonActive");
        e.target.classList.remove("FilterButton");
    });

}