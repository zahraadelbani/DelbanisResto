<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<style>
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

<body>
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
                        <a class="nav-link" href="admin.php"><i class="bi bi-house-door"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="addProduct.php"><i class="bi bi-plus-circle"></i> Add Product</a>
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

    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <!--product-->
            </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER["PHP_SELF"];  ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="pname" id="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="des" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" id="price" step="0.0001" required>
                    </div>
                    <div class="mb-3">
                        <label for="mealType" class="form-label">Meal Type</label>
                        <select class="form-select" name="meal_type" id="mealType" required>
                            <option value="" selected>Select Meal Type</option>
                            <option value="Mezza Appetizers">Mezza Appetizers</option>
                            <option value="Soups & Salads">Soups & Salads</option>
                            <option value="Main Courses">Main Courses</option>
                            <option value="Desserts">Desserts</option>
                            <option value="Drinks">Drinks</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png" required>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-custom btn-md me-2">Add</button>
                        <button type="reset" class="btn btn-custom btn-md ms-2">Reset</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <?php
    $cnn = mysqli_connect("localhost", "root", "", "delbanis_resto");
    if (!$cnn) {
        echo "Error in connection: ";
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pname = $_POST["pname"];
        $des = $_POST["des"];
        $price = $_POST["price"];
        $meal_type = $_POST["meal_type"];


        $allowedExtensions = array('jpg', 'jpeg', 'png');

        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./image/" . $filename;
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));


        if (!in_array($ext, $allowedExtensions)) {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, and PNG files are allowed.')</script>";
        } else {
            $sql = "INSERT INTO products(product_name,description,price,meal_type,img) VALUES ('$pname','$des','$price','$meal_type','$filename')";

            if (!empty($sql)) {
                if (move_uploaded_file($tempname, $folder)) {
                    if (mysqli_query($cnn, $sql)) {
                        echo "<script>alert('$pname is added successfully !!')</script>";
                    } else {
                        echo "<script>alert('Error in adding new information: " . mysqli_error($cnn) . "')</script>";
                    }
                } else {
                    echo "<script>alert('Failed to upload image!')</script>";
                }
            } else {
                echo "<script>alert('Error: SQL query is empty, error in adding product.";
                echo "Try again !!!');</script>";
            }
        }
    }
    ?>


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