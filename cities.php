<?php 
    require_once 'config.php';
    $sql = "SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone
            FROM Cities
            WHERE 1=1 ";
    
    if(isset($_GET['iso'])){
        $sql .= "AND CountryCodeISO = $_GET['iso'] ";
    }

    $pdo = new PDO($DBCONNSTRING, $DBUSER, $DBPASS);
    $queryResult = $pdo->query($sql);
    $result = [];
    while($row = $resultQuery->fetch()){
        array_push($result, json_encode($row));
    }
    $pdo = null;
    return $result;
?>