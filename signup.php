<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #0a6f5f;">
    <div class="container-fluid py-5 mb-5 mt-5 d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="text-center rounded" style="background-image: url('bg.png');background-size: cover;background-repeat: no-repeat;background-attachment: fixed; max-width: 350px; padding: 20px; ">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="post" id="signupForm">
                <img class="mb-4 img-fluid" src="logo2.png" height="100" alt="delbanis logo">
                <h1 class="h6 mb-5 fw-normal" style="color: #0a6f5f;">Subscribe for cool offers, tasty food, and more! We promise, no spam, just great content in seconds.</h1>
                <div class="form-floating mb-3">
                    <input type="text" id="fn" name="fullname" class="form-control" placeholder="Name" required autofocus>
                    <label for="fn">Full Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
                    <label for="email">E-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" id="npassword" name="password" class="form-control" placeholder="Password" minlength="8" maxlength="20" required>
                    <label for="npassword">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" id="repassword" name="confirmpass" class="form-control" placeholder="Confirm Password" minlength="8" maxlength="20" required>
                    <label for="repassword">Confirm Password</label>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-outline-success" name="submitBtn" value="signup">Sign Up</button>
                    <button type="reset" class="btn btn-outline-success" name="clearBtn" value="clear">Clear</button>
                </div>
                </br>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php
    $cnn = mysqli_connect("localhost", "root", "", "delbanis_resto");
    if (!$cnn) {
        echo "Error in connection: ";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fn = $_POST["fullname"];
        $email = $_POST["email"];
        $pw = $_POST["password"];
        $confirmpass = $_POST["confirmpass"];

        if (strlen($fn) < 3 || strlen($fn) > 100) {
            echo "<script>alert('Name must be at least 3 characters long and not more than 100 characters long.');</script>";
        } else if (strlen($pw) < 8 || !preg_match("/[A-Z]/", $pw) || !preg_match("/[0-9]/", $pw)) {
            echo "<script>alert('Error: Password must be at least 8 characters long and include at least one capital letter and one number.');</script>";
        } else if ($pw !== $confirmpass) {
            echo "<script>alert('Error: Passwords do not match.');</script>";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Error: Invalid email format');</script>";
        } else {

            $sql = "SELECT id FROM users WHERE full_name = '$fn'";
            $result = mysqli_query($cnn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('This username is already taken')</script>";
            } else {
                $hash = md5($pw);
                $sql = "INSERT INTO users(full_name, email, password) VALUES ('$fn', '$email', '$hash')";
                if (mysqli_query($cnn, $sql)) {
                    echo "<script>alert('$fn is registered successfully!')</script>";
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<script>alert('Error in registration information: " . mysqli_error($cnn)."')</script>";
                }
            }
        }
    }


    ?>
</body>

</html>