<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Product</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body style="background-color: #0a6f5f;">

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

    $pid = $_GET["pid"];

    $sql = "SELECT * FROM products where pid=$pid";

    if (mysqli_query($cnn, $sql)) {
        $result = mysqli_query($cnn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $pname = $row["product_name"];
            $des = $row["description"];
            $price = $row["price"];
            $mt = $row["meal_type"];
            $img = $row["img"];
        } else {
            echo "<script>alert('No product with that ID!')</script>";
        }
    } else {
        echo "<script>alert('an error occured')</script>";
    }
    ?>
    <div class="container py-4 ">
        <div class="card">
            <div class="card-header" style="background-color: #0a6f5f;">
                <h4 class="text-center" style="color:white;">Update Product</h4>

            </div>
            <div class="card-body">
                <form action="update-product.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="pid" id="pid" value="<?php echo $pid; ?>" required>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="pname" id="productName" value="<?php echo $pname; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="des" rows="3" required> <?php echo $des; ?> </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" id="price" step="any" value="<?php echo $price; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mealType" class="form-label">Meal Type</label>
                        <select class="form-select" name="meal_type" id="mealType" required>
                            <option value="" disabled>Select Meal Type</option>
                            <option value="Mezza Appetizers" <?php if ($mt == "Mezza Appetizers") echo "selected"; ?>>Mezza Appetizers</option>
                            <option value="Soups & Salads" <?php if ($mt == "Soups & Salads") echo "selected"; ?>>Soups & Salads</option>
                            <option value="Main Courses" <?php if ($mt == "Main Courses") echo "selected"; ?>>Main Courses</option>
                            <option value="Desserts" <?php if ($mt == "Desserts") echo "selected"; ?>>Desserts</option>
                            <option value="Drinks" <?php if ($mt == "Drinks") echo "selected"; ?>>Drinks</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keepImage" class="form-label">Keep Existing Image</label>
                        <input type="checkbox" class="form-check-input" id="keepImage" name="keep_image" value="1" onchange="checkForm()" style="color: blue;">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload New Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png" onchange="checkForm()">
                    </div>

                    <div class="mb-3 d-flex justify-content-center">
                        <input type="submit" class="btn btn-custom btn-md me-2" id="update_button" name="update_button" value="Update" disabled>
                        
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script>
        function checkForm() {
            var keepImageChecked = document.getElementById("keepImage").checked;
            var imageInput = document.getElementById("image");
            var keepImageInput = document.getElementById("keepImage");

            if (keepImageChecked) {
                // Disable image input if keepImage is checked
                imageInput.disabled = true;
            } else {
                // Disable keepImage input if image is selected
                keepImageInput.disabled = true;
            }

            // Enable the update button if either condition is met
            if (keepImageChecked || imageInput.value !== "") {
                document.getElementById("update_button").disabled = false;
            } else {
                document.getElementById("update_button").disabled = true;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>