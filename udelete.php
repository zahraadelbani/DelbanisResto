<?php
$cnn = mysqli_connect("localhost", "root", "", "delbanis_resto");
if (!$cnn) {
    echo "Error in connection: ";
    exit();
}

$id = $_GET["id"];

// Delete user from the cart table
$sqlDeleteFromCart = "DELETE FROM cart WHERE uid = $id";
if (!mysqli_query($cnn, $sqlDeleteFromCart)) {
    echo "An error occurred while deleting user from cart table!";
    exit();
}

$sql = "DELETE FROM users WHERE id = $id";

if (mysqli_query($cnn,$sql)){
    header("Location: manageUsers.php");
}
else{
    echo "an error occured while deleting !!";
}
?>
