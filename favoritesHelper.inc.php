<?php 

    require_once './config.inc.php';

    function AddToFavs($userid, $imageid){
        $pdo = new PDO(DBCONNECTION, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "SELECT UserID, ImageID FROM USERFAVS WHERE UserID LIKE :userid AND ImageID LIKE :imageid";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":userid", $userid);
        $statement->bindValue(":imageid", $imageid);
        $statement->execute();
        $queryResult = $statement->fetchAll();
        if(count($queryResult) == 0){
            $sql = "INSERT INTO USERFAVS (UserID, ImageID) VALUES(:userid, :imageid)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(":userid", $userid);
            $statement->bindValue(":imageid", $imageid);
            try {
                $statement->execute();
                // From https://stackoverflow.com/questions/13851528/how-to-pop-an-alert-message-box-using-php
                echo "<script type='text/javascript'>alert('Added image to favorites');</script>";
            }
            catch (Exception $e) {
                echo "<script type='text/javascript'>alert('Error. Unable to add image to favorites');</script>";
            }
        }
        else{
            echo "<script type='text/javascript'>alert('Image already added to favorites!');</script>";
        }
        $pdo = null;
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

    function GetBaseSQL(){
        $sql = "SELECT U.UserID, I.ImageID, I.UserID, I.Title, I.Description, I.Latitude, I.Longitude, I.CityCode, I.CountryCodeISO, I.ContinentCode, ";
        $sql .= "I.Path, I.Exif, I.ActualCreator, I.CreatorURL, I.SourceURL, I.Colors FROM imagedetails I ";
        return $sql;
    }

    function GetUserFavorites($userid){
        $pdo = new PDO(DBCONNECTION, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = array();
        $sql = GetBaseSQL();
        $sql .= "JOIN USERFAVS U ON I.ImageID = U.ImageID WHERE U.UserID LIKE :userid ";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":userid", $userid);
        $statement->execute();
        $queryResult = $statement->fetchAll();
        foreach ($queryResult as $row) {
            array_push($result, formatRow($row));
        }
        $pdo = null;
        return $result;
    }
?>