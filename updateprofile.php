<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="css/css_reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <section id="main">
        <?php require_once("header.php"); ?>
        <br>
        <?php
        require_once("dbInfo.php");

        $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

        // Check connection
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        $sqlstatement = "SELECT * FROM users WHERE userID = '" . $_POST['fname'] . "' AND email = '" . $_POST['femail'] . "'";

        if ($results = $mysqli->query($sqlstatement)) {

            echo $results->num_rows;

            if ($results->num_rows == 0) {
                
                $sqlstatement = "UPDATE users SET email = '" . $_POST['femail'] . "', password = '" . $_POST['fpwd'] . "' WHERE userID = '" . $_POST['fname'] . "' ";

                if ($result = $mysqli->query($sqlstatement)) {
        ?>
                    <section id="main" align="center">
                        <h1>Hi <?= $_SESSION["userID"] ?>, Thank You for updating!</h1>
                    </section>

        <?php
                    header("Location: profile.php"); // *** Re-direct ***

                } else {
                    echo "Error " . $sqlstatement . "<br>" . $mysqli->error;
                    exit();
                }
            } else {
                header("Location: profileAmend.php?error=12001");
            }
        }

        $mysqli->close();

        ?>

    </section>
    <?php require_once("footer.php"); ?>
</body>

</html>