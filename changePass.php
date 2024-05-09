<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change paswword</title>
</head>

<body>
    <form action="changePass.php" method="POST">
        <input type="password" name="current_password" placeholder="Current Password" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        <button type="submit" name="changePasswordBtn">Change Password</button>
    </form>
    <?php
    session_start();
    $cnn = mysqli_connect("localhost", "root", "", "delbanis_resto");

    if (!$cnn) {
        echo "Error in connection: ";
        exit();
    }
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];


    if ($new_password !== $confirm_password) {
        echo "<script>alert('New password and confirm password do not match.')</script>";
        exit();
    }


    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE full_name='$username' AND password='$current_password'";
    $result = mysqli_query($cnn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $sql_update = "UPDATE users SET password='$new_password' WHERE full_name='$username'";
        $result_update = mysqli_query($cnn, $sql_update);

        if ($result_update) {
            echo "<script>alert('Password updated successfully.')</script>";

            header('Location: login.php');
            exit();
        } else {
            echo "<script>alert('Failed to update password.')</script>";
        }
    } else {
        echo "<script>alert('Incorrect current password.')</script>";
    }


    ?>
</body>

</html>