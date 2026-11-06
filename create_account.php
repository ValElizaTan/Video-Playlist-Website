<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="css/css_reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/createaccount.css">
</head>

<body>
    <?php require_once("header.php"); ?>
    <!-- Link to share file -->
    <section id="main">
        <h1>Create an Account</h1>
        <div align="center">
            <form name="createaccount" id="createaccount" action="submitcreateaccount.php" method="post">
                <fieldset>
                    <label for="name">Username:</label><br>
                    <input type="text" name="fname" id="name" size="20" placeholder="Enter your Username"><br>
                    <div id="name_err"></div>
                    <br>
                    <label for="email">Email:</label><br>
                    <input type="text" name="femail" id="email" size="20" placeholder="Enter your Email Address"><br>
                    <div id="email_err"></div>
                    <br>
                    <label for="pwd">Password:</label><br>
                    <input type="password" name="fpwd" id="pwd" size="20" placeholder="Enter your Password"><br>
                    <div id="pwd_err"></div>
                    <br>
                    <label for="cfmpwd">Confirm Password:</label><br>
                    <input type="password" name="fcfmpwd" id="cfmpwd" size="20" placeholder="Confirm your Password"><br>
                    <div id="cfmpwd_err"></div>
                    <br>
                    <input type="submit" id="submitbutton" class="button" value="Submit Form">
                    <div id="submission_err"></div>
                </fieldset>
            </form>
        </div>
    </section>

    <?php require_once("footer.php"); ?>
    <!-- Link to share file -->
    <script src="js/jquery.js"></script>
    <script src="js/signup.js"></script>
    <?php
    if (isset($_GET["error"]) && $_GET["error"] == "12001") {
        echo '<script> showError(document.getElementById("submission_err"),"Sorry we do not allow multiple submission by the same username or email"); </script>';
    }
    ?>
</body>

</html>