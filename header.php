<header>
    <div id="box"><a href="index.php"><img src="images/Logo.png" id="logo" title="Logo" alt="logo"></a></div>
    <nav>
        <label for="hamburger">&#9776;</label>
        <input type="checkbox" id="hamburger" />
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="mylibrary.php">Library</a></li>
            <?php
            session_start();

            if (isset($_SESSION["userID"])) {
                echo '<div class="btn"><li><a href="logout.php">Logout</a></li></div>';
            } else {
                echo '<div class="btn"><li><a href="login.php">Login</a></li></div>';
            }
            ?>
        </ul>
    </nav>
</header>