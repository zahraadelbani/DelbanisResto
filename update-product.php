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
    $pid = $_POST["pid"];
    $pname = $_POST["pname"];
    $des = $_POST["des"];
    $price = $_POST["price"];
    $mt = $_POST["meal_type"];
    if (isset($_POST["keep_image"])) {
        $keep_image = $_POST["keep_image"];
    } else {
        $keep_image = 0;
    }

    $allowedExtensions = array('jpg', 'jpeg', 'png');

    if ($keep_image) {
        $sql = "UPDATE products SET product_name='$pname', description='$des', price='$price', meal_type='$mt' WHERE pid='$pid'";
    } else {
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./image/" . $filename;
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));


        if (!in_array($ext, $allowedExtensions)) {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, and PNG files are allowed.')</script>";
            echo "<script>window.location.href='pupdate.php?pid=$pid';</script>";
            exit();
        }


        if (!move_uploaded_file($tempname, $folder)) {
            echo "<script>alert('Failed to upload image!')</script>";
            echo "<script>window.location.href='pupdate.php?pid=$pid';</script>";
            exit();
        }

        $sql = "UPDATE products SET product_name='$pname',description='$des',price='$price',meal_type='$mt',img='$filename' WHERE pid='$pid'";
    }
    if (!empty($sql)) {
        if (mysqli_query($cnn, $sql)) {
            echo "<script>alert('$pname is updated successfully !!');</script>";
            header("refresh:0; url=admin.php");
        } else {
            echo "<script>alert('Error in updating information: " . mysqli_error($cnn) . "');</script>";
            echo "<script>window.location.href='pupdate.php?pid=$pid';</script>";
        }
    } else {
        echo "<script>alert('Error: SQL query is empty, error in adding your information. Try again !!!');</script>";
        echo "<script>window.location.href='pupdate.php?pid=$pid';</script>";
    }
}
