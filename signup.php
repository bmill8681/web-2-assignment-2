<?php
    require_once('./config.inc.php');
    session_start();

    ini_set('display_errors', 'On');

    $email = "";
    $password = "";
    $confirmpassword = "";
    $firstname = "";
    $lastname = "";
    $city = "";
    $country = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = sanitizeInput($_POST["firstname"]);
        $lastname = sanitizeInput($_POST["lastname"]);
        $country = sanitizeInput($_POST["country"]);
        $city = sanitizeInput($_POST["city"]);
        $email = sanitizeInput($_POST["email"]);
        $password = sanitizeInput($_POST["pass"]);
        $confirmpassword = sanitizeInput($_POST["pass-repeat"]);
        if ($password != $confirmpassword) {
            loginError("Passwords do not match. Try Again.");
        } else {
            $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (emailAlreadyExists($email, $pdo)) {
                loginError("$email already exists. Try Again.");
            } else {
                $digest = password_hash( $password, PASSWORD_BCRYPT, ['cost' => 12] );
                $sql = "INSERT INTO userslogin (UserName, Password) VALUES (?,?)";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute(array($email, $digest))) {
                    $stmt = null;
                    $userID = $pdo->lastInsertId();
                    $sql = "INSERT INTO users (UserID, FirstName, LastName, City, Country, Email) VALUES (?,?,?,?,?,?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($userID, $firstname, $lastname, $city, $country, $email));
                    $stmt = null;
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $userID;
                    $_SESSION["username"] = $email;                            

                    // Redirect user to welcome page
                    header("location: home.php");                
                } else {
                    loginError("Error with signing up. Please try again.");
                }
                $sql = "INSERT INTO users () VALUES ()";
                
            }
            $pdo = null;
        }
    }
    
    function emailAlreadyExists($email, $pdo) {
        $sql = "SELECT UserID FROM userslogin WHERE UserName=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($email));
        if ($stmt->rowCount()) {
            $stmt = null;
            return true;
        }
        return false;
    }

    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
    <script src="JS/general.js"></script>
</head>

<body>
    <nav>
        <div class="logo">LOGO</div>
        <div class="navlinks">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="search.php">Browse</a>
            <a href="countryView.php">Countries</a>
            <a href="cityView.php">Cities</a>
            <a href="upload.php">Upload</a>
            <a href="profile.php">Profile</a>
            <a href="favorites.php">Favorites</a>
            <a href="login.php">Login</a>
            <a href="signup.php"  class="active">Signup</a>
        </div>
        <button class="hamburger">
            <i class="fa fa-bars"></i>
        </button>
    </nav>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div>
                <h1>Register</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <label for="firstname"><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" name="firstname" value='<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>' required>
                <br>
                <label for="lastname"><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" name="lastname" value='<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>' required>
                <br>
                <label for="city"><b>City</b></label>
                <input type="text" placeholder="Enter City" name="city" value='<?php echo isset($_POST['city']) ? $_POST['city'] : ''; ?>' required>
                <br>
                <label for="country"><b>Country</b></label>
                <input type="text" placeholder="Enter Country" name="country" value='<?php echo isset($_POST['country']) ? $_POST['country'] : ''; ?>' required>
                <br>
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="email" value='<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>' required>
                <br>
                <label for="pass"><b>Password</b></label>
                <input type="password" minlength=8 placeholder="Enter Password" name="pass" required>
                <br>
                <label for="pass-repeat"><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirm Password" name="pass-repeat" required>
                <hr>
                <button type="submit">Sign Up</button>
            </div>
  
            <div>
                <p>Already have an account? <a href="login.php">Sign in</a>.</p>
            </div>
        </form>
    </main>

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>
    </footer>



</body>

</html>