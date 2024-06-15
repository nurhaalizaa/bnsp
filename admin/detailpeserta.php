
<?php
require '../koneksi.php'; 
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php'); 
    exit();
}
?><!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hompage Admin</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/icon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="assets/images/logos/logohitam.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
          <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
        
            <li class="sidebar-item ">
              <a class="sidebar-link " href="index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Event</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="daftarkegiatan.php" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Daftar Kegiatan</span>
              </a>
            </li>

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">User</span>
            </li>
            <li class="sidebar-item selected">
              <a class="sidebar-link active" href="daftarpeserta.php" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Daftar Peserta</span>
              </a>
            </li>
            

            



          </ul>

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <!-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> -->
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Detail Peserta</h5>
                <div class="card">
                <div class="card-body p-4">
                <?php
                    $id_peserta = $_GET['id']; // Ambil ID peserta dari parameter URL

                    try {
                        // Query untuk mengambil nama peserta berdasarkan ID
                        $sql = "SELECT nama FROM user WHERE id = :id_peserta";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_peserta', $id_peserta);
                        $stmt->execute();
                        $peserta = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Tampilkan nama peserta di judul card
                        echo "<h5 class='card-title fw-semibold mb-4'>" . $peserta['nama'] . "</h5>";

                        // Selanjutnya, Anda dapat menampilkan daftar kegiatan yang diikuti oleh peserta seperti yang sudah dijelaskan sebelumnya
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>

                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kegiatan</th>
                        <th scope="col">Tanggal Kegiatan</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php
                        try {
                            // Query untuk mengambil data kegiatan yang diikuti oleh peserta dengan ID tertentu
                            $sql = "SELECT event.id, event.judul, event.tanggal, registrations.status, registrations.id AS registration_id
                                    FROM event
                                    INNER JOIN registrations ON event.id = registrations.event_id
                                    WHERE registrations.user_id = :id_peserta";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id_peserta', $id_peserta);
                            $stmt->execute();

                            // Tampilkan data dalam tabel HTML
                            echo "<tbody>";
                            $count = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<th scope='row'>$count</th>";
                                echo "<td>" . $row['judul'] . "</td>";
                                echo "<td>" . $row['tanggal'] . "</td>";
                                echo "<td>";
                                echo "<form action='proses_ubah_status.php' method='post'>";
                                echo "<input type='hidden' name='id_registration' value='" . $row['registration_id'] . "'>";
                                echo "<select name='status' onchange='this.form.submit()'>";
                                echo "<option value='diproses' " . ($row['status'] == 'diproses' ? 'selected' : '') . ">Diproses</option>";
                                echo "<option value='diterima' " . ($row['status'] == 'diterima' ? 'selected' : '') . ">Diterima</option>";
                                echo "<option value='ditolak' " . ($row['status'] == 'ditolak' ? 'selected' : '') . ">Ditolak</option>";
                                echo "</select>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                                $count++;
                            }
                            echo "</tbody>";
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>


                      </tr>
                    </tbody>
                  </table>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
</body>

</html>