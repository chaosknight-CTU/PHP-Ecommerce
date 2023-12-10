<?php
  $ten = $_POST['customerName'];
  $diachi = $_POST['customerAddress'];
  $sdt = $_POST['customerPhone'];
  $mail = $_POST['customerEmail'];


  require_once("../db.php");

  $themsql = "INSERT INTO customers (name, address, phone , email) VALUES ('$ten', '$diachi', '$sdt', '$mail')";

  mysqli_query($conn, $themsql);

  header("Location: list_customer.php");
