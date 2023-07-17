<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="css/bootstrap.css" rel="stylesheet">
         <link href="css/styles.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php
        include 'includes/header.php';
        ?>
    <h1>Checkout</h1>
    <div class="container" id="content">
    <form method="post" action="process_checkout.php">
        <label for="name">Nume:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="address">Adresă de livrare:</label>
        <textarea id="address" name="address" required></textarea><br>
        
        <label for="payment">Metoda de plată:</label>
        <select id="payment" name="payment_status" required>
            <option value="card">Card de credit</option>
            <option value="paypal">PayPal</option>
            <option value="cash">Plată la livrare</option>
        </select><br>
        
        <label for="delivery">Metoda de livrare:</label>
        <select id="delivery" name="delivery_status" required>
            <option value="standard">Standard</option>
            <option value="express">Express</option>
        </select><br>
       
        <input type="submit" value="Plasează comanda">
         </div>
        <?php
        include 'includes/footer.php';
        ?>
    </form>
</body>
</html>
