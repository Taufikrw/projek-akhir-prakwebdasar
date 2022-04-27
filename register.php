<?php
session_start();

if ( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

require 'function.php';

if ( isset($_POST["register"]) ) {
    if ( checkPhoneNumber($_POST['phone']) ) {
        if ( registrasi($_POST) > 0 ) {
            echo "<script>alert('User Baru Berhasil Di Tambahkan!')</script>";
        } else {
            echo mysqli_error($connect);
        }
    } else{
        echo "<script>alert('Phone Number invalid!')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- My Font -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- My CSS -->
    <style>
    html,
    body.register {
        height: 100%;
        background-color: #141E27;
        background-size: 25%;
        font-family: 'Source Code Pro', monospace;
    }
    </style>

    <link rel="stylesheet" href="style.css">

    <title>Brother | Register</title>
</head>

<body class="register">

    <div class="register-container">
        <div class="register-form card">
            <div class="card-body text-light">
                <div class="header text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <h5 class="card-login card-title text-uppercase mt-3">Register</h5>
                </div>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label text-capitalize">username :</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-capitalize">password :</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password2" class="form-label text-capitalize">confirm password :</label>
                        <input type="password" name="password2" id="password2" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label text-capitalize">your name :</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label text-capitalize me-3">gender :</label>
                        <div class="form-check-inline">
                            <input type="radio" name="gender" id="laki-laki" class="form-check-input" value="laki-laki">
                            <label for="laki-laki" class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" name="gender" id="perempuan" class="form-check-input" value="perempuan">
                            <label for="perempuan" class="form-check-label">Perempuan</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label text-capitalize">Phone Number :</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="08XXXXXXXXXX"
                            maxlength="13" required>
                    </div>
                    <div class="mb-3">
                        <a href="login.php" class="text-decoration-none text-info">Already have account?</a>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info btn-login" name="register">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>