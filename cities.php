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

    // Connecting to the DB
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Building the SQL query and initial params
    $sql = "SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone ";
    $sql .= "FROM Cities WHERE 1=1 ";
    $iso = null;
    $queryResult = null;
    $result = array();
    
    // Build Query
    if (isset($_GET['citycode'])) {
        $sql .= "AND CityCode = :citycode";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":citycode", $_GET['citycode']);
        $statement->execute();
        $queryResult = $statement->fetchAll();
        foreach($queryResult as $row){
            array_push($result, formatRow($row));
        }
    }
    else {
        $queryResult = $pdo->query($sql);
        while ($row = $queryResult->fetch()) {
            array_push($result, formatRow($row));
        }
    }

    // Return all
    $pdo = null;
    echo json_encode($result);    