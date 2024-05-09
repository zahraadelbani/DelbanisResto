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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">

</head>
<style>
    .btn {
        background-color: #063e34;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #E0F0E3;
        color: #063e34;
    }
</style>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo2.png" alt="delbanis logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php"><i class="bi bi-house-door"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addProduct.php"><i class="bi bi-plus-circle"></i> Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="manageUsers.php"><i class="bi bi-people"></i> Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4 ml-auto" style="height: 100vh;">
        <div class="table-responsive ">
            <table class="table table-success table-striped table-sm caption-top justify-content-center">
                <caption style="font-size: 1.5em; font-weight: bold; color: #E0F0E3; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); animation: glow 2s infinite alternate;">List of users</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FullName</th>
                        <th>Email</th>
                        <!-- <th>Password</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider table-sm">

                    <?php


                    $sql = "SELECT * from users";

                    $result = mysqli_query($cnn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row["id"] . "</th>";
                            echo "<td>" . $row["full_name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            /* echo "<td>" . $row["password"] . "</td>"; */
                            echo "<td><center>
                                    <button type='button' class='btn btn-outline-dark btn-sm' onclick=\"window.location.href='udelete.php?id=" . $row["id"] . "'\">Delete</button></center></td></tr></tbody>";
                                }//<button type='button' class='btn btn-outline-dark btn-sm' onclick=\"window.location.href='updateU.php?id=" . $row["id"] . "'\">Update password</button>
                    } else {
                        echo "No users..";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('a[href="logout.php"]').addEventListener('click', function (event) {
      event.preventDefault();
      var confirmLogout = confirm("Are you sure you want to log out?");
      if (confirmLogout) {
        window.location.href = this.getAttribute('href');
      } else {
        // User chose not to log out, do nothing
      }
    });
        </script>
</body>

</html>