<?php 
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        if(isset($_GET["imageid"])){
            // Setup sessions array
            $favsList = array();
            if(isset($_SESSION['favorites'])){
                $favsList = $_SESSION['favorites'];
            }
            $found = array_search($_GET['imageid'], $favsList, true);

            unset($favsList[$found]);
            array_values($favsList);
            $_SESSION['favorites'] = $favsList;
            
            echo json_encode(true);
            // Store to session data       
        }
        if(isset($_GET['all'])){
            $_SESSION['favorites'] = array();
            echo json_encode(true);
        }
    }
?>