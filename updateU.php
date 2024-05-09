<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update User</title>
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

    $id = $_GET["id"];

    $sql = "SELECT * FROM users where id=$id";

    if (mysqli_query($cnn, $sql)) {
        $result = mysqli_query($cnn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
           $fn = $row["full_name"];
           $email = $row["email"];
            $password = $row["password"];
        } else {
            echo "No User with that ID";
        }
    } else {
        echo "an error occured";
    }
    ?>
    <div class="container-fluid py-5 mb-5 mt-5 d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="text-center rounded" style="background-image: url('bg.png');background-size: cover;background-repeat: no-repeat;background-attachment: fixed; max-width: 350px; padding: 20px; ">

            <form action="update-user.php" method="post" id="signupForm">
                <img class="mb-4 img-fluid" src="logo2.png" height="100" alt="delbanis logo">
                <div class="form-floating mb-3">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" required readonly>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" id="fn" name="fullname" class="form-control" placeholder="Name" value="<?php echo $fn; ?>" required autofocus disabled readonly>
                    <label for="fn">Full Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" value="<?php echo $email; ?>" required autofocus disabled readonly>
                    <label for="email">E-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" id="npassword" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>" minlength="8" maxlength="20" required>
                    <label for="npassword">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" id="repassword" name="confirmpass" class="form-control" value="<?php echo $password; ?>" placeholder="Confirm Password" minlength="8" maxlength="20" required>
                    <label for="repassword">Confirm Password</label>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-outline-success" name="update" value="update password">Update</button>
                </div>
                </br>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>