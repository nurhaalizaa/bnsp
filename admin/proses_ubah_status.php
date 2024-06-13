<?php
$dsn = 'mysql:host=localhost;dbname=proevent';
$username = 'root';
$password = '';
// $id_peserta = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Koneksi ke database menggunakan PDO
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Ambil data yang dikirimkan melalui formulir
        $id_registration = $_POST['id_registration'];
        $status = $_POST['status'];

        // Query untuk mengubah status kehadiran peserta
        $sql = "UPDATE registrations SET status = :status WHERE id = :id_registration";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_registration', $id_registration);
        $stmt->execute();

        // Redirect kembali ke halaman sebelumnya atau halaman lain yang sesuai
        echo "<script>alert('Status berhasil diperbarui.'); window.history.go(-1);</script>";
        // exit(); // Pastikan untuk keluar dari skrip setelah pengalihan header
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Jika akses langsung ke skrip ini tanpa menggunakan metode POST, maka lakukan pengalihan atau tindakan lainnya.
    // Contoh: Redirect ke halaman lain atau tampilkan pesan kesalahan
    echo "Akses tidak valid";
}
?>
