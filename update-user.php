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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $pw = $_POST["password"];
    $confirmpass = $_POST["confirmpass"];

    if (strlen($pw) < 8 || !preg_match("/[A-Z]/", $pw) || !preg_match("/[0-9]/", $pw)) {
        echo "<script>alert('Error: Password must be at least 8 characters long and include at least one capital letter and one number.');</script>";
        echo "<script>window.location.href='updateU.php?id=$id';</script>";
        exit();
    } else if ($pw !== $confirmpass) {
        echo "<script>alert('Error: Passwords do not match.');</script>";
        echo "<script>window.location.href='updateU.php?id=$id';</script>";
        exit();
    } else {
        $sql = "UPDATE users SET password='$pw' WHERE id='$id'";
    }

    if (!empty($sql)) {
        if (mysqli_query($cnn, $sql)) {
            echo "<script>alert('updated successfully !!');</script>";
            header("refresh:0; url=manageUsers.php");
        } else {
            echo "<script>alert('Error in updating information: " . mysqli_error($cnn) . "');</script>";
            echo "<script>window.location.href='updateU.php?id=$id';</script>";
        }
    } else {
        echo "<script>alert('Error: SQL query is empty, error in adding your information.";
        echo "Try again !!!');</script>";
        echo "<script>window.location.href='updateU.php?id=$id';</script>";
    }
}
