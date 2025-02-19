<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <h1>Selamat Datang di WebApp</h1>
    <p>Gunakan navigasi di atas untuk mengelola data Anda.</p>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
