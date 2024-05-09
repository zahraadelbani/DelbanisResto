<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["userType"] !== "user") {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">

    <style>
        .footer-content h5 {
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .footer-content p {
            color: white;
            margin-bottom: 3px;
            font-size: 12px;
        }

        .footer-content a {
            color: white;
            text-decoration: none;

        }

        .table {
            color: white;
            border: none;
        }

        .table th,
        .table td {
            border: none;
            vertical-align: middle;
            color: #063e34;
            padding: 0.1rem;
            font-size: 14px;
        }

        .table th {
            background-color: white;
            font-weight: bold;
            text-align: center;
        }

        .table td {
            background-color: white;
        }

        .total-price-box {
            background-color: #E0F0E3;
            color: #063e34;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
        }

        .btn-delete {
            background-color: #063e34;
            color: white;
            border-radius: 10px;
            padding: 5px 15px;
            transition: background-color 0.3s;
        }

        .btn-delete:hover {
            background-color: #E0F0E3;
        }

        @keyframes glow {
            from {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }

            to {
                text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.7);
            }
        }
        .social-icon:hover {
            color: #0a6f5f;
            }
    </style>
</head>

<body class="d-flex flex-column vh-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="homepage.php">
                <img src="logo2.png" alt="delbanis logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php"><i class="bi bi-house-door"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="cart.php"><i class="bi bi-cart"></i> Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php"><i class="bi bi-info-circle"></i> About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h4 style="font-size: 1.5em; font-weight: bold; color: #E0F0E3; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); animation: glow 2s infinite alternate;">Your Cart</h4>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            
            $uid = $_SESSION['id'];

            $totalPrice = 0.00;
            $cnn = mysqli_connect("localhost", "root", "", "delbanis_resto");
            if (!$cnn) {
                echo "Error in connection: ";
                exit();
            }
            

            $sql = "SELECT * FROM cart WHERE uid=$uid";
            $result = mysqli_query($cnn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // For each product in the cart, you may want to fetch its details from another table
                    $pid = $row['pid'];
                    $productSql = "SELECT * FROM products WHERE pid=$pid";
                    $productResult = mysqli_query($cnn, $productSql);

                    // Assuming 'products' table has fields like 'product_name', 'description', 'price', etc.
                    if ($productRow = mysqli_fetch_assoc($productResult)) {
                        $totalPrice += $productRow['price'];
            ?>


                        <div class="col col-md-4">
                            <div class="card h-100 text-center" style="position: relative;">
                                <img src="./image/<?php echo $productRow['img']; ?>" class="card-img-top img-fluid" alt="..." style="height: 150px; object-fit: cover;">
                                <div class="card-body" style="margin-bottom: 20px;">
                                    <h5 class="card-title">Product Name: <?php echo $productRow['product_name']; ?></h5>
                                    <p class="card-text">Description: <?php echo $productRow['description']; ?></p>
                                    <p class="card-text">Price: TL <?php echo $productRow['price']; ?></p>
                                    <p class="card-text">Meal Type: <?php echo $productRow['meal_type']; ?></p>
                                </div>
                                <div class="card-footer">
                                    <form action="productDelete.php" method="GET">
                                        <input type="hidden" name="pid" value="<?php echo $productRow['pid']; ?>">
                                        <button type="submit" class="btn btn-delete">Delete</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

            <?php    }
            } else {
                echo "<h5 style='color:#E0F0E3'>Your cart is <a href='homepage.php' style='color: white;'>empty</a>.</h5>";
            }

            ?>
        </div>
    </div>
    <div class="container mt-2 mb-2">
        <div class="row">
            <div class="col text-end">
                <div class="total-price-box">
                    <i class="bi bi-cart4"></i>
                    Total Price: TL <?php echo $totalPrice; ?>
                </div>
            </div>
        </div>
    </div>





    <footer class="footer" style="background-color: #063e34;">
        <div class="container text-center">
            <div class="row justify-content-center mb-0">
                <div class="col-md-4 mt-4">
                    <div class="footer-content">
                        <h5>Contact Us</h5>
                        <p>Phone: +90 533 870 41 45</p>
                        <p>Email: delbanisresto@gmail.com</p>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="footer-content">
                        <h5>Opening Hours</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mon - Fri:</td>
                                    <td>12pm - 12am</td>
                                </tr>
                                <tr>
                                    <td>Sat - Sun:</td>
                                    <td>12pm - 2am</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="footer-content">
                        <h5>Follow Us</h5>
                        <a href="https://www.facebook.com/zahraa.delbani.9" target="_blank" class="social-icon me-3">
                            <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
                        </a>
                        <a href="https://www.instagram.com/_zahraadelbani_?igsh=dzh5Nm54bDE2Znc2&utm_source=qr" target="_blank" class="social-icon me-3">
                            <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
                        </a>
                        <a href="https://www.whatsapp.com/" target="_blank" class="social-icon">
                            <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
                        </a>
                    </div>
                </div>

            </div>
            <hr style="background-color: white;">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="footer-content text-center">
                        <p>&copy; 2024 Delbanis Restaurant. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>


    </footer>


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