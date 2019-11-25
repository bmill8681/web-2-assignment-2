<?php 
    require_once 'config.inc.php';
    // Formats the row from the sql query into an array using 
    // the column as the key to the key value pair
    function formatRow($cur){
        $data = [
            "CityCode"=>$cur[0], 
            "AsciiName"=>$cur[1], 
            "CountryCodeISO"=>$cur[2], 
            "Latitude"=>$cur[3],
            "Longitude"=>$cur[4],
            "Population"=>$cur[5],
            "Elevation"=>$cur[6],
            "TimeZone"=>$cur[7]
        ];
        return $data;
    }

    // Building the SQL query
    $sql = "SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone ";
    $sql .= "FROM Cities WHERE 1=1 ";
    
    // Look at countries.php to see how to fix this using a prepared statement
    if(isset($_GET['iso'])){
        $sql .= "AND CountryCodeISO = ".$_GET['iso']." ";
    }

    // Connecting to the DB
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $queryResult = $pdo->query($sql);
    $result = array();

    // Parsing the query results
    while($row = $queryResult->fetch()){
        $formatted = formatRow($row);
        array_push($result, $formatted);
    }
    $pdo = null;

    // Returning the value
    echo json_encode($result);
?>