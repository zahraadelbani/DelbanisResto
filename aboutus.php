<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .jumbotron {
            position: relative;
            background-image: url('resto1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
            padding: 100px 0;
            border-radius: 0;
        }

        .jumbotron .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: inherit;

        }

        .jumbotron h1,
        .jumbotron p {
            position: relative;
            z-index: 1;
            color: #063e34;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        .jumbotron h1 {
            font-size: 3.5rem;
            font-weight: bold;
        }

        .jumbotron p {
            font-size: 1.25rem;
            font-weight: 400;
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
        .social-icon:hover {
            color: #0a6f5f;
            
        }
    </style>
</head>

<body class="d-flex flex-column vh-100">
    <?php
    session_start();

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["userType"] !== "user") {
        header("Location: login.php");
        exit();
      }


    $cnn = mysqli_connect("localhost", "root", "", "delbanis_resto");

    if (!$cnn) {
        echo "Error in connection: ";
        exit();
    }



    ?>
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
                        <a class="nav-link" href="cart.php"><i class="bi bi-cart"></i> Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="aboutus.php"><i class="bi bi-info-circle"></i> About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="jumbotron">
        <div class="overlay"></div>
        <div class="container text-center">
            <h1>Welcome to Delbani's Resto</h1>
            <hr class="my-4">
            <p class="lead">Experience the flavors of <a href="https://en.wikipedia.org/wiki/Lebanese_cuisine" target="_blank" style="text-decoration: none; color: #0a6f5f;">Lebanese</a> cuisine in a cozy and charming setting.</p>
            <p>At Delbani's resto, we take pride in serving authentic Lebanese cuisine made with fresh and high-quality ingredients. From our savory kebabs to our mouthwatering mezzes, every dish is prepared with care and attention to detail. Step into our restaurant and feel the warmth of Lebanese hospitality. Whether you're dining with family, friends, or that special someone, our cozy atmosphere and friendly staff will make you feel right at home.</p>
        </div>
    </div>
    <footer class="footer" style="background-color: #063e34;">
        <div class="container text-center">
            <div class="row justify-content-center mb-0">
                <div class="col-md-4 mt-4"> <!-- Add mt-3 class for top margin -->
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

                <div class="col-md-4 mt-4"> <!-- Add mt-3 class for top margin -->
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