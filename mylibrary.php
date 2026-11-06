<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Playlist</title>
    <link rel="stylesheet" href="css/css_reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/library.css">
</head>

<body>
    <section id="main">
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
            <h1><?= $_SESSION["userID"] ?>'s Library</h1>

            <div class="grid-container">
                <div class="col totalinfo">
                    <h2>My Playlists</h2>
                    <div id="itemised">
                        <table class="itemtable">
                            <tbody>
                                <?php

                                $sqlstatement = "SELECT createDate, playlistID, playlistName FROM playlist WHERE userFK = '" . $_SESSION["userID"] . "' ORDER BY playlistID ASC ";

                                date_default_timezone_set("Singapore");
                                if ($result = $mysqli->query($sqlstatement)) {

                                    while ($record = $result->fetch_row()) {
                                        $createDate = date_create($record[0]);
                                        $playlistID = $record[1];


                                ?>
                                        <tr>
                                            <td>
                                                <a href="mylibrary.php?playlistID=<?= $playlistID ?>"><?= $record[2] ?></a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "Error : " . $sqlstatement . "<br>" . $mysqli->error;
                                    exit();
                                }
                                ?>

                                <?php
                                error_reporting(E_ALL);
                                ini_set('display_errors', 0);
                                ?>

                                <tr>
                                    <td id="delete">
                                        <a href="deleteplaylist.php?playlistID=<?= $playlistID ?>">Delete Playlist</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                if (isset($_GET["playlistID"])) {

                ?>

                    <div class="col totalinfo">

                        <?php
                        $sqlstatement = "SELECT playlistName FROM playlist WHERE playlistID = " . $_GET["playlistID"] . "";

                        if ($result = $mysqli->query($sqlstatement)) {
                            if ($result->num_rows == 1) {                            // if record found
                                $record = $result->fetch_row();

                                echo "<h2>Playlist Details for " . $record[0] . "</h2>";
                            } else {
                                echo "Error : " . $sqlstatement . "<br>" . $mysqli->error;
                                exit();
                            }
                        }

                        ?>

                        <div id="itemised">
                            <table class="itemtable">
                                <tbody>
                                    <tr>
                                        <th>Title of Video</th>
                                    </tr>
                                    <?php
                                    $sqlstatement = "SELECT ml.title, ml.vidFilename, ml.itemID FROM playitems pl LEFT JOIN masterlist ml ON pl.masterlistFK=ml.itemID WHERE playlistFK = " . $_GET["playlistID"] . " ORDER BY playItemID ";

                                    if ($result = $mysqli->query($sqlstatement)) {
                                        $subTotal = 0;
                                        while ($record = $result->fetch_row()) {
                                            $playTitle = $record[0];
                                            $VideoFilename = $record[1];
                                            $playID = $record[2];
                                    ?>
                                            <tr>
                                                <td>
                                                    <a href="mylibrary.php?playlistID=<?= $_GET["playlistID"] ?> &amp;video=<?= $record[1] ?>"><?= $playTitle ?></a>
                                                </td>
                                            </tr>

                                    <?php
                                        }
                                    } else {
                                        echo "Error : " . $sqlstatement . "<br>" . $mysqli->error;
                                        exit();
                                    }

                                    ?>

                                    <tr>
                                        <td id="vid">
                                            <video controls>
                                                <source src="videos/<?= (isset($_GET["video"]) ? $_GET["video"] : "") ?>" alt="<?= $playTitle ?>" type="video/mp4">
                                            </video>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <?php
                }
                ?>

                <div class="col totalinfo">
                    <h2>Create Playlist</h2>
                    <div id="itemised">
                        <table class="itemtable">
                            <tbody>
                                <tr>
                                    <td>
                                        <form action="create_playlist.php" method="POST" class="example">
                                            <button type="submit" class="button">Add New Playlist</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </section>
        <?php
        if (isset($_GET["error"]) && $_GET["error"] == "12001") {
            echo '<script> showError(document.getElementById("submission_err"),"Sorry we do not allow multiple submission by the same username or email"); </script>';
        }
        ?>

        <?php require_once('footer.php'); ?>
</body>

</html>