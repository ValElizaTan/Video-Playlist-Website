<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link rel="stylesheet" href="css/css_reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/search.css">
    <!-- Load icon library -->
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
            <button type="submit"><i class="fa fa-search"></i></button>
            <div id="playlist_err"></div>
        </form>
        <br>
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
                                        <video width="220" height="140" controls id="vid_<?= $itemID ?>">
                                            <source id="video" src="videos/<?= $videoFilename ?>" type="video/mp4">
                                        </video>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span id="itemtitle" class="<?= $itemTitle ?>"><?= $itemTitle ?></span><br></td>
                                </tr>
                            </table>
                        </div>
                    </div>
            <?php
                } //while loop
                $result->free_result();
            } //if loop
            ?>
        </div>
        </form>
    </section>


    <script src="JS/jquery.js"></script>
    <script src="JS/createPL.js"></script>
</body>
<?php include_once("footer.php"); ?>

</html>