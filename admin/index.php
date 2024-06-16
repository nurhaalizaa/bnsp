<?php
require '../koneksi.php'; 
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php'); 
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ProEvent | Admin</title>
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
        
            <li class="sidebar-item selected">
              <a class="sidebar-link active" href="index.php" aria-expanded="false">
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
            <li class="sidebar-item">
              <a class="sidebar-link" href="daftarpeserta.php" aria-expanded="false">
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
                    <a href="../logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
            <h5 class="card-title fw-semibold mb-4">Daftar Kegiatan</h5>
            <div class="card">
            <div class="card-body p-4">
              <div class="row">
              <?php
                  $stmt = $conn->query("SELECT * FROM event LIMIT 6");

                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <div class="col-md-4 mb-4">
                  <div class="card">
                      <div class="card-body">
                          <img src="<?php echo $row['foto']; ?>" class="card-img-top" alt="Foto Peserta">
                          <h5 class="card-title"><?php echo $row['judul']; ?></h5>
                          <p class="card-text"><?php echo $row['deskripsi']; ?></p>
                          <p class="card-text">Tanggal: <?php echo $row['tanggal']; ?></p>
                          <p class="card-text">Waktu: <?php echo $row['waktu']; ?></p>
                          <p class="card-text">Lokasi: <?php echo $row['lokasi']; ?></p>
                          <p class="card-text">Kapasitas: <?php echo $row['kapasitas']; ?></p>
                      </div>
                  </div>
              </div>
          <?php } ?>
          </div>
          <a href='daftarkegiatan.php' class='btn btn-secondary m-1'>See More</a>
      </div>

            </div>
            <h5 class="card-title fw-semibold mb-4">Daftar Peserta</h5>
              <div class="card">
                  <div class="card-body p-4">
                      <div class="row">
                          <?php
                          $stmt = $conn->query("SELECT * FROM user where role != 'admin' LIMIT 6");

                          // Loop melalui setiap baris data peserta
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                              <div class="col-md-3 mb-4">
                                  <div class="card">
                                      <img src="<?php echo 'uploads/'.$row['foto']; ?>" class="card-img-top" alt="Foto Peserta">
                                      <div class="card-body">
                                          <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                                          <p class="card-text">Email: <?php echo $row['email']; ?></p>
                                          <p class="card-text">No. HP: <?php echo $row['no_hp']; ?></p>
                                          <!-- Tambahkan informasi peserta lainnya sesuai kebutuhan -->
                                      </div>
                                  </div>
                              </div>
                          <?php } ?>
                      </div>
                    <a href='daftarpeserta.php' class='btn btn-secondary m-1'>See More</a>
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
  <script src="assets/js/dashboard.js"></script>
</body>

</html>