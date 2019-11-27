<?php 
    require_once './config.inc.php';
    $sql = "SELECT ImageID, UserID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO, ContinentCode, ";
    $sql .= "Path, Exif, ActualCreator, CreatorURL, SourceURL, Colors FROM imagedetails WHERE 1=1 ";
    // Fix this so it isn't concatenating the sql. Use a prepared statement instead.
    if(isset($_GET['title'])){
        $sql .= "AND UPPER(Title) LIKE UPPER('%".$_GET['title']."%') ";
    }
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
    // this will also need to be fixed using a prepared statement setup.
    // check countries.php for an example. 
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $results = $pdo->query($sql);
    $result = array();
    while($row = $results->fetch()){
        $formatted = formatRow($row);
        array_push($result, $formatted);
    }
    $pdo = null;
    echo json_encode($result);
?>