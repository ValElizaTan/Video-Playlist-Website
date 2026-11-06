<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="css/css_reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>

    <?php require_once('header.php');

    if (!isset($_SESSION["userID"])) {
        header("Location: login.php");
    }

    require_once("dbInfo.php");

    $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    ?>

    <?php

    $sqlstatement = "SELECT * FROM users WHERE userID ='" . $_SESSION["userID"] . "'";
    $sqlstatement . "<br>";

    //Admin here
    if ($result = $mysqli->query($sqlstatement)) {
        $record = $result->fetch_row(); //Only 1 row return from Count(*)
        //So no need to loop
        $result->free_result();
    }
    ?>
    <div id="h1">
         <h1>Hi <?= $_SESSION["userID"] ?>, <br> Welcome to your profile</h1>
    </div>

    <main class="grid-container">
        <fieldset class="fs1" align="center">
            <div id="image">
                <?php
                // Include the database configuration file  
                require_once 'dbInfo.php';

                // Get image data from database 
                $result = $mysqli->query("SELECT image FROM images ORDER BY id DESC limit 1");
                ?>
                <?php if (!empty($statusMsg)) { ?>
                    <pclass="status<?php echo $status; ?>"><?php echo $statusMsg; ?></p>
                    <?php
                }
                    ?>

                    <div id="display_image">
                        <?php if ($result->num_rows > 0) { ?>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" />
                            <?php } ?>
                        <?php } else { ?>
                            <p class="status error">Image(s) not found...</p>
                        <?php } ?>
                    </div>
            </div>
        </fieldset>
        <br>

        <br>
        <fieldset class="fs2" align="center">
            <label for="name">Username:</label><br>
            <input type="text" name="fname" id="name" size="20" placeholder="Enter your Username" value="<?= $record[0] ?>" readonly><br>
            <div id="name_err"></div>
            <br>
            <label for="email">Email:</label><br>
            <input type="text" name="femail" id="email" size="20" placeholder="Enter your Email Address" value="<?= $record[1] ?>" readonly><br>
            <div id="email_err"></div>
            <br>
            <label for="pwd">Password:</label><br>
            <input type="password" name="fpwd" id="pwd" size="20" placeholder="Enter your Password" value="<?= $record[2] ?>" readonly><br>
            <div id="pwd_err"></div>
            <br>
            <label for="cfmpwd">Confirm Password:</label><br>
            <input type="password" name="fcfmpwd" id="cfmpwd" size="20" placeholder="Confirm your Password" value="<?= $record[2] ?>" readonly><br>
            <div id="cfmpwd_err"></div>
            <div>
                <form action="profileAmend.php" method="POST">
                    <input type="submit" id="submitbutton" class="button" value="Edit Profile">
                </form>
            </div>
        </fieldset>

    </main>

    <?php require_once("footer.php"); ?>
    <!-- Link to share file -->

    <script src="js/jquery.js"></script> <!-- to be able to access that's y its at the bottom -->
    <script src="js/signup.js"></script>
    <script src="js/weather.js"></script>

</body>

</html>