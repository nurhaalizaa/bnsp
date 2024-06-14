<?php
session_start();
require 'koneksi.php';

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $stmt = $conn->prepare('SELECT * FROM user WHERE email = :email');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        if ($user['role'] == 'user') {        

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header('Location: user/');
            exit();
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header('Location: admin/');
            exit();
        }
    } else {
        // echo 'Invalid email or password';
        echo "<script>alert('Invalid email or password'); window.location.href = 'login.php';</script>";
    }
}
?>

