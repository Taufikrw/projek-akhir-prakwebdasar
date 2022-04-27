<?php
session_start();
require 'function.php';

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION["username"];

$userQuery = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username'");
$userData = mysqli_fetch_assoc($userQuery);

?>
<!DOCTYPE html>
<html lang="en">

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

    <title>Brother | Book</title>
</head>

<body class="body-book" style="background-image: url(https://img.freepik.com/free-photo/black-brick-wall-textured-background_53876-63572.jpg?t=st=1650356367~exp=1650356967~hmac=94d6216e0eec90a827e2c0d098b0cadb074de2cdd84b1ac746a3d356a409c526&w=900);
    background-size: 100%;">
    <div class="container">

        <br><br>
        <h1 class="text-center content-title" style="font-size: 50px;">BOOKING</h1>
        <br><br>
        <div class="row justify-content-center">
            <div class="col-lg-2 col-md-3 col-5">
                <form action="edit.php" method="post">
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasTop" aria-controls="offcanvasTop" style="width:100%;">View
                        Schedule</button>

                    <div class="offcanvas offcanvas-top pb-3" tabindex="-1" id="offcanvasTop"
                        aria-labelledby="offcanvasTopLabel" style="background-color: #141E27;">
                        <div class="offcanvas-body">
                            <div class="container-fluid">
                                <table class="table text-light">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Service</th>
                                            <th scope="col">Datetime</th>
                                            <th scope="col">Employee</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $schQuery = mysqli_query($connect, "SELECT users.customerName, service.serviceLines, book.bookDatetime, employee.employeeName FROM book INNER JOIN users ON users.userID = book.userID INNER JOIN service ON service.serviceID = book.serviceID INNER JOIN employee ON book.employeeID = employee.employeeID WHERE book.bookDatetime > CURRENT_TIMESTAMP ORDER BY book.bookDatetime");
                                        while ($schData = mysqli_fetch_assoc($schQuery)) { ?>
                                        <tr>
                                            <td><?= $schData["customerName"]; ?> </td>
                                            <td><?= $schData["serviceLines"]; ?> </td>
                                            <td><?= $schData["bookDatetime"]; ?> </td>
                                            <td><?= $schData["employeeName"]; ?> </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>


        <!-- main -->

        <div class="row justify-content-center">
            <div class="col-md-5 m-2 p-2 content-box">
                <h2 class="text-center">My Profile</h2>
                <br>
                <div class="row">
                    <!-- Menampilkan nama akan -->
                    <div class="col-4 my-1">
                        Nama
                    </div>
                    <div class="col-1 my-1">
                        :
                    </div>
                    <div class="col-7 my-1">
                        <?= $userData["customerName"]; ?>
                    </div>
                    <!-- Menampilkan jenis kelamin -->
                    <div class="col-4 my-1">
                        Jenis kelamin
                    </div>
                    <div class="col-1 my-1">
                        :
                    </div>
                    <div class="col-7 my-1">
                        <?= $userData["customerGender"]; ?>
                    </div>
                    <!-- Menampilkan no telepon -->
                    <div class="col-4 my-1">
                        No. telp
                    </div>
                    <div class="col-1 my-1">
                        :
                    </div>
                    <div class="col-7 my-1">
                        <?= $userData["phoneNumber"]; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 m-2 p-2 content-box">
                <h2 class="text-center">My Book</h2>
                <br>
                <form action="profile.php" method="post">
                    <div class="row">
                        <!-- Kolom pemilihan tanggal -->
                        <div class="col-4 my-1">
                            <label for="date">Date</label>
                        </div>
                        <div class="col-1 my-1">
                            :
                        </div>
                        <div class="col-7 my-1">
                            <input type="date" name="date" id="date" style="width : 80%;">
                        </div>
                        <!-- Kolom pemilihan waktu -->
                        <div class="col-4 my-1">
                            <label for="time">Time</label>
                        </div>
                        <div class="col-1 my-1">
                            :
                        </div>
                        <div class="col-7 my-1">
                            <?php
                        $options = array('09:00:00', '10:00:00', '11:00:00', '13:00:00', '14:00:00', '16:00:00', '17:00:00', '19:00:00', '20:00:00');
                        echo "<select name='time' id='time'>";
                        foreach ($options as $option ) {
                            echo "<option value='$option'>$option</option>";
                        }
                        echo "</select>";
                    ?>
                        </div>
                        <!-- Kolom pemilihan service -->
                        <div class="col-4 my-1">
                            <label for="service">Service</label>
                        </div>
                        <div class="col-1 my-1">
                            :
                        </div>
                        <div class="col-7 my-1">
                            <select name="service" id="service" style="width : 80%;">
                                <?php
                        $serviceQuery = mysqli_query($connect, "SELECT * FROM service");
                        while ($serviceData = mysqli_fetch_assoc($serviceQuery)) { ?>
                                <option value="<?=$serviceData['serviceID'];?>">
                                    <?=$serviceData['serviceName'] . " (" . $serviceData['serviceLines'] . ")";?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Kolom pemilihan pegawai -->
                        <div class="col-4 my-1">
                            <label for="employee">Employee</label>
                        </div>
                        <div class="col-1 my-1">
                            :
                        </div>
                        <div class="col-7 my-1">
                            <select select name="employee" id="employee" style="width : 80%;">
                                <?php
                        $employeeQuery = mysqli_query($connect, "SELECT * FROM employee");
                        while ($employeeData = mysqli_fetch_assoc($employeeQuery)) { ?>
                                <option value="<?=$employeeData['employeeID'];?>">
                                    <?=$employeeData['employeeName'] . " (" . $employeeData['employeeGender'] . ")";?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-5 my-1"></div>
                        <div class="col my-1">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                        <?php
                        if (isset($_GET['text'])){
                            if ($_GET['text'] = "failed") {
                                echo "<script>alert('Waktu tidak tersedia!')</script>";
                            }
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end main -->

    <div class="text-center mt-4">
        <a href="index.php"><button type="button" class="btn btn-primary">Back to menu</button></a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>