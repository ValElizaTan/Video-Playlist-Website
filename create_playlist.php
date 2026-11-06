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

    <section id="main">

        <form action="" method="POST" class="example">
            <input type="text" name="search" id="Search" size="20" placeholder="Search">
            <input type="submit" value="submit" class="button">
            <div id="playlist_err"></div>
        </form>

        <br>

        <form action="submitpl.php" method="post" class="playlist">
            <h1>Hi <?= $_SESSION["userID"] ?>, Please enter ur playlist name below:</h1>
            <br>
            <label class="ajustment" for="PL">Playlist:</label>
            <input type="text" name="playlist" id="PL" size="20" required placeholder="Enter your playlist name">
            <div id="playlist_err"></div>
            <br>

            <div class="grid-container">

                <?php
                //search
                $filter = "";
                if (isset($_POST["search"])) {
                    $filter = "WHERE ml.title like '%" . $_POST["search"] . "%' ";
                }

                $sqlstatement = "SELECT cg.catTitle, ml.title, ml.vidFilename, ml.itemID FROM masterlist ml LEFT JOIN categories cg on ml.categoryFK=cg.catID " . $filter . " ORDER BY ml.categoryFK, ml.itemID ";

                if ($result = $mysqli->query($sqlstatement)) {
                    while ($record = $result->fetch_row()) {
                        $catTitle = $record[0];
                        $itemTitle = $record[1];
                        $videoFilename = $record[2];
                        $itemID = $record[3];
                ?>
                        <div class="col <?= strtolower($catTitle) ?>">
                            <h1 id="header"><?= $catTitle ?></h1>
                            <div class="items">
                                <table>
                                    <tr>
                                        <td colspan='2'>
                                            <video width="220" height="140" controls>
                                                <source id="video" src="videos/<?= $videoFilename ?>" type="video/mp4">
                                            </video>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><span class="itemtitle" id="name_<?= $itemID ?>"><?= $itemTitle ?></span><br></td>
                                        <td>
                                            <input id="add_button" name="<?= $itemID ?>" class="add_button" type="button" value="Add">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                <?php
                    } //while loop
                    $result->free_result();
                } //if loop
                ?>

                <div class="col totalinfo">
                    <h1>Video Added</h1>
                    <div id="itemised">
                    </div>
                    <input id="submit_button" class="button" type="submit" value="Add to Playlist">
                </div>
            </div>
        </form>
    </section>


    <script src="JS/jquery.js"></script>
    <script src="JS/createPL.js"></script>
</body>
<?php include_once("footer.php"); ?>

</html>