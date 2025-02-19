<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>WebApp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Optional: Custom styling untuk tab aktif */
    .nav-tabs .nav-link.active {
      background-color: #f8f9fa;
      border-color: #dee2e6 #dee2e6 #fff;
    }
  </style>
</head>
<body>
  <!-- Header dengan nav-tabs -->
  <header class="container mt-3">
    <ul class="nav nav-tabs justify-content-center">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="data.php">Data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="input_data.php">Input Data</a>
      </li>
    </ul>
  </header>
<div class="container mt-5">
    <h2>Input Data Baru</h2>
    <form action="upload_data.php" method="POST" enctype="multipart/form-data" class="mb-4">
        <div class="mb-3">
            <label for="file" class="form-label">Upload CSV/Excel</label>
            <input type="file" class="form-control" name="file" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <form action="save_data.php" method="POST">
        <div class="mb-3"><label>Nama</label><input type="text" name="name" class="form-control" required></div>
        <div class="mb-3"><label>No HP</label><input type="text" name="phone_number" class="form-control" required></div>
        <div class="mb-3"><label>Alamat</label><input type="text" name="address" class="form-control"></div>
        <div class="mb-3"><label>Deskripsi</label><textarea name="description" class="form-control"></textarea></div>
                <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
        <div class="mb-3"><label>Nomor WA</label><input type="text" name="whatsapp" class="form-control" required></div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
