<?php

require("includes/config.php");
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET["id"]; 
    $user_id = $_SESSION['user_id'];
    
    // Ștergeți rândurile din tabelul user_items unde item_id și user_id sunt egale cu item_id 
    //și user_id pe care le-am primit din pagina coșului și din sesiune
    $query = "DELETE FROM user_item WHERE item_id='$item_id' AND user_id='$user_id' AND status= 1";
    $res = mysqli_query($con, $query) or die($mysqli_error($con));
    header("location:cart.php");
}
?>