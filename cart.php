<?php
require("includes/config.php");

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}

// Procesează formularul de plasare a comenzii
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preiați datele din formular
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $deliveryMethod = $_POST['delivery'];
    $paymentMethod = $_POST['payment'];

    // Calculează costul de livrare
    $deliveryCost = 0;
    if ($deliveryMethod == "FanCurier") {
        $deliveryCost = 15;
    } elseif ($deliveryMethod == "PostaRomana") {
        $deliveryCost = 5;
    }

    // Calculează suma totală
    $sum = 0;
    $itemsIds = '';
    $user_id = $_SESSION['user_id'];
    $query = "SELECT items.price AS Price, items.id AS id, items.name AS Name FROM user_item JOIN items ON user_item.item_id = items.id WHERE user_item.user_id='$user_id' AND `status`=1";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    
    while ($row = mysqli_fetch_array($result)) {
        $sum += $row["Price"];
        $itemsIds .= $row["id"] . ",";
    }

    $itemsIds = rtrim($itemsIds, ",");
    $totalAmount = $sum + $deliveryCost;

    // Salvează detaliile comenzii în baza de date
    $query = "INSERT INTO orders (user_id, firstname, lastname, city, address, phone, email, delivery_method, delivery_cost, payment_method, total_amount) VALUES ('$user_id', '$firstname', '$lastname', '$city', '$address', '$phone', '$email', '$deliveryMethod', '$deliveryCost', '$paymentMethod', '$totalAmount')";
    mysqli_query($con, $query) or die(mysqli_error($con));

    // Șterge produsele din coș
    $deleteQuery = "DELETE FROM user_item WHERE item_id IN ($itemsIds)";
    mysqli_query($con, $deleteQuery) or die(mysqli_error($con));

    // Redirecționează utilizatorul către o pagină de confirmare sau orice altă pagină relevantă pentru tine
    header("Location: success.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart | MacMade</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid" id="content">
        <?php include 'includes/header.php'; ?>
        <div class="col-lg-4 col-md-6">
            <img src="img/confirmorder.png" style="float: left;">
        </div>
        
        <div class="row decor_bg">
            <div class="col-md-6">
                <?php
                $user_id = $_SESSION['user_id'];
                $query = "SELECT items.price AS Price, items.id AS id, items.name AS Name FROM user_item JOIN items ON user_item.item_id = items.id WHERE user_item.user_id='$user_id' AND `status`=1";
                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                
                if (mysqli_num_rows($result) >= 1) {
                    $sum = 0;
                    $deliveryCost = 0;
                    $id = '';
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item Number</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($result)) {
                            $sum += $row["Price"];
                            $id .= $row["id"] . ", ";
                            echo "<tr><td>" . "#" . $row["id"] . "</td><td>" . $row["Name"] . "</td><td>Rs " . $row["Price"] . "</td><td><a href='cart_remove.php?id={$row['id']}' class='remove_item_link'> Remove</a></td></tr>";
                        }
                        
                        $id = rtrim($id, ", ");
                        $totalAmount = $sum + $deliveryCost;
                        //echo "<tr><td></td><td>Total</td><td>Rs " . $sum . "</td><td><a href='success.php?itemsid=" . $id . "' class='btn btn-primary'>Confirm Order</a></td></tr>";
                        ?>
                    </tbody>
                </table>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="delivery">Delivery Method</label>
                        <select class="form-control" id="delivery" name="delivery">
                            <option value="FanCurier">FanCurier (15 lei)</option>
                            <option value="PostaRomana">Posta Romana (5 lei)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment">Payment Method</label>
                        <select class="form-control" id="payment" name="payment">
                            <option value="Cash">Cash</option>
                            <option value="Card">Card</option>
                        </select>
                        
                        <p id="card-message" class="text-danger" style="display: none;">Card payment is currently unavailable.</p>
                    </div>
                    <div class="logo-container">
        <div class="payment-logos">
            <a href="https://www.paypal.com/ro/home">
                <img src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-100px.png" alt="PayPal">
            </a>
        </div>

        <div class="courier-logos">
            <a href="https://www.fancourier.ro/">
                <img src="img/fancurier.png" alt="Fan Courier">
            </a>
            <a href="https://www.posta-romana.ro/">
                <img src="img/posta.png" alt="Poșta Română">
            </a>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Place Order</button>
</form>

<script>
    var paymentSelect = document.getElementById('payment');
    var cardMessage = document.getElementById('card-message');

    paymentSelect.addEventListener('change', function() {
        if (paymentSelect.value === 'Card') {
            cardMessage.style.display = 'block';
        } else {
            cardMessage.style.display = 'none';
        }
    });
                    </script>

                <?php
                } else {
                    echo "Heyy!! Your Cart is Empty. Please add items to the cart first!";
                }
                ?>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
</body>
</html>
