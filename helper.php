<?php
//
//require_once('setConnection.php');
//require_once('config.inc.php');
//require_once('single-country.php');

function getCountries()
{
    $sql = "SELECT ISO, ISONumeric, CountryName, Capital, CityCode, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription";
    
    return $sql;
}

function getCities()
{
    $sql = "SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone";
    
    return $sql;
}

function getImages()
{
    $sql = "SELECT ImageID, UserID, CityCode, Title, Description, Latitude, Longitude, CountryCodeISO, Path, Exif";
    
    
    
    return $sql;
}




function printSingleCountry($iso){
   try {
       
       $connection = setConnectionInfo(DBCONNECTION,DBUSER,DBPASS);
//       
//       $sql = 'SELECT ISO, ISONumeric, CountryName, Capital, CityCode, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription FROM countries WHERE ISO=?';
       
       $sql = getCountries();
       $sql .= " FROM countries WHERE ISO=?";
       
       
            
            $statement = runQuery($connection,$sql,array($iso));
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $connection = null;

       return $row;
   }
   catch (PDOException $e) {
       die( $e->getMessage() );
     } 
  }


function getAllCountries()
{
    try{

           $connection = setConnectionInfo(DBCONNECTION,DBUSER,DBPASS);
        
           // Building the SQL query and set initial params
            $sql = getCountries();
            $sql .= " FROM Countries WHERE 1=1 ";

             $result = runQuery($connection, $sql, null);
    
         return $result;
        }
        catch (PDOException $e) {
            die( $e->getMessage());
        }

}

function getAllCities()
{
        try{

           $connection = setConnectionInfo(DBCONNECTION,DBUSER,DBPASS);
        
            
           // Building the SQL query and set initial param
//            $sql = 'SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM cities WHERE 1=1';
            
            $sql = getCities();
            $sql .= " FROM cities WHERE 1=1";

         

             $result = runQuery($connection, $sql, null);
//            $result = $pdo->query($sql);
           
    
         return $result;
             
        }
        catch (PDOException $e) {
            die( $e->getMessage());
        }
    
}


  function cityByCountry($iso){
   try {
       $connection = setConnectionInfo(DBCONNECTION,DBUSER,DBPASS);
       
//       $sql = 'SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM cities WHERE CountryCodeISO=?';
       
            $sql = getCities();
            $sql .= " FROM cities WHERE CountryCodeISO=?";
       
            $statement = runQuery($connection,$sql,array($iso));
       
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $connection = null;
       
       return $results;
   }
   catch (PDOException $e) {
       die( $e->getMessage() );
     } 
  }

function cityByID($id)
{
      try {
       $connection = setConnectionInfo(DBCONNECTION,DBUSER,DBPASS);
       
//       $sql = 'SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM cities WHERE CityCode=?';
          
            $sql = getCities();
            $sql .= " FROM cities WHERE CityCode=?";
       
            $statement = runQuery($connection,$sql,array($id));
       
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $connection = null;
       
       return $results;
   }
   catch (PDOException $e) {
       die( $e->getMessage() );
     } 
}



function allPhotos()
{
    try{
        $connection = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        
//        $sql = "SELECT CountryCodeISO FROM imagedetails WHERE 1=1 ";
        
//         $sql = 'SELECT ImageID, UserID, CityCode, Title, Latitude, Longitude, CountryCodeISO, Path, Exif FROM imagedetails WHERE 1=1';
        
            $sql = getImages();
            $sql .= " FROM imagedetails WHERE 1=1";

         

        $result = runQuery($connection, $sql, null);
        
        $result = runQuery($connection, $sql, null);
        
        return $result;
    }
    catch (PDOException $e){
        die ($e->getMessage());
    }
    
}

function photosByCountry($iso)
{
      try{
        $connection = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        
//         $sql = 'SELECT ImageID, UserID, CityCode, Title, Latitude, Longitude, CountryCodeISO, Path, Exif FROM imagedetails WHERE CountryCodeISO=?';
          
            $sql = getImages();
            $sql .= " FROM imagedetails WHERE CountryCodeISO=?";

            $statement = runQuery($connection,$sql,array($iso));
       
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $connection = null;
       
       return $results;
        
    }
    catch (PDOException $e){
        die ($e->getMessage());
    }
}

function detailForSinglePhoto($imageId)
{
    try{
        
        $connection = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        
        
            $sql = getImages();
            $sql .= " from imagedetails where ImageID=?";
        
//        $sql = 'select Title, ImageID , UserID, Description, Exif, Latitude, Longitude, CityCode, CountryCodeISO, Path from imagedetails where ImageID=?';
        
        $statment = runQuery($connection,$sql,array($imageId));
        
        $results = $statment->fetchAll(PDO::FETCH_ASSOC);
        $connection = null;
        
        return $results;
        
    }
    catch(PDOException $e){
        die ($e->getMessage());
    }
}

function pictureForSingleCity($imageId)
{
       try{
        
        $connection = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        
//        $sql = 'select Title, ImageID , UserID, Description, Exif, Latitude, Longitude, CityCode, CountryCodeISO, Path from imagedetails where CityCode=?';
           
           $sql = getImages();
            $sql .= " from imagedetails where CityCode=?";
        
        $statment = runQuery($connection,$sql,array($imageId));
        
        $results = $statment->fetchAll(PDO::FETCH_ASSOC);
        $connection = null;
        
        return $results;
        
    }
    catch(PDOException $e){
        die ($e->getMessage());
    }
}

//function to print the name of the country based on the iso
function printNameOfCountry($iso)
{
       try{
        
        $connection = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        
        $sql = 'select CountryName from countries where ISO =?';
           
//           $sql = getImages();
//            $sql .= " from imagedetails where CityCode=?";
        
        $statment = runQuery($connection,$sql,array($iso));
        
        $results = $statment->fetchAll(PDO::FETCH_ASSOC);
        $connection = null;
        
        return $results;
        
    }
    catch(PDOException $e){
        die ($e->getMessage());
    }
//    select CountryName from countries where ISO = "SS";
}

function printNameOfCities($Cityid)
{
      try{
        
        $connection = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        
        $sql = 'select AsciiName from cities Where CityCode=?';
           
//           $sql = getImages();
//            $sql .= " from imagedetails where CityCode=?";
        
        $statment = runQuery($connection,$sql,array($Cityid));
        
        $results = $statment->fetchAll(PDO::FETCH_ASSOC);
        $connection = null;
        
        return $results;
        
    }
    catch(PDOException $e){
        die ($e->getMessage());
    }
}






?>
