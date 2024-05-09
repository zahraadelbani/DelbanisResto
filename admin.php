<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        #products {
            max-height: 300px;

            align-content: center;
            overflow-y: auto;
            padding: 10px;

        }

        .btn {
            background-color: #063e34;
            color: white;
            border-radius: 10px;
            padding: 5px 15px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #E0F0E3;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                            <a class="nav-link active" aria-current="page" href="admin.php"><i class="bi bi-house-door"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addProduct.php"><i class="bi bi-plus-circle"></i> Add Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manageUsers.php"><i class="bi bi-people"></i> Manage Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container mb-2">
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
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

            $sql = "SELECT * FROM products";
            $result = mysqli_query($cnn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col col-md-4">
                        <div class="card h-100 text-left" style=" position: relative;">
                            <img src="./image/<?php echo $row['img']; ?>" class="card-img-top img-fluid" alt="..." style="height: 250px; object-fit: cover;">
                            <div class="card-body" style="margin-bottom: 20px;">
                                <h4 class="card-title"><?php echo $row['product_name']; ?></h4>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <p class="card-text">TL <?php echo $row['price']; ?></p>
                                <p class="card-text"><?php echo $row['meal_type']; ?></p>
                            </div>
                            <div class="card-footer text-center" style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%;">
                                <button type='button' class='btn btn-outline-dark btn-sm' onclick="window.location.href='pupdate.php?pid=<?php echo $row['pid']; ?>'">Update</button>
                                <button type='button' class='btn btn-outline-dark btn-sm' onclick="window.location.href='pdelete.php?pid=<?php echo $row['pid']; ?>'">Delete</button>
                            </div>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "<h4 style='font-size: 1.5em; font-weight: bold; color: #E0F0E3; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); animation: glow 2s infinite alternate;'>No products..</h4>";
            }
            ?>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('a[href="logout.php"]').addEventListener('click', function(event) {
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