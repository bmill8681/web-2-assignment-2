<?php

require_once('config.inc.php');
function formatRow($cur)
{
  $data = [
    "ISO" => $cur[0],
    "ISONumeric" => $cur[1],
    "CountryName" => $cur[2],
    "Capital" => $cur[3],
    "CityCode" => $cur[4],
    "Area" => $cur[5],
    "Population" => $cur[6],
    "Continent" => $cur[7],
    "TopLevelDomain" => $cur[8],
    "CurrencyCode" => $cur[9],
    "CurrencyCode" => $cur[10],
    "PhoneCountryCode" => $cur[11],
    "Languages" => $cur[12],
    "Neighbours" => $cur[13],
    "CountryDescription" => $cur[14]
  ];
  return $data;
}

// Connecting to the DB
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Building the SQL query and set initial params
$sql = "SELECT ISO, ISONumeric, CountryName, Capital, CityCode, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription ";
$sql .= "FROM Countries WHERE 1=1 ";

$iso = null;
$queryResult = null;
$result = array();

// Run the query
if (isset($_GET['iso'])) {
//     $sql .= "AND ISO = ".$_GET['iso']." ";
  $sql .= "AND ISO = :iso ";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(":iso", $_GET['iso']);
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

// Return result
$pdo = null;
echo json_encode($result);

?>