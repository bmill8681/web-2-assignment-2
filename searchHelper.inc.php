<?php
require_once './config.inc.php';

function formatRow($cur)
{
    $data = [
        "ImageID" =>        $cur[0],
        "UserID" =>         $cur[1],
        "Title" =>          $cur[2],
        "Description" =>    $cur[3],
        "Latitude" =>       $cur[4],
        "Longitude" =>      $cur[5],
        "CityCode" =>       $cur[6],
        "CountryCodeISO" => $cur[7],
        "ContinentCode" =>  $cur[8],
        "Path" =>           $cur[9],
        "Exif" =>           $cur[10],
        "ActualCreator" =>  $cur[11],
        "CreatorURL" =>     $cur[12],
        "SourceURL" =>      $cur[13],
        "Colors" =>         $cur[14]
    ];
    return $data;
}

function GetBaseSQL(){
    $sql = "SELECT ImageID, UserID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO, ContinentCode, ";
    $sql .= "Path, Exif, ActualCreator, CreatorURL, SourceURL, Colors FROM imagedetails WHERE 1=1 ";
    return $sql;
}

// This has to be updated.
// function FormatPhotos($list){
//     foreach($list as $key=>$value){
//         $title = $value['ImageID'];
//         echo "<p>$title</p>";
//     }
// }

function GetPhotosByTitle($title)
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = GetBaseSQL();
    $queryResult = null;
    $result = array();
    // Fixed so it isn't concatenating the sql. Now uses a prepared statement instead.

    $sql .= "AND UPPER(TITLE) LIKE UPPER(:title) ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":title", "%" .$title. "%");
    $statement->execute();
    $queryResult = $statement->fetchAll();
    foreach ($queryResult as $row) {
        array_push($result, formatRow($row));
    }

    $pdo = null;
    FormatPhotos($result);
}

function GetAllPhotos(){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = GetBaseSQL();
    $result = array();
    $results = $pdo->query($sql);
    while($row = $results->fetch()){
        $formatted = formatRow($row);
        array_push($result, $formatted);
    } 
    $pdo = null;
    FormatPhotos($result); 
}

function GetPhotosByCountry($country){
    $sql = GetBaseSQL();
    $sql .= "AND UPPER(CountryCodeISO) LIKE UPPER(:countryiso)";

    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $queryResult = null;
    $result = array();
    // Fixed so it isn't concatenating the sql. Now uses a prepared statement instead.
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":countryiso", "%" .$country. "%");
    $statement->execute();
    $queryResult = $statement->fetchAll();
    foreach ($queryResult as $row) {
        array_push($result, formatRow($row));
    }

    $pdo = null;
    FormatPhotos($result);
}

function GetPhotosByCity($city){
    $sql = GetBaseSQL();
    $sql .= "AND UPPER(CityCode) LIKE UPPER(:city)";

    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $queryResult = null;
    $result = array();
    // Fixed so it isn't concatenating the sql. Now uses a prepared statement instead.
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":city", "%" .$city. "%");
    $statement->execute();
    $queryResult = $statement->fetchAll();
    foreach ($queryResult as $row) {
        array_push($result, formatRow($row));
    }

    $pdo = null;
    return  $result;
    // FormatPhotos($result);
}

?>
