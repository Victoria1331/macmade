<?php
require("includes/config.php");

// Obținerea valorilor din pagina de înscriere folosind $_POST[] și curățarea datelor trimise de utilizator.
  $firstname = $_POST['firstname'];
  $firstname = mysqli_real_escape_string($con, $firstname);

  $lastname = $_POST['lastname'];
  $lastname = mysqli_real_escape_string($con, $lastname);


  $email = $_POST['email'];
  $email = mysqli_real_escape_string($con, $email);

  $password = $_POST['password'];
 $password = mysqli_real_escape_string($con, $password);
  $password = MD5($password);

  $phone = $_POST['phone'];
  $phone = mysqli_real_escape_string($con, $phone);

  $city = $_POST['city'];
  $city = mysqli_real_escape_string($con, $city);

  $address = $_POST['address'];
  $address = mysqli_real_escape_string($con, $address);

  $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
 
//Verifică dacă ID-ul de e-mail este deja folosit pentru înregistrare
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($con, $query)or die($mysqli_error($con));
  $num = mysqli_num_rows($result);
  
  if ($num != 0) {
    $m = "<span class='red'>Email Already Exists</span>";
    header('location: signup.php?m1=' . $m);
  } else if (!preg_match($regex_email, $email)) {
    $m = "<span class='red'>Not a valid Email Id</span>";
    header('location: signup.php?m1=' . $m);
  } 
    else {
    
    $query = "INSERT INTO users(firstname, lastname, email, password, phone, city, address)VALUES('" . $firstname . "','" . $lastname . "','" . $email . "','" . $password . "','" . $phone . "','" . $city . "','" . $address . "')";
    mysqli_query($con, $query) or die(mysqli_error($con));
    $user_id = mysqli_insert_id($con);
    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $user_id;
    header('location: login.php');
  }
?>