<?php
session_start();
require 'function.php';

if ( isset($_COOKIE["id"]) && isset($_COOKIE["key"]) ) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    $result = mysqli_query($connect, "SELECT username FROM users WHERE userID = $id");
    $row = mysqli_fetch_assoc($result);

    if ( $key === hash('sha256', $row["username"]) ) {
        $_SESSION["login"] = true;
    }
}

if ( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username'");
    
    if( mysqli_num_rows($result) === 1 ) {
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password, $row["password"]) ) {
            //set session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["userID"] = $row["userID"];

            if ( isset($_POST["remember"]) ) {
                setcookie('id', $row['userID'], time() + 1800);
                setcookie('key', hash('sha256', $row['username']), time() + 1800);
            }

            header("Location: index.php?text=success");
            exit;
        }
    }

    echo "<script>alert('username dan password tidak sesuai')</script>";
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
    body.login {
        height: 100%;
        background-color: #141E27;
        background-size: 25%;
        font-family: 'Source Code Pro', monospace;
    }
    </style>

    <link rel="stylesheet" href="style.css">

    <title>Brother | Login</title>
</head>

<body class="login">
    <div class="login-container">
        <div class="login-form card">
            <div class="card-body text-light">
                <div class="header text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <h5 class="card-login card-title text-uppercase mt-3">Log in</h5>
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
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label for="remember" class="form-label text-capitalize">remember me</label>
                    </div>
                    <div class="mb-3">
                        <a href="register.php" class="text-decoration-none text-info">Don't have account?</a>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn-login btn btn-info" name="login">Log in</button>
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