document.addEventListener('DOMContentLoaded' , function()
{
    
   
    let eCountries = [];
    //forcountries with image
    let countryListImg = [];


    
    //------------Fetching the Countries ---------//
    let countryAPI = 'countries.php';
    let cityAPI = 'cities.php';
    let countriesWithImagesCheck = 0;
    
        
    //fetch all the countries from the api
    fetch(countryAPI)
    .then(function (response){
        return response.json();
    })
    .then (function (data){
        //sort the countries 
        let sortedCountries = data.sort((a,b) => {
            return a.CountryName < b.CountryName ? -1 : 1;
        })
        
        //put the sorted list into local storage to be stored
        localStorage.setItem("countries", JSON.stringify(sortedCountries));
        countries = JSON.parse(localStorage.getItem("countries"));
        
        printCountryList(countries); 
    })
    .catch(function (error){
        console.log(error);
    })
    

    
    //function to print the country list
    function printCountryList(data)
    {
        clearCountries();
        for(let c of data)
        {
            let list = document.querySelector(".listCountries");
           
            let a = document.createElement("a");
           
            a.setAttribute('href' , "single-country.php?iso=" + c.ISO);
            eCountries.push(c);
            
            let li = document.createElement('li');
         
            //setup the attribute for the list
            li.setAttribute('iso', c.iso);
            li.setAttribute('name', c.CountryName);
            
          
            li.style.textAlign = "center";
            li.style.listStyleType = "none";
            li.style.padding = "5px";
          
            li.textContent = c.CountryName;
   
            list.appendChild(a);
             a.appendChild(li);
             
        }
    }
        
        
//-----------------------Country Filter------------------------//


    //adding an event listener based on the continent list

    let continent = document.querySelector('.continent');
    continent.addEventListener('change', function (e) {
        //Clear the list of countries
        clearCountries();
        
        //get the list of countries
        let countries = JSON.parse(localStorage.getItem("countries"));
        //find the countries based on continent and the value of the option selected
        
        let editiedCountries = countries.filter(c => c.Continent == e.target.value);
        
        //print out new list
        printCountryList(editiedCountries);
    });
        
    
    

    
        
        //searching countries by name
        
        
        //matching the country Filter List

        //getting the search box element from the html
        const searchBox = document.querySelector('.search');
        //getting the suggestions for the user 
        const suggestions = document.querySelector('#filterList');

        //defining an event 
        searchBox.addEventListener('keyup', displayMatches);
        //console.log(typeof editiedCountries)
        function displayMatches() {
            let countries = JSON.parse(localStorage.getItem("countries"));
//           

            let matches = findMatches(this.value, countries);
             
            clearCountries();
//            typeof (matches);
//            console.log(matches);
            printCountryList(matches);
        }


        //creating the findmatches function
        function findMatches(wordToMatch, list) {
            return list.filter(obj => {
                const regex = new RegExp(wordToMatch,'gi');

                return obj.CountryName.match(regex);
            })
        }

      
        
    

    
    //----Clearing Functions----//
     //function to clear the countries under the coumtry list
    function clearCountries() {

        //selecting the ul element
        let countryList = document.querySelector(".listCountries");

        if (countryList.getElementsByTagName('*').length > 0) {


            let ulElement = document.querySelectorAll(".listCountries a");
            for (let ul of ulElement) {

                countryList.removeChild(ul);
            }


        }


    }
    
    
    
});