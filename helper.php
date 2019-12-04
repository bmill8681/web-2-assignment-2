<?php
//
//require_once('setConnection.php');
//require_once('config.inc.php');
//require_once('single-country.php');


function printSingleCountry($iso){
   try {
       
       $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
       
       $sql = 'SELECT ISO, ISONumeric, CountryName, Capital, CityCode, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription FROM countries WHERE ISO=?';
            
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

           $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
        
           // Building the SQL query and set initial params
            $sql = "SELECT ISO, ISONumeric, CountryName, Capital, CityCode, Area, Population,Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages,Neighbours, CountryDescription ";

            $sql .= "FROM Countries WHERE 1=1 ";

             $result = runQuery($connection, $sql, null);
//            $result = $pdo->query($sql);
    
         return $result;
        }
        catch (PDOException $e) {
            die( $e->getMessage());
        }

}

function getAllCities()
{
        try{

           $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
        
           // Building the SQL query and set initial param
            $sql = 'SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM cities WHERE 1=1';

         

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
       $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
       
       $sql = 'SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM cities WHERE CountryCodeISO=?';
       
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
       $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
       
       $sql = 'SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM cities WHERE CityCode=?';
       
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
        $connection = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
        
//        $sql = "SELECT CountryCodeISO FROM imagedetails WHERE 1=1 ";
        
         $sql = 'SELECT ImageID, UserID, CityCode, Title, Latitude, Longitude, CountryCodeISO, Path, Exif FROM imagedetails WHERE 1=1';

         

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
        $connection = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
        
         $sql = 'SELECT ImageID, UserID, CityCode, Title, Latitude, Longitude, CountryCodeISO, Path, Exif FROM imagedetails WHERE CountryCodeISO=?';

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
        
        $connection = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
        
        $sql = 'select Title, ImageID , UserID, Description, Exif, Latitude, Longitude, CityCode, CountryCodeISO, Path from imagedetails where ImageID=?';
        
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
        
        $connection = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
        
        $sql = 'select Title, ImageID , UserID, Description, Exif, Latitude, Longitude, CityCode, CountryCodeISO, Path from imagedetails where CityCode=?';
        
        $statment = runQuery($connection,$sql,array($imageId));
        
        $results = $statment->fetchAll(PDO::FETCH_ASSOC);
        $connection = null;
        
        return $results;
        
    }
    catch(PDOException $e){
        die ($e->getMessage());
    }
}






?>
