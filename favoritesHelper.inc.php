<?php 
    session_start();
    require_once './config.inc.php';

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        if(isset($_GET["imageid"])){
            // Setup sessions array
                $favsList = array();
                if(isset($_SESSION['favorites'])){
                    $favsList = $_SESSION['favorites'];
                }

            // Preparing SQL
            $pdo = new PDO(DBCONNECTION, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $sql = GetBaseSQL();
            $sql = "SELECT ImageID FROM imagedetails WHERE ImageID = :imageid ";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(":imageid", $_GET["imageid"]);
            $statement->execute();
            $queryResult = $statement->fetch();
            $pdo = null;

            // Store to session data
            if($queryResult){
                array_push($favsList, $_GET['imageid']);
                $_SESSION['favorites'] = $favsList;
                echo json_encode(true);    
            }
            else {
                echo json_encode(false); 
            }        
        }
    }

    /*  Brett:  I mistakingly assumed that we would be storing the favorites info into the database, not sessions
    /           So, the code below handles inserting and retrieving the record from the database. Oops!
    */

    // function AddToFavsDB($userid, $imageid){
    //     $pdo = new PDO(DBCONNECTION, DBUSER, DBPASS);
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    //     $sql = "SELECT UserID, ImageID FROM USERFAVS WHERE UserID LIKE :userid AND ImageID LIKE :imageid";
    //     $statement = $pdo->prepare($sql);
    //     $statement->bindValue(":userid", $userid);
    //     $statement->bindValue(":imageid", $imageid);
    //     $statement->execute();
    //     $queryResult = $statement->fetchAll();
    //     if(count($queryResult) == 0){
    //         $sql = "INSERT INTO USERFAVS (UserID, ImageID) VALUES(:userid, :imageid)";
    //         $statement = $pdo->prepare($sql);
    //         $statement->bindValue(":userid", $userid);
    //         $statement->bindValue(":imageid", $imageid);
    //         try {
    //             $statement->execute();
    //             // From https://stackoverflow.com/questions/13851528/how-to-pop-an-alert-message-box-using-php
    //             echo "<script type='text/javascript'>alert('Added image to favorites');</script>";
    //         }
    //         catch (Exception $e) {
    //             echo "<script type='text/javascript'>alert('Error. Unable to add image to favorites');</script>";
    //         }
    //     }
    //     else{
    //         echo "<script type='text/javascript'>alert('Image already added to favorites!');</script>";
    //     }
    //     $pdo = null;
    // }

    // function GetBaseSQL(){
    //     $sql = "SELECT U.UserID, I.ImageID, I.UserID, I.Title, I.Description, I.Latitude, I.Longitude, I.CityCode, I.CountryCodeISO, I.ContinentCode, ";
    //     $sql .= "I.Path, I.Exif, I.ActualCreator, I.CreatorURL, I.SourceURL, I.Colors FROM imagedetails I ";
    //     return $sql;
    // }

    // function GetUserFavoritesDB($userid){
    //     $pdo = new PDO(DBCONNECTION, DBUSER, DBPASS);
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     $result = array();
    //     $sql = GetBaseSQL();
    //     $sql .= "JOIN USERFAVS U ON I.ImageID = U.ImageID WHERE U.UserID LIKE :userid ";
    //     $statement = $pdo->prepare($sql);
    //     $statement->bindValue(":userid", $userid);
    //     $statement->execute();
    //     $queryResult = $statement->fetchAll();
    //     foreach ($queryResult as $row) {
    //         array_push($result, formatRow($row));
    //     }
    //     $pdo = null;
    //     return $result;
    // }
