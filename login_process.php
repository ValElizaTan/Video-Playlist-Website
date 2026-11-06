<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_process</title>
</head>

<body>
    <?php
    if (!isset($_POST["fname"]) || !isset($_POST["fpwd"])) {
        echo "This page is not meant to be loaded directly";
        exit(0);
    }

    require_once("dbInfo.php");

    $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $sqlstatement = "SELECT COUNT(*) FROM users WHERE (userID ='" . $_POST["fname"] . "' OR email ='" . $_POST["fname"] . "') AND password = '" . $_POST["fpwd"] . "'";
    echo $sqlstatement . "<br>";

    //Admin here
    if ($result = $mysqli->query($sqlstatement)) {
        $record = $result->fetch_row(); //Only 1 row return from Count(*)
        //So no need to loop
        $result->free_result();
    }

    if ($record[0] ==  1) // found the user
    {
        //Start session management here
        session_start();

        // we have to query users again for Username
        $sqlstatement = "SELECT userID FROM users WHERE (userID ='" . $_POST["fname"] . "' OR email ='" . $_POST["fname"] . "') AND password = '" . $_POST["fpwd"] . "'";

        if ($result = $mysqli->query($sqlstatement)) {
            $record = $result->fetch_row(); //Only 1 row return from Count(*)
            //So no need to loop
            $result->free_result();

            $_SESSION["userID"] = $record[0]; 
            $mysqli->close();
        }

        header("Location: mylibrary.php");  // *** Re-direct ***
    } else {
        header("Location: login.php?error=11208");        // *** Re-direct ***
    }

    ?>
</body>

</html>