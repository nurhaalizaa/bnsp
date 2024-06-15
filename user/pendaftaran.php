<?php
session_start();
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];
    $user_id = $_SESSION['user_id'];

    $check_stmt = $conn->prepare("SELECT COUNT(*) AS count FROM registrations WHERE event_id = :event_id AND user_id = :user_id");
    $check_stmt->bindParam(':event_id', $event_id);
    $check_stmt->bindParam(':user_id', $user_id);
    $check_stmt->execute();
    $result = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        // Jika sudah ada pendaftaran, beri pesan dan redirect
        echo "<script>alert('Anda sudah mendaftar untuk event ini.'); window.location.href = 'event.php';</script>";
    } else {
        // Jika belum ada pendaftaran, simpan data pendaftaran ke dalam database
        $insert_stmt = $conn->prepare("INSERT INTO registrations (event_id, user_id, status) VALUES (:event_id, :user_id, 'diproses')");
        $insert_stmt->bindParam(':event_id', $event_id);
        $insert_stmt->bindParam(':user_id', $user_id);

        if ($insert_stmt->execute()) {
            echo "<script>alert('Pendaftaran berhasil!'); window.location.href = 'event.php';</script>";
        } else {
            echo "<script>alert('Pendaftaran gagal. Silakan coba lagi.'); window.location.href = 'event.php';</script>";
        }
    }
}
?>
