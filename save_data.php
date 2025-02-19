<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan key yang digunakan sesuai dengan form input_data.php
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $Nomor_wa = mysqli_real_escape_string($conn, $_POST['Nomor_wa']);

    // Query INSERT - pastikan nama kolom sesuai dengan struktur tabel contacts
    $sql = "INSERT INTO contacts (phone_number, name, address, description, email, Nomor_wa) 
            VALUES ('$phone_number', '$name', '$address', '$description', '$email', '$Nomor_wa')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='data.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data: " . mysqli_error($conn) . "'); window.location.href='input_data.php';</script>";
    }

    mysqli_close($conn);
}
?>
