<?php
require '../koneksi.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $judul = $_POST['judulKegiatan'];
    $deskripsi = $_POST['deskripsiKegiatan'];
    $tanggal = $_POST['tanggalKegiatan'];
    $waktu = $_POST['waktuKegiatan'];
    $lokasi = $_POST['lokasiKegiatan'];
    $kapasitas = $_POST['kapasitasKegiatan'];

    // Proses upload file foto
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fotoKegiatan"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Periksa apakah file adalah gambar
    $check = getimagesize($_FILES["fotoKegiatan"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Periksa ukuran file
    if ($_FILES["fotoKegiatan"]["size"] > 500000) { // 500 KB max size
        echo "Ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Batasi format file
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Periksa apakah $uploadOk bernilai 0 karena error
    if ($uploadOk == 0) {
        echo "Maaf, file anda tidak dapat diupload.";
    } else {
        // Jika semua pemeriksaan lolos, upload file
        if (move_uploaded_file($_FILES["fotoKegiatan"]["tmp_name"], $target_file)) {
            try {
                // Masukkan data ke database
                $sql = "INSERT INTO event (judul, deskripsi, tanggal, waktu, lokasi, kapasitas, foto) VALUES (:judul, :deskripsi, :tanggal, :waktu, :lokasi, :kapasitas, :foto)";
                $stmt = $conn->prepare($sql);
                $stmt->execute(['judul' => $judul, 'deskripsi' => $deskripsi, 'tanggal' => $tanggal, 'waktu' => $waktu, 'lokasi' => $lokasi, 'kapasitas' => $kapasitas, 'foto' => $target_file]);

                // echo "<script>alert('Data Berhasil Ditambahkan');</script>";
                echo "<script>alert('Data Berhasil Ditambahkan'); window.location.href = 'daftarkegiatan.php';</script>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload file.";
        }
    }
}
?>
