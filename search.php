<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>COMP 3512 Assign2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="CSS/search.css">
    <script src="JS/general.js"></script>
    <script src="JS/search.js"></script>
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
        <div>
            <section id="filterWrapper">
                <h2>Filter By:</h2>
                <button class="FilterClass FilterButtonActive" id="titleFilter">Title</button>
                <button class="FilterClass FilterButton" id="countryFilter">Country</button>
                <button class="FilterClass FilterButton" id="cityFilter">City</button>
                <div id="filterInput">
                    <form action="./search.php" method="get">
                        <input type="text" name="title" placeholder="Search By Title (Leave blank for all photos)" />
                        <button type="submit">Search</button>
                    </form>
                </div>
            </section>
            <section id="searchResults">
                <h1>Search Results</h1>
                <!-- Actual PHP stuff -->
                <?php
                require "searchHelper.inc.php";
                if (isset($_GET['title'])) {
                    GetPhotosByTitle($_GET['title']);
                } else
                    GetAllPhotos();
                ?>
                <!--                        -->
            </section>
        </div>
    </main>

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>
    </footer>



</body>

</html>