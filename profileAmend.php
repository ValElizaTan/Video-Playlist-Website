<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/css_reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/pfpAmend.css">
</head>

<body>
    <?php
    include 'upload.php';
    ?>

    <?php require_once("header.php"); ?>
    <!-- Link to share file -->

    <?php
    if (!isset($_SESSION["userID"])) {
        header("Location: login.php");  // *** Re-direct ***
    }

    require_once("dbInfo.php");

    $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

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
        <h1>Hi <?= $_SESSION["userID"] ?>, <br> What would you like to edit?</h1>
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
            <form action="upload.php" method="post" enctype="multipart/form-data" id="file">
                <label>Select Image File:</label>
                <br>
                <input id="choose" type="file" name="image">
                <br>
                <input type="submit" name="submit" value="Upload" id="upload">
            </form>
        </fieldset>

        <br>

        <br>
        <fieldset class="fs2" align="center">

            <br>
            <form id="pfp" action="updateprofile.php" method="post">
                <fieldset>
                    <label for="name">Username:</label><br>
                    <input type="text" name="fname" id="name" size="20" placeholder="Enter your Username" value="<?= $record[0] ?>"><br>
                    <div id="name_err"></div>
                    <br>
                    <label for="email">Email:</label><br>
                    <input type="text" name="femail" id="email" size="20" placeholder="Enter your Email Address" value="<?= $record[1] ?>"><br>
                    <div id="email_err"></div>
                    <br>
                    <label for="pwd">Password:</label><br>
                    <input type="password" name="fpwd" id="pwd" size="20" placeholder="Enter your Password" value="<?= $record[2] ?>"><br>
                    <div id="pwd_err"></div>
                    <br>
                    <label for="cfmpwd">Confirm Password:</label><br>
                    <input type="password" name="fcfmpwd" id="cfmpwd" size="20" placeholder="Confirm your Password" value="<?= $record[2] ?>"><br>
                    <div id="cfmpwd_err"></div>
                </fieldset>

                <div>
                    <input type="submit" id="submitbutton" class="button" value="Update Profile">
                    <div id="submission_err"></div>
                </div>
            </form>
        </fieldset>

    </main>

    <?php require_once("footer.php"); ?>
    <!-- Link to share file -->

    <script src="js/jquery.js"></script> <!-- to be able to access that's y its at the bottom -->
    <script src="js/updateprofile.js"></script>
    <script src="js/weather.js"></script>
    <?php
    if (isset($_GET["error"]) && $_GET["error"] == "12001") {
        echo '<script> showError(document.getElementById("submission_err"),"Sorry we do not allow multiple submission by the same username or email"); </script>';
    }
    ?>
</body>

</html>