<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create PLaylist</title>
    <link rel="stylesheet" href="css/css_reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/createPL.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <?php require_once('header.php');

    require_once("dbInfo.php");

    $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    ?>

    <section id="main">

        <?php
        if (isset($_GET["playlistID"])) {

        ?>

        <?php
            $sqlstatement = "DELETE FROM playlist WHERE playlistID = " . $_GET["playlistID"] . "";

            if ($result = $mysqli->query($sqlstatement)) {

                echo "<h2>Playlist Deleted</h2>";
            } else {
                header("Location: mylibrary.php");
                exit();
            }
            header("Location: mylibrary.php");  // *** Re-direct ***
        }

        ?>

    </section>


    <script src="JS/jquery.js"></script>
    <script src="JS/createPL.js"></script>
</body>
<?php include_once("footer.php"); ?>

</html>