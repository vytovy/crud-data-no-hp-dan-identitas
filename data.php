<?php
include 'db_connect.php'; // Koneksi ke database

// Ambil parameter pencarian jika ada
$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    // Query untuk mengambil data dengan filter pencarian
    $sql = "SELECT * FROM contacts WHERE phone_number LIKE ? OR name LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Jika tidak ada pencarian, ambil semua data
    $sql = "SELECT * FROM contacts";
    $result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data - WebApp</title>
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
    <h2>Data Tabel</h2>
    <form method="GET" class="mb-3">
      <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan No HP, Nama, atau Deskripsi">
      <button type="submit" class="btn btn-primary mt-2">Cari</button>
    </form>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nomor HP</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Deskripsi</th>
          <th>email</th>
          <th>nomor wa</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($row['phone_number'] ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($row['name'] ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($row['address'] ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($row['description'] ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($row['Nomor_wa'] ?? '') . "</td>";
            echo "<td><a href='lihat_data.php?id=" . $row['id'] . "' class='btn btn-info'>Lihat</a></td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
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
