<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["userType"] !== "user") {
    header("Location: login.php");
    exit();
}

$cnn = mysqli_connect("localhost", "root", "", "delbanis_resto");
if (!$cnn) {
    echo "Error in connection: " . mysqli_connect_error();
    exit();
}

$pid = isset($_GET["pid"]) ? mysqli_real_escape_string($cnn, $_GET["pid"]) : null;

/* if (!$pid || !is_numeric($pid)) {
    echo "Invalid product ID.";
    exit();
} */

$uid = $_SESSION['id'];

$sql = "DELETE FROM cart WHERE uid = $uid AND pid = $pid";


if (mysqli_query($cnn, $sql)) {
    header("Location: cart.php");
    exit();
} else {
    echo "<script>alert('An error occurred while deleting the product from the cart: " . mysqli_error($cnn)."')</script>";
}

?>
