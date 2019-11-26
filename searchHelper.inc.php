<?php
require_once './config.inc.php';

// Fix this so it isn't concatenating the sql. Use a prepared statement instead.
if (isset($_GET['title'])) {
    $sql .= "AND UPPER(Title) LIKE UPPER('%" . $_GET['title'] . "%') ";
}

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

// this will also need to be fixed using a prepared statement setup.
// check countries.php for an example. 
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Building the SQL query and initial params
$sql = "SELECT ImageID, UserID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO, 
ContinentCode, Path, Exif, ActualCreator, CreatorURL, SourceURL, Colors";
$sql .= "FROM imagedetails WHERE 1=1";
$iso = null;
$queryResult = null;
$result = array();

// Build Query
if (isset($_GET['search'])) {
    $sql .= "AND search = :search";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":search", $_GET['search']);
    $statement->execute();
    $queryResult = $statement->fetchAll();
    foreach ($queryResult as $row) {
        array_push($result, formatRow($row));
    }
} else {
    $queryResult = $pdo->query($sql);
    while ($row = $queryResult->fetch()) {
        array_push($result, formatRow($row));
    }
}

// Return all
$pdo = null;
echo json_encode($result);

?>
