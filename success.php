<?php
require("includes/config.php");
$user_id = $_SESSION['user_id'];
if(isset($_GET['itemsid'])){
    $item_ids_string = $_GET['itemsid'];

    // Vom schimba starea articolelor achiziționate de utilizator în „Confirmat”
    $query = "UPDATE user_item SET status=2 WHERE user_id=" . $user_id . " AND item_id IN (" . $item_ids_string . ") AND status=1";
    mysqli_query($con, $query) or die(mysqli_error($con));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Success | MacMade</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container-fluid" id="content">
        <div class="col-md-12">
            <div class="col-lg-4 col-md-6 ">
                
            </div>
        <div class="jumbotron">
                <h3 align="center">YAY!! Your order is confirmed. Thank you for shopping with us.</h3><hr>
                <p align="center">Click <a href="products.php">here</a> to purchase any other item.</p>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
</body>
</html>

    

        

