<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["userType"] !== "user") {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_SESSION['id'];
    $pid = $_POST['pid'];

    $cnn = mysqli_connect("localhost", "root", "", "delbanis_resto");
    if (!$cnn) {
        echo "Error in connection: ";
        exit();
    }

    $check = "SELECT * FROM cart WHERE uid = $uid AND pid = $pid";

    $result = mysqli_query($cnn, $check);

    if (mysqli_num_rows($result) == 0) {
        $sql= "INSERT INTO cart (uid, pid) VALUES ($uid, $pid)";
        mysqli_query($cnn, $sql);
    }

    header("Location: homepage.php");
    exit();
} else {
    header("Location: homepage.php");
    exit();
}
?>
