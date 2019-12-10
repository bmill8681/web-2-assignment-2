<?php
// We were struggling with a 'Cannot modify header information' after a request has been made
// we found that this solution of turning on PHP output buffering seemed to fix our problem.
// The reference for this solution can be found here: 
// https://stackoverflow.com/questions/9707693/warning-cannot-modify-header-information-headers-already-sent-by-error?noredirect=1&lq=1
ob_start();
require_once('./config.inc.php');
session_start();

ini_set('display_errors', 'On');

// $email = "";
// $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["pass"]);
    validateLogin($email, $password);
}

function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateLogin($email, $password)
{
    $pdo = new PDO(DBCONNECTION, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT UserID, Password FROM userslogin WHERE UserName=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($email));
    $queryResult = $stmt->fetch();
    if ($queryResult) {
        if (password_verify($password, $queryResult['Password'])) {

            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $queryResult['UserID'];
            $_SESSION["username"] = $email;

        } else {
            loginError("Incorrect password");
        }
    } else {
        loginError("User with email $email not found");
    }
}

function loginError($a)
{
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
    <script src="JS/general.js"></script>
    <!--    <link rel="stylesheet" href="CSS/login.css">-->
</head>

<body>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        header("location: index.php");
    }
    ?>

    <nav>
        <div class="logo"></div>
        <div class="navlinks">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="search.php">Browse</a>
            <a href="single-country.php">Countries</a>
            <a href="single-city.php">Cities</a>
            <?php
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                echo '<a href="profile.php">Profile</a>';
                echo '<a href="favorites.php">Favorites</a>';
                echo "<a href='logout.php'>Logout</a>";
            } else {
                echo "<a href='login.php' class='active'>Login</a>";
                echo '<a href="signup.php">Signup</a>';
            }
            ?>
        </div>
        <button class="hamburger">
            <i class="fa fa-bars"></i>
        </button>
    </nav>

    <main>

        <div class="loginContainer">

            <h1> Sign in</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="email">Email Address</label>
                <input type="email" placeholder="Email" name="email" required />
                <label for="password"> Password</label>
                <input type="password" placeholder="Password" name="pass" required />
                <input type="submit">
            </form>
            <p>Do not have an account? <a href="signup.php">Sign up</a>.</p>
        </div>
    </main>

    <footer>
        <p class="copyright">© COMP 3512 | Brendon - Brett - David - Nhatty | Dec.2019</p>
    </footer>



</body>

</html>