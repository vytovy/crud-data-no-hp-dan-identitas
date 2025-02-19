<?php
include 'db_connect.php';

// Ambil id dari URL
$id = $_GET['id'];

// Ambil data utama dari tabel contacts
$data = mysqli_query($conn, "SELECT * FROM contacts WHERE id=$id");
$row = mysqli_fetch_assoc($data);

// Ambil data tambahan dari tabel contact_extra_fields untuk kontak ini
$extraQuery = "SELECT * FROM contact_extra_fields WHERE contact_id = $id";
$extraResult = mysqli_query($conn, $extraQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Detail Data</h2>
    <!-- Tampilkan data utama dari contacts -->
    <?php
    foreach ($row as $key => $value) {
        if ($key != 'id') {
            echo "<p><strong>" . htmlspecialchars(ucfirst(str_replace('_', ' ', $key))) . ":</strong> " . htmlspecialchars($value ?? '') . "</p>";
        }
    }
    ?>
    
    <h3>Data Tambahan</h3>
    <?php 
    if (mysqli_num_rows($extraResult) > 0) {
        while ($extra = mysqli_fetch_assoc($extraResult)) {
            echo "<p><strong>" . htmlspecialchars(ucfirst($extra['field_name'])) . ":</strong> " . htmlspecialchars($extra['field_value'] ?? '') . "</p>";
        }
    } else {
        echo "<p>Tidak ada data tambahan.</p>";
    }
    ?>

    <a href="edit.php?id=<?= $id ?>" class="btn btn-warning">Edit</a>
    <a href="delete.php?id=<?= $id ?>" class="btn btn-danger">Hapus</a>
    <a href="data.php" class="btn btn-secondary">Kembali</a>
</div>

<footer class="text-center mt-5 p-3 bg-light">
    &copy; 2025 WebApp. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Menutup koneksi
mysqli_close($conn);
?>
