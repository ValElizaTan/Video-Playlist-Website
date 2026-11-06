<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/css_reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section id="main">
        <?php require_once('header.php');

        require_once("dbInfo.php");

        $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

        // Check connection
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        ?>

        <!-- Search Bar -->
        <form class="example" action="search.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>

        <br>
        <br>

        <!-- Slideshow container -->
        <div class="slideshow-container">

            <!-- Full-width images with number and caption text -->

            <div class="mySlides fade">
                <video controls>
                    <source src="videos/Vid1.mp4" type="video/mp4">
                </video>

            </div>

            <div class="mySlides fade">
                <video controls>
                    <source src="videos/Vid17.mp4" type="video/mp4">
                </video>

            </div>


            <div class="mySlides fade">
                <video controls>
                    <source src="videos/Vid2.mp4" type="video/mp4">
                </video>

            </div>

            <div class="mySlides fade">
                <video controls>
                    <source src="videos/Vid16.mp4" type="video/mp4">
                </video>

            </div>

            <div class="mySlides fade">
                <video controls>
                    <source src="videos/Vid3.mp4" type="video/mp4">
                </video>

            </div>

            <div class="mySlides fade">
                <video controls>
                    <source src="videos/Vid15.mp4" type="video/mp4">
                </video>

            </div>

            <div class="mySlides fade">
                <video controls>
                    <source src="videos/Vid23.mp4" type="video/mp4">
                </video>

            </div>

            <div class="mySlides fade">
                <video controls>
                    <source src="videos/Vid19.mp4" type="video/mp4">
                </video>

            </div>

            <div class="mySlides fade">
                <video controls>
                    <source src="videos/Vid9.mp4" type="video/mp4">
                </video>

            </div>

            <div class="mySlides fade">
                <video controls>
                    <source src="videos/Vid22.mp4" type="video/mp4">
                </video>
            </div>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

        </div>
        <br>

        <!-- The dots/circles -->
        <div style="text-align:center">

            <span class="dot" onclick="currentSlide(1)"></span>

            <span class="dot" onclick="currentSlide(2)"></span>

            <span class="dot" onclick="currentSlide(3)"></span>

            <span class="dot" onclick="currentSlide(4)"></span>

            <span class="dot" onclick="currentSlide(5)"></span>

            <span class="dot" onclick="currentSlide(6)"></span>

            <span class="dot" onclick="currentSlide(7)"></span>

            <span class="dot" onclick="currentSlide(8)"></span>

            <span class="dot" onclick="currentSlide(9)"></span>

            <span class="dot" onclick="currentSlide(10)"></span>

        </div>

        <?php require_once("footer.php"); ?>
        <script src="js/jquery.js"></script>
        <script src="js/index.js"></script>
</body>

</html>