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
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">

    <style>
        #adPictures img {
            max-width: 100%;
            height: 100%;
        }

        #carouselExampleSlidesOnly {
            width: 100%;
            margin-top: 20px;
        }

        .carousel-inner .carousel-item img {
            border-radius: 10px;
        }

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

        /* Styling for select elements */
        select.form-select {
            background-color: #0a6f5f;
            color: #E0F0E3;
            border-color: #0a6f5f;
            font-size: 1.0rem;
            width: 150px;
            margin-right: 20px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        select.form-select:hover {
            background-color: #085c4c;
            border-color: #085c4c;
        }

        select.form-select:focus {
            background-color: #085c4c;
            border-color: #085c4c;
            box-shadow: 0 0 0 0.25rem rgba(12, 150, 127, 0.25);
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

        .social-icon:hover {
            color: #0a6f5f;
        }
    </style>
</head>

<body>
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
                        <a class="nav-link active" aria-current="page" href="homepage.php"><i class="bi bi-house-door"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="bi bi-cart"></i> Cart</a>
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
    <!-- Filter Bar -->
    <form action="" method="GET">
        <div class="d-flex justify-content-center flex-wrap mt-2">
            <div class="me-2 mb-2">
                <select name="meal_type" class="form-select" aria-label="Meal Type">
                    <option value="" selected>Meal Type</option>
                    <option value="Mezza Appetizers">Mezza Appetizers</option>
                    <option value="Soups & Salads">Soups & Salads</option>
                    <option value="Main Courses">Main Courses</option>
                    <option value="Desserts">Desserts</option>
                    <option value="Drinks">Drinks</option>
                </select>
            </div>

            <div class="me-2 mb-2">
                <select name="sort" class="form-select" aria-label="Sort">
                    <option value="" selected>Sort</option>
                    <option value="a_z">A-Z</option>
                    <option value="z_a">Z-A</option>
                    <option value="price_high_low">Price: high-low</option>
                    <option value="price_low_high">Price: low-high</option>
                    <option value="most_recent">Most Recent</option>
                </select>
            </div>

            <div class="mb-2">
                <input type="submit" value="Apply" class="btn btn-sm me-1">
            </div>
            <div class="mb-2 ">
                <input type="button" value="Reset" class="btn btn-sm" onclick="window.location.href='homepage.php'">
            </div>
        </div>
    </form>
    <!-- End Filter Bar -->


    <div class="col-md-2 sticky-top" style="float:right;">
        <div class="container mb-2">
            <div id="carouselExampleSlidesOnly" class="carousel slide mt-1" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="1.png" class="d-block w-100" alt="Ad 1">
                    </div>
                    <div class="carousel-item">
                        <img src="2.png" class="d-block w-100" alt="Ad 2">
                    </div>
                    <div class="carousel-item">
                        <img src="3.png" class="d-block w-100" alt="Ad 3">
                    </div>
                    <div class="carousel-item">
                        <img src="4.png" class="d-block w-100" alt="Ad 4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Carousel -->

    <div class="container mb-2">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $cnn = mysqli_connect("localhost", "root", "", "delbanis_resto");
            if (!$cnn) {
                echo "Error in connection: ";
                exit();
            }


            // Retrieve the user's cart items from the database
            $uid = $_SESSION['id'];
            $sql = "SELECT * FROM cart WHERE uid = $uid";
            $result = mysqli_query($cnn, $sql);

            // Extract product IDs from the result set
            $cartProductIds = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $cartProductIds[] = $row['pid'];
            }

            $sql = "SELECT * FROM products";

            if (isset($_GET['meal_type']) && !empty($_GET['meal_type'])) {
                $meal_type = mysqli_real_escape_string($cnn, $_GET['meal_type']);
                $sql .= " WHERE meal_type = '$meal_type'";
            }

            if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                $sort = mysqli_real_escape_string($cnn, $_GET['sort']);

                if (strpos($sql, 'WHERE') !== false) {
                    $sql .= " ORDER BY ";
                } else {
                    $sql .= " ORDER BY ";
                }


                switch ($sort) {
                    case 'a_z':
                        $sql .= "product_name ASC";
                        break;
                    case 'z_a':
                        $sql .= "product_name DESC";
                        break;
                    case 'price_high_low':
                        $sql .= "price DESC";
                        break;
                    case 'price_low_high':
                        $sql .= "price ASC";
                        break;
                    case 'most_recent':
                        $sql .= "release_date DESC";
                        break;
                    default:
                        // Handle default case if needed
                        break;
                }
            }

            $result = mysqli_query($cnn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col col-md-4">
                        <div class="card h-100 text-left" style="position: relative;">
                            <img src="./image/<?php echo $row['img']; ?>" class="card-img-top img-fluid" alt="..." style="height: 150px; object-fit: cover;">
                            <div class="card-body" style="margin-bottom: 20px;">
                                <h4 class="card-title"><?php echo $row['product_name']; ?></h4>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <p class="card-text"><?php echo $row['price']; ?></p>
                                <p class="card-text"><?php echo $row['meal_type']; ?></p>
                                <p class="card-text"><?php echo date('Y-m-d', strtotime($row['release_date'])); ?></p>

                            </div>
                            <div class="card-footer text-center">
                                <form method="post" action="add_to_cart.php">
                                    <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                                    <?php

                                    if (in_array($row['pid'], $cartProductIds)) {
                                        echo '<a href="cart.php" class="btn in-cart">In Cart</a>';
                                    } else {
                                        echo '<button type="submit" class="btn add-to-cart">Add to Cart</button>';
                                    }
                                    ?>
                                </form>
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
                        <a href="https://www.facebook.com/zahraa.delbani.9" target="_blank" class="social-icon me-3"><i class="bi bi-facebook" style="font-size: 1.5rem;"></i></a>
                        <a href="https://www.instagram.com/_zahraadelbani_?igsh=dzh5Nm54bDE2Znc2&utm_source=qr" target="_blank" class="social-icon me-3"><i class="bi bi-instagram" style="font-size: 1.5rem;"></i></a>
                        <a href="https://www.whatsapp.com/" target="_blank" class="social-icon"><i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i></a>
                    </div>
                </div>
            </div>
            <hr style="background-color: white;">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-content text-center">
                        <p>&copy; 2024 Delbanis Restaurant. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Function to check screen size and add/remove sticky-top class
    function adjustStickyTop() {
        var screenWidth = window.innerWidth;
        var colDiv = document.querySelector('.col-md-2');

        // Remove sticky-top class if screen width is less than or equal to 768px
        if (screenWidth <= 768) {
            colDiv.classList.remove('sticky-top');
        } else {
            // Add sticky-top class if screen width is greater than 768px
            colDiv.classList.add('sticky-top');
        }
    }

    // Call the function initially
    adjustStickyTop();

    // Listen for window resize event and call the function
    window.addEventListener('resize', adjustStickyTop);


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

</html>