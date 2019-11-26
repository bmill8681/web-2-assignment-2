<?php 
    require_once './config.inc.php';

    function formatRow($cur){
        $data = [
             "ImageID"=>        $cur[0],
             "UserID"=>         $cur[1],
             "Title"=>          $cur[2],
             "Description"=>    $cur[3],
             "Latitude"=>       $cur[4],
             "Longitude"=>      $cur[5],
             "CityCode"=>       $cur[6],
             "CountryCodeISO"=> $cur[7],
             "ContinentCode"=>  $cur[8],
             "Path"=>           $cur[9],
             "Exif"=>           $cur[10],
             "ActualCreator"=>  $cur[11],
             "CreatorURL"=>     $cur[12],
             "SourceURL"=>      $cur[13],
             "Colors"=>         $cur[14]
        ];
        return $data;
    }


    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT ImageID, UserID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO, ContinentCode, ";
    $sql .= "Path, Exif, ActualCreator, CreatorURL, SourceURL, Colors FROM imagedetails WHERE 1=1 ";
    $title = null;
    $queryResult = null;
    $result = array();

    // Fixed so it isn't concatenating the sql. Now uses a prepared statement instead.
    if(isset($_GET['title'])){
       $sql .= "AND TITLE = :title ";
       $statement = $pdo->prepare($sql);
       $statement->bindValue(":title", $_GET['title']);
       $statement->execute();
       $queryResult = $statement->fetchAll();
       foreach($queryResult as $row){
         array_push($result, formatRow($row)); }
    } else {
    // fixed using a prepared statement setup. 
    $results = $pdo->query($sql);
    while($row = $results->fetch()){
        $formatted = formatRow($row);
        array_push($result, $formatted);
     } 
    }
    $pdo = null;
    echo json_encode($result);
?>