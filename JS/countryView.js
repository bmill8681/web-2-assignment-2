document.addEventListener('DOMContentLoaded', function () {
    let eCountries = [];
    //------------Fetching the Countries ---------//
    let countryAPI = 'countries.php';
    let cityAPI = 'cities.php';

    //fetch all the countries from the api
    if (!localStorage.getItem("countries")) {
        fetch(countryAPI)
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                //sort the countries 
                let sortedCountries = data.sort((a, b) => {
                    return a.CountryName < b.CountryName ? -1 : 1;
                })

                //put the sorted list into local storage to be stored
                localStorage.setItem("countries", JSON.stringify(sortedCountries));
                // countries = JSON.parse(localStorage.getItem("countries"));
                printCountryList(sortedCountries);
            })
            .catch(function (error) {
                console.log(error);
            });
    }
    else {
        printCountryList(JSON.parse(localStorage.getItem("countries")));
    }
    

    //function to print the country list
    function printCountryList(data) {
        clearCountries();
        for (let c of data) {
            let list = document.querySelector(".listCountries");
            let a = document.createElement("a");
            let li = document.createElement('li');

            a.setAttribute('href', "countryView.php?iso=" + c.ISO);
            a.textContent = c.CountryName;
            eCountries.push(c);

            list.appendChild(li);
            li.appendChild(a);
        }
    }


    //-----------------------Country Filter------------------------//


    //adding an event listener based on the continent list
    let continent = document.querySelector('.continent');
    continent.addEventListener('change', function (e) {
        clearCountries();
        let countries = JSON.parse(localStorage.getItem("countries"));
        let editiedCountries = countries.filter(c => c.Continent == e.target.value);
        printCountryList(editiedCountries);
    });






    //searching countries by name
    //matching the country Filter List
    //getting the search box element from the html
    const searchBox = document.querySelector('.search').addEventListener('keyup', displayMatches);


    function displayMatches() {
        let countries = JSON.parse(localStorage.getItem("countries"));
        let matches = findMatches(this.value, countries);

        clearCountries();
        printCountryList(matches);
    }


    //creating the findmatches function
    function findMatches(wordToMatch, list) {
        return list.filter(obj => {
            const regex = new RegExp(wordToMatch, 'gi');
            return obj.CountryName.match(regex);
        })
    }

    //----Clearing Functions----//
    //function to clear the countries under the country list
    function clearCountries() {
        let countryList = document.querySelector(".listCountries");
        // From https://www.geeksforgeeks.org/remove-all-the-child-elements-of-a-dom-node-in-javascript/
        let child = countryList.lastElementChild;
        while (child) {
            countryList.removeChild(child);
            child = countryList.lastElementChild;
        }
    }

    // Removing filters from country list
    document.querySelector(".reset").addEventListener('click', () => clearFilters());
    function clearFilters() {
        document.querySelector(".search").value = "";
        document.querySelector(".imageOnly").checked = false;
        document.querySelector(".continent").value = "";
        printCountryList(JSON.parse(localStorage.getItem("countries")));
    }

    document.querySelector(".imageOnly").addEventListener('change', (e) => getImageOnlyCountries(e.target.checked));
    function getImageOnlyCountries(checked) {
        if (checked) {
            let url = countryAPI + '?withimages=true';
            fetch(url)
                .then(data => data.json())
                .then(data => {
                    data = data.sort((a, b) => {
                        if (a.CountryName < b.CountryName) return -1;
                        if (a.CountryName === b.CountryName) return 0;
                        return 1;
                    });
                    console.log(data);
                    printCountryList(data);
                });
        }
        else {
            printCountryList(JSON.parse(localStorage.getItem("countries")));
        }
    }
});

