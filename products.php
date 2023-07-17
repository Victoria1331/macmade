
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Instruiți browserului cum să controleze dimensiunile și scalarea paginii -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Titlul paginii de produse -->
    <title>Products | MacMade</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    // Stabiliți conexiunea la baza de date și începeți sesiunea
    require("includes/config.php");

    // Verificați dacă au fost trimise datele de modificare a numelui și prețului
    if (isset($_POST['product_name']) && isset($_POST['product_price'])) {
        $new_name = $_POST['product_name'];
        $new_price = $_POST['product_price'];

        // Actualizați numele și prețul tuturor produselor din baza de date
        $query = "UPDATE items SET name='$new_name', price='$new_price'";
        mysqli_query($con, $query);

        // Redirecționați utilizatorul către pagina de produse actualizată
        header("Location: products.php");
        exit();
    }

    // Obține informații despre toate produsele din baza de date
    $query = "SELECT * FROM items";
    $result = mysqli_query($con, $query);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    
    <?php 
    include 'includes/header.php';
    include 'includes/header.php';
    include 'includes/check-if-added.php';
    ?>
    
    <div class="container" id="content">
        <!-- Antet Jumbotron -->
        <div class="jumbotron home-spacer" id="products-jumbotron">
            <h1>Welcome to our MacMade Store!</h1>
            <p>Our designs range from simple and elegant to complex and bold.</p>
        </div>
        <hr>

        <div class="row text-center" id="products">
            <?php foreach ($products as $product) { ?>
                <div class="col-md-3 col-sm-6 home-feature">
                    <div class="thumbnail">
                        <img src="img/<?php echo $product['image_item']; ?>" alt="">
                        <div class="caption">
                            <h3><?php echo $product['name']; ?></h3>
                            <p class="price"><?php echo $product['price']; ?> euro</p>
                            <!-- Utilizatorul trebuie să se autentifice pentru a cumpăra articolele -->
                            <?php if (!isset($_SESSION['email'])) { ?>
                                <p><a href="login.php" role="button" class="btn btn-primary btn-block">Shop Now</a></p>
                            <?php } else {
                                if (check_if_added_to_cart($product['id'])) {
                                    echo '<a href="#" class="btn btn-block btn-success" disabled>Added to cart</a>';
                                } else {
                                    ?>
                                    <a href="cart_add.php?id=<?php echo $product['id']; ?>" class="btn btn-block btn-primary">Shop Now</a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
<style>
    .btn-primary,
.btn-success {
    width: 100%;
}

@media (max-width: 767px) {
    .col-md-3.col-sm-6.home-feature {
        width: 50%;
    }
}
.row.text-center {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.col-md-3.col-sm-6.home-feature {
    width: 25%;
    padding: 10px;
}

.thumbnail {
    position: relative;
    overflow: hidden;
    height: 100%;
}

.thumbnail img {
    display: block;
    width: 100%;
    height: auto;
}
    </style>
</html>
