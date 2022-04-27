<?php

$connect = mysqli_connect("localhost", "root", "", "brotherbarbershop");

if ($connect -> connect_error) {
    die('Maaf koneksi gagal: '. $connect -> connect_error);
}

function checkPhoneNumber($data) {
    if ( preg_match("/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/i", $data) ) {
        return true;
    } else {
        return false;
    }
}

function registrasi($data) {
    global $connect;

    $username = stripslashes($data["username"]);
    $password = mysqli_real_escape_string($connect, $data["password"]);
    $password2 = mysqli_real_escape_string($connect, $data["password2"]);
    $name = stripslashes($data["name"]);
    $gender = $data["gender"];
    $phone = $data["phone"];

    //cek username
    $result = mysqli_query($connect, "SELECT username FROM users WHERE username = '$username'");

    if ( mysqli_fetch_assoc($result) ) {
        echo "<script>alert('username sudah terdaftar')</script>";
        return false;
    }

    //cek password
    if( $password !== $password2 ) {
        echo "<script>alert('password tidak sesuai!')</script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //tambah ke database
    mysqli_query( $connect, "INSERT INTO users VALUES('', '$username', '$password', '$name', '$gender', '$phone')" );

    return mysqli_affected_rows($connect);
}

function editData($data, $akun) {
    global $connect;

    $name = stripslashes($data["name"]);
    $gender = $data["gender"];
    $phone = $data["phone"];

    //edit database
    mysqli_query( $connect, "UPDATE users SET customerName = '$name', customerGender = '$gender', phoneNumber = '$phone' WHERE userID = '$akun'");

    return mysqli_affected_rows($connect);
}

function cekDate($data, $id) {
    global $connect;

    $employee = $data["employee"];
    $date = $data["date"];
    $time = $data["time"];
    $datetime = $date . " " . $time;
    
    $query = mysqli_query($connect, "SELECT * FROM book");
    $rows = array();
    while($row = mysqli_fetch_array($query)) {
        $rows[] = $row;
    }
    foreach ($rows as $row) {
        if (($row['bookDatetime'] === $datetime) && ($row['employeeID'] === $employee)) {
            return false;
            exit;
        }
    }
    
    $userid = $id;
    $serviceid = $data["service"];

    //tambah ke database
    mysqli_query($connect, "INSERT INTO book (bookDate, bookTime, bookDatetime, userID, serviceID, employeeID) VALUES('$date', '$time', '$datetime', '$userid', '$serviceid', '$employee')");

    return mysqli_affected_rows($connect);

}