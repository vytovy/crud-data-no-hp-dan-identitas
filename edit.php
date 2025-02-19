<?php
include 'db_connect.php';

// Ambil ID kontak dari parameter URL
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM contacts WHERE id=$id");
$row = mysqli_fetch_assoc($data);

// Ambil data tambahan dari tabel contact_extra_fields
$extra_fields = mysqli_query($conn, "SELECT * FROM contact_extra_fields WHERE contact_id=$id");

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update data utama
    $updates = [];
    foreach ($_POST as $key => $value) {
        if (!in_array($key, ['new_columns', 'new_values', 'extra_values'])) {
            $updates[] = "$key = '" . mysqli_real_escape_string($conn, $value) . "'";
        }
    }

    if (!empty($updates)) {
        $update_query = "UPDATE contacts SET " . implode(", ", $updates) . " WHERE id=$id";
        mysqli_query($conn, $update_query);
    }

    // Update data tambahan
    if (!empty($_POST['extra_values'])) {
        foreach ($_POST['extra_values'] as $extra_id => $extra_value) {
            $sql = "UPDATE contact_extra_fields SET field_value=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $extra_value, $extra_id);
            $stmt->execute();
        }
    }

    // Tambah kolom tambahan baru
    if (!empty($_POST['new_columns']) && !empty($_POST['new_values'])) {
        foreach ($_POST['new_columns'] as $index => $column) {
            $col = mysqli_real_escape_string($conn, $column);
            $val = mysqli_real_escape_string($conn, $_POST['new_values'][$index]);
            $sql = "INSERT INTO contact_extra_fields (contact_id, field_name, field_value) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $id, $col, $val);
            $stmt->execute();
        }
    }

    echo "<script>alert('Data berhasil diperbarui'); window.location.href='lihat_data.php?id=$id';</script>";
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Data</h2>
    <form method="POST" class="mb-4">
        <!-- Form Data Utama -->
        <?php foreach ($row as $column => $value): ?>
            <div class="mb-3">
                <label class="form-label text-capitalize"><?= str_replace('_', ' ', $column) ?></label>
                <input type="text" name="<?= $column ?>" value="<?= $value ?>" class="form-control">
            </div>
        <?php endforeach; ?>

        <!-- Form Data Tambahan -->
        <h4>Data Tambahan</h4>
        <?php while ($extra = mysqli_fetch_assoc($extra_fields)): ?>
            <div class="mb-3">
                <label class="form-label"><?= htmlspecialchars($extra['field_name']) ?></label>
                <input type="text" name="extra_values[<?= $extra['id'] ?>]" value="<?= htmlspecialchars($extra['field_value']) ?>" class="form-control">
            </div>
        <?php endwhile; ?>

        <!-- Tambah Form Baru -->
        <div id="new-fields"></div>
        <button type="button" class="btn btn-success mb-3" onclick="addField()">Tambah Form</button>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="lihat_data.php?id=<?= $id ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    function addField() {
        const container = document.getElementById('new-fields');
        const html = `
            <div class="mb-3 border p-3 rounded">
                <input type="text" name="new_columns[]" placeholder="Nama Kolom" class="form-control mb-2" required>
                <input type="text" name="new_values[]" placeholder="Nilai" class="form-control" required>
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
