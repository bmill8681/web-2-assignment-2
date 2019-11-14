/* 

AUTHOR: DAVID CONTRERAS
ASSIGNMENT 01 - WEB 2
MOUNT ROYAL UNIVERSITY

Due to some poor time management on my part I'd only deem this assignment
partialy complete. Some functions had to be written rather poorly as I went and
made bandaid fixes to certain bugs. While this assignment has taught me a lot
about JS and how to work with JS it also taught me an important lesson. Be organized.
This assignment at first didn't seem 'big' but as I got working I could find myself
finding bugs that would cause nasty chain reactions... This is definintly something 
I will remember going forward.. Thank you for lessons! Wether intentional or not.

 */

function initMap() {

}

document.addEventListener("DOMContentLoaded", () => {

    /* ---------------------- API URL'S ---------------------- */

    const countryData = 'http://www.randyconnolly.com/funwebdev/3rd/api/travel/countries.php?iso=ALL';
    const countryDataWithImages = 'http://www.randyconnolly.com/funwebdev/3rd/api/travel/countries.php';
    const cityData = 'http://www.randyconnolly.com/funwebdev/3rd/api/travel/cities.php?id=ALL';
    const languageData = 'http://www.randyconnolly.com/funwebdev/3rd/api/travel/languages.php';
    const travelPhotos = 'http://www.randyconnolly.com/funwebdev/3rd/api/travel/images.php';

    /* ---------------------- FETCH COUNTRY LIST DATA ---------------------- */

    window.addEventListener('load', () => {

        if (localStorage.getItem("countryData") === null) {
            fetch(countryData)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return Promise.reject({
                            status: response.status,
                            statusText: response.statusTest
                        });
                    }
                })
                .then(data => {
                    localStorage.setItem('countryData', JSON.stringify(data));
                })
                .then(data => {
                    data = localStorage.getItem("countryData");
                    displayCountryList(JSON.parse(data));
                });
        } else {
            let data = localStorage.getItem("countryData");
            displayCountryList(JSON.parse(data));
        }

        if (localStorage.getItem("cityData") === null) {
            fetch(cityData)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return Promise.reject({
                            status: response.status,
                            statusText: response.statusTest
                        });
                    }
                })
                .then(data => {
                    localStorage.setItem('cityData', JSON.stringify(data));
                    console.log(cityData);
                });
        }

        if (localStorage.getItem("countryDataWImg") === null) {
            fetch(countryDataWithImages)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return Promise.reject({
                            status: response.status,
                            statusText: response.statusTest
                        });
                    }
                })
                .then(data => {
                    localStorage.setItem('countryDataWImg', JSON.stringify(data));
                });
        }

        if (localStorage.getItem("languageData") === null) {
            fetch(languageData)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return Promise.reject({
                            status: response.status,
                            statusText: response.statusTest
                        });
                    }
                })
                .then(data => {
                    localStorage.setItem('languageData', JSON.stringify(data));
                });
        }

        if (localStorage.getItem("photoData") === null) {
            fetch(travelPhotos)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return Promise.reject({
                            status: response.status,
                            statusText: response.statusTest
                        });
                    }
                })
                .then(data => {
                    localStorage.setItem('photoData', JSON.stringify(data));
                });
        }

    });

    /* ---------------------- DISPLAY HOME PAGE FUNCTIONS ---------------------- */

    const displayCountryList = (data => {
        data.sort((a, b) => {
            return a.name < b.name ? -1 : 1;
        });

        let list = document.getElementById('countryList');
        data.forEach(country => {
            let listItem = document.createElement('li');
            listItem.setAttribute('value', country.iso);
            listItem.textContent = country.name;
            list.appendChild(listItem);
        });
        list.style.listStyle = "none";

        let listItems = document.querySelectorAll('#countryList li');
        listItems.forEach(items => {
            items.addEventListener('click', e => {
                if (e.target && e.target.nodeName.toLowerCase() == 'li') {
                    displayCountryMap(e.target);
                    displayCityList(e.target);
                    filterCities(e.target);
                    displayCountryInformation(e.target);
                    displayCityInformation();
                    displayTravelPhoto(e.target);
                }
            });
        });
        //fix this as its limiting functionality to other
        //features on the site
        filterCountries();
    });

    /* ---------------------- FILTER COUNTRY FUNCTIONS ---------------------- */

    // Driver method that calls other functions based on
    // which eventhandler is being called by the user.
    const filterCountries = (() => {
        let dropDown = document.getElementById('filterContinent');
        let data = JSON.parse(localStorage.getItem("countryData"));
        dropDown.addEventListener('change', (e) => {
            displayCountryListByContinent(e.target.value);
            console.log(e.target);
            displayTravelPhoto(e.target);
        });

        let list = document.querySelector('#countryList');
        let checkBox = document.getElementById('filterByImages');
        checkBox.addEventListener('change', (e) => {
            if (checkBox.checked) {
                displayCountriesWithImages();
            } else {
                resetList();
                displayCountryList(data);
            }
        });

        let searchBox = document.getElementById('filterByText');
        searchBox.addEventListener('input', (e) => {
            displayCountriesBySearch(e.target.value);
        });

    });

    const displayCountryListByContinent = ((continent) => {
        let list = document.querySelector('#countryList');
        let data = JSON.parse(localStorage.getItem("countryData"));
        resetList();

        data.forEach(country => {
            if (continent === country.continent) {
                let listItem = document.createElement('li');
                listItem.textContent = country.name;
                listItem.setAttribute('value', country.iso);
                list.appendChild(listItem);
            }
        });

        list.addEventListener('click', e => {
            displayCityList(e.target);
            displayCountryInformation(e.target);
            displayCountryMap(e.target);
        });

        if (continent === '-') {
            displayCountryList(data);
            let map = document.getElementById('map');
            map.setAttribute('src', "");
        }
    });


    const displayCountriesWithImages = (() => {
        let list = document.querySelector('#countryList');
        let data = JSON.parse(localStorage.getItem("countryDataWImg"));
        resetList();

        data.forEach(country => {
            let listItem = document.createElement('li');
            listItem.textContent = country.name;
            listItem.setAttribute('value', country.iso);
            list.appendChild(listItem);
        });

        list.addEventListener('click', e => {
            displayCityList(e.target);
            displayCountryInformation(e.target);
            displayTravelPhoto(e.target);
            displayCountryMap(e.target);
        });
    });

    const displayCountriesBySearch = (search => {
        let list = document.querySelector('#countryList');
        let data = JSON.parse(localStorage.getItem("countryData"));
        const re = new RegExp(`^${search}`, 'i');
        const regexEx = data.filter(countries => countries.name.match(re));
        resetList();

        regexEx.forEach(country => {
            let listItem = document.createElement('li');
            listItem.textContent = country.name;
            listItem.setAttribute('value', country.iso);
            list.appendChild(listItem);
        });

        list.addEventListener('click', e => {
            displayCityList(e.target);
            displayCountryInformation(e.target);
            displayCountryMap(e.target);
        });
    });

    const resetList = (() => {
        let countryList = document.querySelector('#countryList');
        let cityList = document.querySelector('#cityList')
        countryList.textContent = "";
        cityList.textContent = "";
    });

    /* ---------------------- FILTER CITY FUNCTIONS ---------------------- */

    // Driver method that will call filter functions
    // based on the end-users selection for city filters.
    const filterCities = (country => {
        let checkBox = document.getElementById('cityFilterImages');
        checkBox.addEventListener('change', e => {
            if (checkBox.checked) {
                displayCitiesWithImages(country);
            } else {
                displayCityList(country);
            }
        });

        let searchBox = document.getElementById('cityFilterText');
        searchBox.addEventListener('input', e => {
            displayCitiesBySearch(e.target.value, country);
        });
    });

    const displayCitiesWithImages = (country => {
        let list = document.querySelector('#cityList');
        let data = JSON.parse(localStorage.getItem("cityDataWImg"));
        list.textContent = "";

        data.forEach(city => {
            if (country.getAttribute('value') === city.iso) {
                let listItem = document.createElement('li');
                listItem.textContent = city.name;
                list.appendChild(listItem);
                displayCityInformation();
            }
        });
    });

    const displayCitiesBySearch = ((search, country) => {
        // Come back to this ... need to find a way to grab
        // the list of the countries that are currently displayed
        let list = document.getElementById('cityList');
        let data = JSON.parse(localStorage.getItem("cityData"));
        let cityArray = [];
        data.forEach(d => {
            if(d.iso === country.getAttribute('value')) {
                cityArray.push(d);
            }
        });

        cityArray.sort((a, b) => {
            return a.name < b.name ? -1 : 1;
        });

        const re = new RegExp(`^${search}`, 'i');
        const regexEx = cityArray.filter(cities => cities.name.match(re));
        list.textContent = "";

        regexEx.forEach(city => {
            let listItem = document.createElement('li');
            listItem.textContent = city.name;
            list.appendChild(listItem);
            displayCityInformation();
        });
    });

    /* ---------------------- DISPLAY CITY FUNCTIONS ---------------------- */

    const displayCityList = ((countryISO) => {
        let list = document.querySelector('#cityList');
        let data = JSON.parse(localStorage.getItem("cityData"));
        list.textContent = "";
        

        data.sort((a, b) => {
            return a.name < b.name ? -1 : 1;
        });

        const cityList = data.filter(city => {
            if (city.iso === countryISO.getAttribute('value')) {
                return city;
            }
        });
 
        cityList.forEach(city => {
            let listItem = document.createElement('li');
            listItem.textContent = city.name;
            list.appendChild(listItem);
        });
        list.style.listStyle = "none";
    });


    /* ---------------------- DISPLAY COUNTRY INFORMATION FUNCTIONS ---------------------- */

    const displayCountryInformation = (clickedCountry => {
        let data = JSON.parse(localStorage.getItem("countryData"));

        data.forEach(country => {
            if (clickedCountry.getAttribute('value') === country.iso) {
                document.getElementById('countryDetails').style.display = "block";
                document.getElementById('cityDetails').style.display = "none";
                document.getElementById('countryName').textContent = country.name;
                document.getElementById('countryCurrency').textContent = country.details.currency;
                document.getElementById('countryDomain').textContent = country.details.domain;
                document.getElementById('countryLanguage').textContent = matchLanguage(country);
                document.getElementById('countryNeigh').textContent = country.details.neighbours;
                document.getElementById('countryDesc').textContent = country.description;
            }
        });
    });

    const matchLanguage = (country => {
        let data = JSON.parse(localStorage.getItem("languageData"));
        let findIso = country.details.languages.split(",");
        let returnCountryNames = " ";
        let isoCodes = [];

        findIso.forEach(iso => {
            if (iso.includes("-", 0) === true) {
                var code = iso.substring(0, 2)
                isoCodes.push(code);
            } else {
                isoCodes.push(iso);
            }
        });

        isoCodes.forEach(iso => {
            data.forEach(languageDetails => {
                if (iso === languageDetails.iso) {
                    returnCountryNames += languageDetails.name + " ";
                }
            });
        });

        return returnCountryNames;
    });

    /* ---------------------- DISPLAY CITY INFORMATION FUNCTIONS ---------------------- */

    let displayCityInformation = (() => {
        let cityList = document.querySelectorAll('#cityList li');
        let data = JSON.parse(localStorage.getItem("cityData"));
        cityList.forEach(city => {
            city.addEventListener('click', e => {
                if (e.target && e.target.nodeName.toLowerCase() == 'li') {
                    displayCityMap(e.target);
                    data.forEach(matchCity => {
                        if (city.textContent === matchCity.name) {
                            document.getElementById('countryDetails').style.display = "none";
                            document.getElementById('cityDetails').style.display = "block";
                            document.getElementById('cityName').textContent = matchCity.name;
                            document.getElementById('cityPop').textContent = matchCity.population;
                            document.getElementById('cityElev').textContent = matchCity.elevation;
                            document.getElementById('cityTZone').textContent = matchCity.timezone;
                        }
                    });
                }
            });
        });
    });

    /* ---------------------- DISPLAY COUNTRY/CITY MAP FUNCTIONS ---------------------- */

    let displayCountryMap = ((clickedCountry) => {
        let data = JSON.parse(localStorage.getItem("countryData"));
        let map = document.getElementById('countMap');
        let roadMap = document.getElementById('roadMap');
        let mapString;
        data.forEach(country => {
            if (clickedCountry.getAttribute('value') === country.iso) {
                mapString = "https://maps.googleapis.com/maps/api/staticmap?center=" +
                    country.name + "&zoom=6&size=200x200&key=" + "AIzaSyC8oREs1CiabLmll1hucS5o9NZklCYiLdI";
            }
        });
        map.setAttribute('src', mapString);
        map.style.display = 'block';
        roadMap.setAttribute('src', "");
        roadMap.style.display = 'block';
    });

    let displayCityMap = ((clickedCity) => {
        let map = document.getElementById('countMap');
        let roadMap = document.getElementById('roadMap');
        let mapString = "https://maps.googleapis.com/maps/api/staticmap?center=" +
            clickedCity.textContent + "&zoom=6&size=200x200&markers=" + clickedCity.textContent + "&key=" + "AIzaSyC8oREs1CiabLmll1hucS5o9NZklCYiLdI";
        let roadString = "https://maps.googleapis.com/maps/api/staticmap?center=" +
            clickedCity.textContent + "&zoom=14&size=200x200&styke=feature:road&key=" + "AIzaSyC8oREs1CiabLmll1hucS5o9NZklCYiLdI";
        map.setAttribute('src', mapString);
        map.style.display = 'block';
        roadMap.setAttribute('src', roadString);
        roadMap.style.display = 'block';
    });

    /* ---------------------- DISPLAY TRAVEL PHOTO FUNCTIONS ---------------------- */

    const displayTravelPhoto = ((clickedCountry) => {
        let data = JSON.parse(localStorage.getItem("photoData"));
        let photoSection = document.querySelector('.c section');
        let photolist = document.querySelectorAll(".c div");
        let header = document.querySelector(".c h2");
        let srcSet;
        let img;
        header.style.display = "grid";

        // Remove any photos that are currently in the section
        photolist.forEach(photo => {
            photo.remove();
        });

        data.forEach(country => {
            if (country.location.iso === clickedCountry.getAttribute('value')) {
                let div = document.createElement('div');
                div.classList.toggle('photo');
                img = document.createElement('img');
                img.setAttribute('src', "https://storage.googleapis.com/contrerasdavidassg01/square150/" + country.filename);
                div.appendChild(img);
                photoSection.appendChild(div);
                img.style.cursor = 'pointer';
                img.addEventListener('click', e => {
                    if (e.target && e.target.nodeName.toLowerCase() === 'img') {
                        loadSinglePage(country);
                    }
                });
            }
        });
    });

    /* ---------------------- SINGLE PAGE FUNCTIONS ---------------------- */

    // This method is excessively long .. a real account for
    // poor time management. /shrug =S
    const loadSinglePage = (image => {
        let homeDiv = document.querySelectorAll('.box');
        let singleDiv = document.querySelectorAll('.singlePage');
        homeDiv.forEach(homeBox => {
            homeBox.style.display = 'none';
        });
        singleDiv.forEach(singleBox => {
            singleBox.style.display = 'grid';
        });

        document.getElementById('singlePagePhoto')
            .setAttribute('src', `https://storage.googleapis.com/contrerasdavidassg01/medium640/${image.filename}`);
        document.getElementById('photoTitle').textContent = image.title;
        document.getElementById('username').textContent = `${image.user.firstname}  ${image.user.lastname}`;
        document.getElementById('photoCountry').textContent = `${image.location.city}, ${image.location.country}`;

        displayTabs(image);
    });

    const displayTabs = (image => {
        let buttons = document.querySelectorAll('.singleButton');
        buttons.forEach(button => {
            button.addEventListener('click', e => {
                removeStyle();
                if (e.target.textContent === 'Description') {
                    document.getElementById('information').style.display = "block";
                    document.getElementById('descButt').style.backgroundColor = "#9e5755";
                    document.getElementById('singleDesc').textContent = image.description;
                } else if (e.target.textContent === 'Details') {
                    document.getElementById('details').style.display = "block";
                    document.getElementById('detailButt').style.backgroundColor = "#9e5755";
                    document.getElementById('make').textContent = image.exif.make;
                    document.getElementById('model').textContent = image.exif.model;
                    document.getElementById('exposure').textContent = image.exif.exposure_time;
                    document.getElementById('aperature').textContent = image.exif.aperture;
                    document.getElementById('iso').textContent = image.exif.iso;
                    document.getElementById('focalLength').textContent = image.exif.focal_length;
                } else if (e.target.textContent === 'Map') {
                    document.getElementById('mapButt').style.backgroundColor = "#9e5755";
                    initMap(image);
                } else if (e.target.textContent === 'Back') {
                    goBack();
                } else if (e.target.textContent === 'Speak') {
                    speakTitle();
                }
            });
        });
        hoverPhoto(image);
    });

    const goBack = (() => {
        let homeDiv = document.querySelectorAll('.box');
        let singleDiv = document.querySelectorAll('.singlePage');
        homeDiv.forEach(homeBox => {
            homeBox.style.display = 'grid';
        });
        singleDiv.forEach(singleBox => {
            singleBox.style.display = 'none';
        });
        
    });

    const speakTitle = (() => {
        const utterance = new SpeechSynthesisUtterance(document.getElementById('photoTitle').textContent);
        speechSynthesis.cancel();
        speechSynthesis.speak(utterance);
    });

    const hoverPhoto = ((image) => {
        document.getElementById('singlePagePhoto').addEventListener('mouseover', e => {
            document.getElementById('overlay').style.display = 'block';
        });
        document.getElementById('singlePagePhoto').addEventListener('mouseout', e => {
            document.getElementById('overlay').style.display = 'none';
        });
        document.getElementById('actual').textContent = image.credit.actual;
        document.getElementById('creator').textContent = image.credit.creator;
        document.getElementById('source').textContent = image.credit.source;
        document.getElementById('make1').textContent = image.exif.make;
        document.getElementById('model1').textContent = image.exif.model;
        document.getElementById('exposure1').textContent = image.exif.exposure_time;
        document.getElementById('aperature1').textContent = image.exif.aperture;
        document.getElementById('iso1').textContent = image.exif.iso;
        document.getElementById('focalLength1').textContent = image.exif.focal_length;
    });

    // No idea why this isn't working .... the code is I think
    // the same as to our lab... this is a little frustrating.
    const initMap = ((image) => {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: image.location.latitude, lng: image.location.longitude },
            mapTypeId: 'satellite',
            zoom: 18
        });
    });

    const removeStyle = (() => {
        document.querySelectorAll('.tabs').forEach(tab => {
            tab.style.display = 'none';
        });

        document.querySelectorAll('.singleButton').forEach(button => {
            button.style.backgroundColor = '#E8E8E8';
        });

    });

});