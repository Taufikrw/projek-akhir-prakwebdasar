<?php
session_start();
require 'function.php';

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

$userid = $_SESSION["userID"];

if ( isset($_POST["submit"]) ) {
    if ( cekDate($_POST, $userid) > 0 ) {
        echo "<script>alert('Transaksi Sukses!')</script>";
    } else {
        header("Location: book.php?text=failed");
    }
}

if( isset($_POST["sEdit"]) ) {
    if ( editData($_POST, $userid) > 0 ) {
        echo "<script>alert('Data berhasil di edit!')</script>";
    } else {
        echo mysqli_error($connect);
    }
}

if( isset($_GET["del"]) ) {
    $idDel = $_GET['del'];
    $delQuery = mysqli_query($connect, "DELETE FROM book WHERE bookID = $idDel");
    if ($delQuery) {
        echo "<script>alert('Data berhasil di hapus!')</script>";
    } else {
        echo "<script>alert('Gagal dihapus!')</script>";
    }
}

$userQuery = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$userid'");
$userData = mysqli_fetch_assoc($userQuery);
$cusName = $userData["customerName"];

?>
<!DOCTYPE html>
<html lang="en" class="profile">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Frijole&family=Pattaya&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Frijole&family=Pattaya&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Chewy&family=Concert+One&family=Frijole&family=Pattaya&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Chewy&family=Concert+One&family=Frijole&family=Luckiest+Guy&family=Pattaya&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Chewy&family=Coming+Soon&family=Concert+One&family=Frijole&family=Luckiest+Guy&family=Pattaya&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Chewy&family=Coming+Soon&family=Concert+One&family=Frijole&family=Luckiest+Guy&family=Nerko+One&family=Pattaya&display=swap"
        rel="stylesheet">

    <title>Brother | Profile</title>
</head>

<body class="profile" style="background-image: url(https://img.freepik.com/free-photo/black-brick-wall-textured-background_53876-63572.jpg?t=st=1650356367~exp=1650356967~hmac=94d6216e0eec90a827e2c0d098b0cadb074de2cdd84b1ac746a3d356a409c526&w=900);
    background-size: 100%;">
    <div class="profile-container container-fluid p-5">

        <!-- Welcome -->
        <div class="header text-center text-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg>
            <h2 class=" text-capitalize mt-3" style="font-family: 'Nerko One', cursive;">Selamat Datang,
                <?=$userData["customerName"] ?> !</h2><br>
            <hr><br>
        </div>
        <!-- end welcome -->

        <!-- Box -->
        <div class="row">
            <div class="col-lg-4">
                <div class="content-box my-profile-card card mt-3" style="box-shadow: 1px 1px 3px;">
                    <div class="card-body">
                        <h4 class="mb-3 text-center">My Profile</h4>
                        <div class="row mb-1">
                            <div class="col">Username</div>
                            <div class="col">: @<?=$userData["username"];?></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">Nama</div>
                            <div class="col">: <?=$userData["customerName"];?></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">Jenis Kelamin</div>
                            <div class="col">: <?=$userData["customerGender"];?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">Nomer HP</div>
                            <div class="col">: <?=$userData["phoneNumber"];?></div>
                        </div>
                        <a href="profile.php?edit"><button type="button" class="btn btn-outline-info mb-3"
                                name="edit">Edit</button></a>
                        <a href="logout.php"><button type="button" class="btn btn-outline-info mb-3"
                                name="edit">LOGOUT</button></a>
                        <form action="" method="post">
                            <?php
                                if ( isset($_GET['edit']) ) { ?>
                            <div class="row mb-3">
                                <div class="col"><input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter your name" required></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><input type="text" name="phone" id="phone" class="form-control"
                                        placeholder="Enter your phone number" required></div>
                            </div>
                            <div class="row mb-3 ms-1">
                                <div class="form-check-inline">
                                    <input type="radio" name="gender" id="laki-laki" class="form-check-input"
                                        value="laki-laki">
                                    <label for="laki-laki" class="form-check-label me-3">Laki-laki</label>
                                    <input type="radio" name="gender" id="perempuan" class="form-check-input"
                                        value="perempuan">
                                    <label for="perempuan" class="form-check-label">Perempuan</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-info" name="sEdit">Submit</button>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="content-box schedule-card card mt-3" style="box-shadow: 1px 1px 3px;">
                    <div class="card-body">
                        <h4 class="text-center">Schedule</h4>
                        <table class="table text-light">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Datetime</th>
                                    <th scope="col">Employee</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $schQuery = mysqli_query($connect, "SELECT book.bookID, users.customerName, service.serviceLines, book.bookDatetime, employee.employeeName FROM book INNER JOIN users ON users.userID = book.userID INNER JOIN service ON service.serviceID = book.serviceID INNER JOIN employee ON book.employeeID = employee.employeeID WHERE book.bookDatetime > CURRENT_TIMESTAMP AND book.userID = $userid ORDER BY book.bookDatetime");
                                    while ($schData = mysqli_fetch_assoc($schQuery)) { ?>
                                <tr>
                                    <td><?= $schData["customerName"]; ?> </td>
                                    <td><?= $schData["serviceLines"]; ?> </td>
                                    <td><?= $schData["bookDatetime"]; ?> </td>
                                    <td><?= $schData["employeeName"]; ?> </td>
                                    <td><a href="profile.php?del=<?=$schData["bookID"];?>"
                                            class="link-danger text-decoration-none">Delete</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end box -->
    </div>

    <!-- back menu -->
    <div class="text-center">
        <a href="index.php"><button type="button" class="btn btn-primary">Back to menu</button></a>
    </div>

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>