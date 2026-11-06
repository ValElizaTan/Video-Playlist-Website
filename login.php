<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="css/css_reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <?php require_once("header.php"); ?>
    <!-- Link to share file -->
    <section id="main">
        <h1>Login</h1>
        <div align="center">
            <form id="login" action="login_process.php" method="post">
                <fieldset>
                    <div class="user">
                        <label for="userid" class="id">Username / Email:</label>
                        <br>
                        <input type="text" name="fname" placeholder="Enter username or email">
                    </div>
                    <br>
                    <br>
                    <div class="pass">
                        <label for="passwd" class="pwd">Password:</label>
                        <br>
                        <input id="password" type="password" name="fpwd" placeholder="Enter password">
                    </div>
                    <br>
                    <input type="checkbox" onclick="myFunction()">Show Password
                    <br>
                    <div class="btn">
                        <input class="button" type="submit" value="Login">
                    </div>
                </fieldset>
            </form>

            <br>

            <?php
            if (isset($_GET['error'])) {
                echo "<p>Invalid Login. Try again.</p>";
            }
            ?>

            <br>

            <form action="create_account.php" method="post">
                <h2>Don't have an Account?</h2>
                <input class="button" type="submit" value="Sign Up" />
            </form>

            <?php require_once("footer.php"); ?>
            <!-- Link to share file -->
        </div>
    </section>

    <script src="js/jquery.js"></script> <!-- to be able to access that's y its at the bottom -->
    <script src="js/login.js"></script>
</body>

</html>