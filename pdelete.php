<?php
session_start();

   if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["userType"] !== "admin") {
       header("Location: login.php");
       exit();
   }


   $cnn = mysqli_connect("localhost", "root", "", "delbanis_resto");
   if (!$cnn) {
       echo "Error in connection: ";
       exit();
   }

$pid = $_GET["pid"];

// Delete user from the cart table
$sqlDeleteFromCart = "DELETE FROM cart WHERE pid = $pid";
if (!mysqli_query($cnn, $sqlDeleteFromCart)) {
    echo "An error occurred while deleting user from cart table!";
    exit();
}

$sql = "DELETE FROM products WHERE pid = $pid";

if (mysqli_query($cnn,$sql)){
    header("Location: admin.php");
}
else{
    echo "an error occured while deleting !!";
}
?>
