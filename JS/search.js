window.addEventListener('DOMContentLoaded', () => {
    addSearchListeners();
});

addSearchListeners = () => {
    addFilterButtonListeners();
}

addFilterButtonListeners = () => {
    document.querySelector("#filterWrapper").addEventListener('click', e => {
        if (e.target.classList.contains("FilterButtonActive")) {
            return;
        }
        if (e.target.classList.contains("FilterClass")) {
            let list = document.querySelectorAll(".FilterClass");
            if (list === undefined) return;
            let oldActive;
            list.forEach(item => {
                if (item.classList.contains("FilterButtonActive")) {
                    oldActive = item;
                    return;
                }
            });
            oldActive.classList.remove("FilterButtonActive");
            oldActive.classList.add("FilterButton");
            setInputFilter(e.target.id);
            e.target.classList.add("FilterButtonActive");
            e.target.classList.remove("FilterButton");
        }
    });

}

setInputFilter = id => {
    clearFilterInput();
    let form = document.querySelector("#filterInput form");
    if (id === "titleFilter") {
        let ch = document.createElement("input");
        ch.setAttribute("type", "text");
        ch.setAttribute("name", "title");
        ch.setAttribute("placeholder", "Search By Title (Leave blank for all photos)");
        form.appendChild(ch);
        addSubmitButton();
    }
    else if (id === "countryFilter") {
        fetch("./countries.php").then(data => data.json()).then(data => {
            let countries = [];
            countries = data;
            countries = countries.sort((a, b) => {
                if(a.CountryName.toUpperCase() < b.CountryName.toUpperCase()) return -1;
                if(a.CountryName.toUpperCase() === b.CountryName.toUpperCase()) return 0;
                return 1;
            });
            let select = document.createElement("select");
            select.setAttribute("name", "country");
            countries.forEach(cur => {
                let option = document.createElement("option");
                option.value = cur.ISO;
                option.textContent = cur.CountryName;
                select.appendChild(option);
            });
            form.appendChild(select);
            addSubmitButton();
        });
    }
    else if (id === "cityFilter") {
        fetch("./cities.php").then(data => data.json()).then(data => {
            let cities = [];
            cities = data;
            cities = cities.sort((a, b) => {
                if(a.AsciiName.toUpperCase() < b.AsciiName.toUpperCase()) return -1;
                if(a.AsciiName.toUpperCase() === b.AsciiName.toUpperCase()) return 0;
                return 1;
            });
            let select = document.createElement("select");
            select.setAttribute("name", "country");
            cities.forEach(cur => {
                let option = document.createElement("option");
                option.value = cur.CityCode;
                option.textContent = cur.AsciiName;
                select.appendChild(option);
            });
            form.appendChild(select);
            addSubmitButton();
        });
    }

}

addSubmitButton = () => {
    let form = document.querySelector("#filterInput form");
    let submit = document.createElement("button");
    submit.setAttribute("type", "submit");
    submit.textContent = "Search"
    form.appendChild(submit);
}

clearFilterInput = () => {
    // from https://www.geeksforgeeks.org/remove-all-the-child-elements-of-a-dom-node-in-javascript/ 
    let node = document.querySelector("#filterInput form");
    let child = node.lastElementChild;
    while (child) {
        node.removeChild(child);
        child = node.lastElementChild;
    }
}