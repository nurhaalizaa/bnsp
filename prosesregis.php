<?php
session_start();
require 'koneksi.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $photo = $_FILES['photo'];

    // Hash password untuk keamanan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Lokasi penyimpanan foto
    $photoName = time() . '_' . basename($photo['name']);
    $targetDir = "admin/uploads/";
    $targetFilePath = $targetDir . $photoName;

    // Unggah foto
    if(move_uploaded_file($photo['tmp_name'], $targetFilePath)) {
        // Simpan data pengguna ke database
        $stmt = $conn->prepare('INSERT INTO user (nama,jenis_kelamin, email, no_hp, alamat, password,role, foto) VALUES (:firstName,:gender, :email, :phoneNumber, :alamat, :password, "user", :photo)');
        $stmt->execute([
            ':firstName' => $firstName,
            ':gender' => $gender,
            ':email' => $email,
            ':phoneNumber' => $phoneNumber,
            ':alamat' => $alamat,
            ':password' => $hashedPassword,
            ':photo' => $photoName
        ]);

        echo "<script>alert('Anda berhasil melakukan registrasi silahkan login'); window.location.href = 'login.php';</script>";
        exit();
    } else {
        echo 'Gagal mengunggah foto.';
    }
}
?>
