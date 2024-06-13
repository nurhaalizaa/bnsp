<?php
// Periksa apakah ada ID kegiatan yang dikirimkan
if (isset($_GET['id'])) {
    // Ambil ID kegiatan dari parameter URL
    $id = $_GET['id'];

    // Koneksi ke database
    $dsn = 'mysql:host=localhost;dbname=proevent';
    $username = 'root';
    $password = '';
    try {
        // Buat koneksi PDO
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query untuk menghapus kegiatan berdasarkan ID
        $sql = "DELETE FROM event WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Redirect ke halaman daftar kegiatan setelah penghapusan berhasil
        echo "<script>alert('Kegiatan berhasil dihapus');</script>";
        echo "<script>window.location.href = 'daftarkegiatan.php';</script>";
        exit();
    } catch (PDOException $e) {
        // Tangani kesalahan jika terjadi
        echo "Error: " . $e->getMessage();
    }
} else {
    // Jika tidak ada ID kegiatan yang dikirimkan, beri respons pesan kesalahan
    echo "ID kegiatan tidak tersedia";
}
?>

