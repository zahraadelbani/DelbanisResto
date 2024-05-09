<?php
session_start();

$cnn = mysqli_connect("localhost", "root", "", "delbanis_resto");

if (!$cnn) {
    echo "Error in connection: ";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];

    // Hash the input password
    $hashedPassword = md5($password);

    $sql = "SELECT id, full_name, password, userType FROM users WHERE full_name='$fullname'";
    $result = mysqli_query($cnn, $sql);

    

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Compare hashed passwords
        if ($hashedPassword == $row['password']) {
            $_SESSION['userType'] = $row['userType'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['loggedin'] = true;

            if ($_SESSION['userType'] == 'admin') {
                header("Location: admin.php");
                exit();
            } else if ($_SESSION['userType'] == 'user') {
                header("Location: homepage.php");
                exit();
            }
        } else {
            echo "<script>alert('Incorrect password.')</script>";
            echo "<script>window.location.href='login.php'</script>";
            exit();
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<body style="background-color: #0a6f5f;">
    <div class="container d-flex justify-content-center align-items-center" id="loginform" style="height: 100vh;">
        <div class="text-center rounded" style="background-image: url('bg.png');background-size: cover;background-repeat: no-repeat;background-attachment: fixed; max-width: 350px; padding: 40px; ">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id="loginForm">
                <img class="mb-4 img-fluid" src="logo2.png" height="100" alt="delbanis logo">

                <div class="form-floating mb-3">
                    <input type="text" id="username" name="fullname" class="form-control" placeholder="full name" required autofocus>
                    <label for="username">Full Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" minlength="8" maxlength="20" required>
                    <label for="password">Password</label>
                </div>

               <!--  <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember-me" value="remember-me">Remember Me
                    </label>
                </div> -->

                <div class="mt-3">
                    <button type="submit" class="btn btn-outline-success" name="loginBtn">Login</button>
                    <button id="signupButton" type="button" class="btn btn-outline-success">Sign Up</button>
                </div>
                </br>
                <!-- <div class="forgot">
                    <small><a href="#" style="color: black;">Forgot Password?</a></small>
                </div> -->
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('signupButton').addEventListener('click', function(event) {
            window.location.href = 'signup.php';
        });
    </script>
</body>

</html>