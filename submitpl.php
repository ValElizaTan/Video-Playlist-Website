<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account created</title>
    <link rel="stylesheet" href="css/css_reset.css">
    <link rel="stylesheet" href="css/global.css">
</head>

<body>
    <section id="main">
        <?php require_once("header.php"); ?>

        <?php
        require_once("dbinfo.php");

        $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

        // Check connection
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        date_default_timezone_set("Singapore");
        $sqlstatement = "INSERT INTO playlist(playlistName, userFK, createDate) VALUES ('" . $_POST['playlist'] . "','" . $_SESSION['userID'] . "','" .  date("Y-m-d") . "')";

        if ($result = $mysqli->query($sqlstatement)) {

            $newOrderID = $mysqli->insert_id;


            echo "<p>User " . $_SESSION["userID"] . " added a playlist on " . date("Y-m-d") . " with the following items </p>";


            $addedLists = explode(",",  $_POST['addedLists']);
            //SQL statments for insert multiple records
            foreach ($addedLists as $itemFK => $qty) {
                $sqlstatement = "INSERT INTO playitems(playlistFK, masterlistFK) VALUES ($newOrderID,'" .  $qty . "')";

                if ($result = $mysqli->query($sqlstatement)) {
                    echo "<p>ItemID $itemFK with quantity $qty </p>";
                } else {
                    echo "Error : " . $sqlstatement . "<br>" . $mysqli->error;
                    exit();
                }
            }
            header("Location: mylibrary.php");  // *** Re-direct ***
        } else {
            echo "Error : " . $sqlstatement . "<br>" . $mysqli->error;
            exit();
        }


        ?>
    </section>
    <?php require_once("footer.php"); ?>
    <!-- Link to share file -->
</body>

</html>