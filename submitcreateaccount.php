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

        // micro project A2 checking 
        /* use echo to check for error of SQL statment */
        $sqlstatement = "SELECT * FROM users WHERE userID = '" . $_POST['fname'] . "' or email = '" . $_POST['femail'] . "'";

        if ($results = $mysqli->query($sqlstatement)) {

            $results->num_rows;

            if ($results->num_rows == 0) {

                // insert from Ex A1
                $sqlstatement = "INSERT INTO users (userID, email, password) VALUES ('" . $_POST['fname'] . "','" . $_POST['femail'] . "','" . $_POST['fpwd'] . "')";

                if ($results = $mysqli->query($sqlstatement)) {
                    header("Location: login.php");
                } else {
                    echo "Error " . $sqlstatement . "<br>" . $mysqli->error;
                    exit();
                }
            } else {
                header("Location: create_account.php?error=12001");
            }
        }


        $mysqli->close();

        ?>
    </section>
    <?php require_once("footer.php"); ?>
    <!-- Link to share file -->
</body>

</html>