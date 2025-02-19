<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    // Pastikan id berupa angka
    $id = intval($_GET['id']);
    
    // Hapus data utama dari tabel contacts
    $sql = "DELETE FROM contacts WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        // Jika ada data tambahan, hapus juga di tabel contact_extra_fields
        mysqli_query($conn, "DELETE FROM contact_extra_fields WHERE contact_id = $id");
        
        echo "<script>alert('Data berhasil dihapus'); window.location.href='data.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data: " . mysqli_error($conn) . "'); window.location.href='lihat_data.php?id=$id';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan'); window.location.href='data.php';</script>";
}

mysqli_close($conn);
?>
