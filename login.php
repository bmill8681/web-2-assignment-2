<?php
    require_once('./config.inc.php');
    session_start();

    ini_set('display_errors', 'On');

    $email = "";
    $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = sanitizeInput($_POST["email"]);
        $password = sanitizeInput($_POST["pass"]);
        validateLogin($email, $password);
    }

    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function validateLogin($email, $password) {
        $pdo = new PDO(DBCONNECTION, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT UserID, Password FROM userslogin WHERE UserName=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($email));
        if ($stmt->rowCount()) {
            $queryResult = $stmt->fetchAll();
            foreach ($queryResult as $row) {
                if (password_verify($password, $row['Password'])) {

                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $row['UserID'];
                    $_SESSION["username"] = $email;                            

                    // Redirect user to welcome page
                    header("location: index.php");
                }
            }
            loginError("Incorrect password");
        } else {
            loginError("User with email $email not found");
        }
    }

    function loginError($a){
        echo "<script>";
        echo "alert('$a'";
        echo ");";
        echo "</script>";
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>COMP 3512 Assign2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="CSS/login.css">
</head>

<body>
    
    <nav>
        <div class="logo">LOGO</div>
        <div class="navlinks">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="search.php">Browse</a>
            <a href="countryView.php">Countries</a>
            <a href="cityView.php">Cities</a>
            <a href="profile.php">Profile</a>
            <a href="favorites.php">Favorites</a>
            <a href="login.php" class="active">Login</a>
            <a href="signup.php">Signup</a>
        </div>
        <button class="hamburger">
            <i class="fa fa-bars"></i>
        </button>
    </nav>

    <main>
        <div class="loginContainer">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                Email: <input type="email" name="email" required><br>
                Password: <input type="password" name="pass" required><br>
                <input type="submit">
            </form>

        </div>
    </main>

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>
    </footer>



</body>

</html>