document.addEventListener('DOMContentLoaded', () => {
    loadData();
});

loadData = () => {
    const cityData = 'cities.php';

    window.addEventListener('load', () => {
        if (localStorage.getItem("cityData") === null) {
            fetch (cityData)
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
                localStorage.setItem('cityData', JSON.stringify(data))
            })
            .then(data => {
                data = localStorage.getItem('cityData');
                displayCityList(JSON.parse(data));
            });
        } else {
            let data = localStorage.getItem('cityData');
            displayCityList(JSON.parse(data));
        }
    });
}

displayCityList = (data) => {

    let list = document.querySelector('#cityList');
    data.sort((a, b) => {
        return a.AsciiName < b.AsciiName ? -1 : 1;
    });

    data.forEach(city => {
        let listItem = document.createElement('li');
        listItem.textContent = city.AsciiName;
        list.appendChild(listItem);
    });

    displayCityInfo(data);
}

displayCityInfo = (data) => {
    console.log(data);
    let cityList = document.querySelectorAll('#cityList li');
    cityList.forEach(city => {
        city.addEventListener('click', e => {
            

            data.forEach(matchCity => {
                if (city.textContent === matchCity.AsciiName) {
                    document.getElementById('cityDetails').style.display = "block";
                    document.getElementById('cityName').textContent = matchCity.AsciiName;
                    document.getElementById('cityPop').textContent = matchCity.Population;
                    document.getElementById('cityElev').textContent = matchCity.Elevation;
                    document.getElementById('cityTZone').textContent = matchCity.TimeZone;
                }
            })
        })
    })
}

