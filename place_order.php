<?php
require("includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifică dacă utilizatorul este autentificat
    if (!isset($_SESSION['email'])) {
        header('location: index.php');
        exit();
    }
    
    // Obțineți metoda de plată și metoda de livrare din formular
    $paymentMethod = $_POST['payment'];
    $deliveryMethod = $_POST['delivery'];
    
    // Obțineți id-urile produselor din parametrul URL (itemsid)
    $itemsIds = $_GET['itemsid'];
    
    
    // Exemplu:
    // Salvare în baza de date
    $userId = $_SESSION['user_id'];
    $query = "INSERT INTO user_item (user_id, items_ids, payment_method, delivery_method) VALUES ('$userId', '$itemsIds', '$paymentMethod', '$deliveryMethod')";
    mysqli_query($con, $query) or die(mysqli_error($con));
    
    // Ștergere produse din coș (dacă este necesar)
    $deleteQuery = "DELETE FROM user_item WHERE item_id IN ($itemsIds)";
    mysqli_query($con, $deleteQuery) or die(mysqli_error($con));
    
    // Redirecționează utilizatorul către o pagină de confirmare sau orice altă pagină relevantă pentru tine
    header("Location: success.php");
    exit();
}
?>

