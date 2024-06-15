<?php
// Memulai sesi
include('../koneksi.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];

    $stmt = $conn->prepare("SELECT foto FROM user WHERE id = ?");
    $stmt->execute([$user_id]);
    $existing_foto = $stmt->fetchColumn();
    
    // proses update foto/tidak
    if ($foto) {
        $photoName = time() . '_' . basename($foto);
        $foto_dir = '../admin/uploads/';
        $targetFilePath = $foto_dir . $photoName;
        move_uploaded_file($foto_tmp, $targetFilePath);
    } else {
        $photoName = $existing_foto;
    }

    $conn->beginTransaction();

    try {
        if (!empty($password)) {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET nama=?, jenis_kelamin=?, email=?, no_hp=?, alamat=?, password=?, foto=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nama, $jenis_kelamin, $email, $no_hp, $alamat, $password_hashed, $photoName, $user_id]);
        } else {
            $sql = "UPDATE user SET nama=?, jenis_kelamin=?, email=?, no_hp=?, alamat=?, foto=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nama, $jenis_kelamin, $email, $no_hp, $alamat, $photoName, $user_id]);
        }

        $conn->commit();
        echo "<script>alert('Data anda berhasil diperbarui'); window.location.href = 'about.php';</script>";
    } catch (PDOException $e) {
        $conn->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>
