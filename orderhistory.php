<?php
// Se include fișierul de configurare
require("includes/config.php");

// Verificăm dacă utilizatorul este autentificat
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order History | MacMade</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url("https://images.pexels.com/photos/4792072/pexels-photo-4792072.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            color: #000000;
        }

        #content {
            padding: 100px 0;
        }

        #settings-container {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            background-color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>
<div class="container-fluid" id="content">
    <?php include 'includes/header.php'; ?>
    <div class="col-lg-4 col-md-6">
        <!-- <img src="img/hiss.png" style="float:center;">-->
    </div>
    <div class="row decor_bg">
        <div class="col-md-6">
            <table class="table table-striped">
                <?php
                $user_id = $_SESSION['user_id'];

                // Interogarea pentru tabela "orders"
                $query = "SELECT firstname, lastname, total_amount, delivery_method, payment_method
                          FROM orders
                          WHERE user_id = '$user_id'";

                $result = mysqli_query($con, $query) or die(mysqli_error($con));

                if (mysqli_num_rows($result) >= 1) {
                    ?>
                    <h1 style="margin-bottom: 20px; font-weight: 20;"><center>Order History</center></h1>
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Total Amount</th>
                        <th>Delivery Method</th>
                        <th>Payment Method</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<tr><td>' . $row["firstname"] . '</td>';
                        echo '<td>' . $row["lastname"] . '</td>';
                        echo '<td>' . $row["total_amount"] . '</td>';
                        echo '<td>' . $row["delivery_method"] . '</td>';
                        echo '<td>' . $row["payment_method"] . '</td></tr>';
                    }
                    ?>
                    </tbody>
                    <?php
                } else {
                    echo "<span style='color: white;'>Sorry! No orders placed yet</span>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>
