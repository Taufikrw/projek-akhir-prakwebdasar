<?php
session_start();
require 'function.php';

function query($query)
    {
        $mysqli_result = mysqli_query(mysqli_connect("localhost", "root", "", "brotherbarbershop"), $query);
        $rows = [];
        while ($row=mysqli_fetch_assoc($mysqli_result))
        {
            $rows[]=$row;
        }
        return $rows;
    }

$service = query("SELECT * FROM servicelines");

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

    <title>Homepage</title>
</head>

<body
    style="background-image: url(https://img.freepik.com/free-photo/black-brick-wall-textured-background_53876-63572.jpg?t=st=1650356367~exp=1650356967~hmac=94d6216e0eec90a827e2c0d098b0cadb074de2cdd84b1ac746a3d356a409c526&w=900); background-size: 100%;">
    <!-- navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
        <div class="container container-fluid">
            <a class="navbar-brand px-3">Brother</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto" style="font-family: 'Chewy', cursive;">
                    <li class="nav-item  px-3">
                        <a class="nav-link" href="#service">Sevices</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="#pegawai">Employees</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item px-3">
                        <a href="profile.php"><button type="submit" class="btn btn-primary">Profile</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- Jumbotron -->
    <div id="jumbotron" class="container-fluid banner">
        <div class="container banner-content col-lg-6">
            <div class="row">
                <div class="col-4 my-3 justify-content-center">
                    <img class="logo" src="Foto/logo.png">
                </div>
                <div class="mx-5 col position-relative">
                    <div class="position-absolute top-50 start-0 translate-middle-y">
                        <figure class="text-center">
                            <blockquote>
                                <h1 class style="font-family: 'Frijole', cursive;">BROTHER</h1>
                            </blockquote>
                        </figure>
                        <a href="book.php"><button type="submit" class="btn btn-danger">BOOK</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end jumbotron -->

    <!-- Service -->
    <div class="konten-ganjil my-4">
        <div class="container">
            <div class="row text-center">
                <div class="col content-title">
                    <h1 id="service">
                        <br>
                        SERVICES
                    </h1>
                </div>
            </div>
            <div class="row text-center justify-content-center service">
                <?php
                foreach($service as $row)
                :
                ?>
                <div class="col-lg-2 col">
                    <a class="text-center" href="index.php?serviceLines=<?= $row["serviceLines"] ?>#service">
                        <button style="background: none; border:none;">
                            <div class="row">
                                <div class="col position-relative" style="height: 10vh;">
                                    <img class="position-absolute bottom-0 end-0 service-icon"
                                        src="Foto/<?= $row['serviceIcon'] ?>">
                                </div>
                            </div>
                            <h4 class="service-text"><?= $row["serviceLines"] ?></h4>
                        </button class="icon-button">
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php
            if($_GET!=NULL)
            { ?>
            <div class="row justify-content-center">
                <?php
                $ser_name = $_GET["serviceLines"];
                ?>
                <div class="col-12 text-center py-2 card-title">
                    <?php 
                    $service = query("SELECT * FROM servicelines WHERE serviceLines = '$ser_name'");
                    foreach($service as $row)
                    : ?>
                    <h3>Price : Rp. <?= $row["servicePrice"]; ?></h3>
                    <?php endforeach; ?>
                </div>
                <?php
                $features = query("SELECT * FROM service WHERE serviceLines = '$ser_name'");
        
                foreach($features as $row)
                : ?>
                <div class="col-lg-3 col-md-4 col-6 my-2">
                    <div class="card bg-dark service-card">
                        <div class="row">
                            <div class="col card-img-top mx-3 my-1"
                                style="background-image:url(Foto/<?= $row["serviceImage"] ?>)"></div>
                        </div>
                        <div class="card-body">
                            <p class="card-title" style="color: white;"><?= $row["serviceName"] ?></p>
                        </div class="model-card">
                    </div>
                </div>
                <?php
                endforeach;
                ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- end service -->

    <!-- employee -->
    <div class="konten-genap my-4">
        <div class="container">
            <div class="row text-center">
                <div class="col content-title">
                    <h1 id="pegawai">
                        <br>
                        EMPLOYEES
                    </h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php
                $employees = query("SELECT * FROM employee");
                foreach($employees as $row)
                : ?>
                <div class="col-5 card m-2 employee-card" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col img-fluid rounded card-img-top mx-2 my-1"
                                    style="background-image:url(Foto/<?= $row["employeePhoto"] ?>); background-position:center;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["employeeName"] ?></h5>
                                <p class="teks-biodata"><?= $row["employeeDeskripsi"] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- end employee -->

    <!-- contact -->
    <div id="contact" class="bg-dark mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col">
                            <h3 class="contact-title">ADDRESS</h3>
                            <div class="contact-values">
                                <p>Jl. Pahlawan, Kebumen, Bumirejo, Kec. Kebumen, Kabupaten Kebumen, Jawa Tengah 54311
                                </p>
                                <p>WhatsApp : 0822 3344 2343</p>
                                <p>E-mail : brother@gmail.com</p>
                                <p>Website : www.brother.com</p>
                            </div>
                        </div>
                        <div class="col">
                            <h3 class="contact-title">OPENING HOURS</h3>
                            <div class="contact-values">
                                <p>Monday --> 09:00 - 20.00</p>
                                <p>Tuesday --> 09:00 - 20.00</p>
                                <p>Wednesday --> 09:00 - 20.00</p>
                                <p>Thursday --> 09:00 - 20.00</p>
                                <p>Friday --> 09:00 - 20.00</p>
                                <p>Saturday --> 09:00 - 20.00</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="contact-title">MAPS</h3>
                    <a href="https://www.google.com/maps/place/Alun-alun+Kota+Kebumen/@-7.668759,109.6495943,690m/data=!3m2!1e3!4b1!4m5!3m4!1s0x2e7aca0881659fcb:0x1fb6a781a4f47e70!8m2!3d-7.668759!4d109.651783"
                        target="_blank">
                        <img src="Foto/maps.jpg" class="maps">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact -->


    <script>
    var nav = document.querySelector("nav");

    window.addEventListener("scroll", function() {
        if (window.pageYOffset > 100) {
            nav.classList.add("bg-dark", "shadow");
        } else {
            nav.classList.remove("bg-dark", "shadow");
        }
    });
    </script>

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>