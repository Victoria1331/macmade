<?php

//Stabiliți conexiunea la baza de date și începeți sesiunea
require("includes/config.php");

// Redirecționează utilizatorul către pagina de produse dacă este autentificat.
if (isset($_SESSION['email'])) {
  header('location: products.php');
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <!--instruiește browser-ul despre cum să controleze dimensiunile și scalarea paginii-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--Titlul paginii de index-->
        <title>Welcome | MacMade</title>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/styles.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body style="padding-top: 50px;">
        <!-- Antet -->
        <?php
        include 'includes/header.php';
        ?>
        <!--Sfarsitul antetului-->

        <div id="content">
            <!--Imaginea bannerului principal-->
            <div id = "banner_image">
                <div class="container"> 
                    <center>
                        <div id="banner_content">
                            <h1>Stand out with us.</h1>
                            <p>We crochet passion for YOU! </p>
                            <br/>
                            <a  href="products.php" class="btn btn-danger btn-lg active">Shop Now</a>
                        </div>
                    </center>
                </div>
            </div>
            <!--Sfârșitul imaginii bannerului principal-->

            <!--Lista categoriilor de articole-->
            <div class="container">
                <div class="row text-center" id="item_list">
                    <div class="col-sm-4">
                        <a href="products.php" >
                            <div class="thumbnail">
                                <img src="img/mar1.png" alt="" >
                                <div class="caption">
                                    <h3>The Marshmallow Collection </h3>
                                    <p></p>
                                </div>
                            </div> 
                        </a>
                    </div>

                    <div class="col-sm-4">
                        <a href="products.php" >
                            <div class="thumbnail">
                                <img src="img/oreo1.png" alt="" >
                                <div class="caption">
                                    <h3>Infinity love collection</h3>
                                    <p></p>
                                </div>
                            </div> 
                        </a>
                    </div>

                    

                    <div class="col-sm-4">
                        <a href="products.php" >
                            <div class="thumbnail">
                                <img src="img/ele3.png" alt="">
                                <div class="caption">
                                    <h3>Little dream collection</h3>
                                    <p></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <!--Lista categoriilor de articole-->
        </div>
        
        
        <?php
        include 'includes/footer.php';
        ?>
        
    </body> 
</html>