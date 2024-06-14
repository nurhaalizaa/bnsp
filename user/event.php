<?php
include '../koneksi.php';
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: ../login.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ProEvent</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/1.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img src="assets/img/logoputih.png" height="50"></a>
                <!-- <a class="navbar-brand" href="#page-top">Start Bootstrap</a> -->
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php">Beranda</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded active" href="event.php">Event</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="pengumuman.php">MyEvent</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="about.php">About</a></li>
                        <!-- <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#contact">Pengumuman</a></li> -->
                        <form action="" method="post">
                            <button class="nav-link py-3 px-0 px-lg-3 rounded">
                                Logout
                            </button>
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Portfolio Section-->
        <section class="page-section portfolio">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mt-5">Events</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">
                <?php
                    try {
                        $stmt = $conn->query("SELECT e.id, e.judul, e.lokasi, e.tanggal, e.kapasitas, COUNT(r.event_id) AS jumlah_pendaftar, e.kapasitas - COUNT(r.event_id) AS kapasitas_tersedia,e.deskripsi, e.foto FROM event e LEFT JOIN registrations r ON e.id = r.event_id AND r.status = 'diterima' GROUP BY e.id");

                        // $stmt = $conn->query("SELECT event.*, COUNT(registrations.event_id) AS jumlah_pendaftar FROM event LEFT JOIN registrations ON event.id = registrations.event_id GROUP BY event.id");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // Menghitung kapasitas yang tersedia
                            // $kapasitas_tersedia = $row['kapasitas'] - $row['jumlah_pendaftar'];

                            echo '<div class="col-md-6 col-lg-4 mb-5">';
                            echo '    <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal' . $row['id'] . '">';
                            echo '        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">';
                            echo '            <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>';
                            echo '        </div>';
                            echo '        <h3 class="text-center">' . $row['judul'] . '</h3>';
                            echo '        <img class="img-fluid" src="../admin/' . $row['foto'] . '" alt="' . $row['judul'] . '" />';
                            echo '    </div>';
                            echo '</div>';

                            // Modal Detail untuk setiap event
                            echo '<div class="portfolio-modal modal fade" id="portfolioModal' . $row['id'] . '" tabindex="-1" aria-labelledby="portfolioModal' . $row['id'] . '" aria-hidden="true">';
                            echo '    <div class="modal-dialog modal-xl">';
                            echo '        <div class="modal-content">';
                            echo '            <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>';
                            echo '            <div class="modal-body text-center pb-5">';
                            echo '                <div class="container">';
                            echo '                    <div class="row justify-content-center">';
                            echo '                        <div class="col-lg-8">';
                            echo '                            <!-- Portfolio Modal - Title-->';
                            echo '                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">' . $row['judul'] . '</h2>';
                            echo '                            <!-- Icon Divider-->';
                            echo '                            <div class="divider-custom">';
                            echo '                                <div class="divider-custom-line"></div>';
                            echo '                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>';
                            echo '                                <div class="divider-custom-line"></div>';
                            echo '                            </div>';
                            echo '                            <!-- Portfolio Modal - Image-->';
                            echo '                            <img class="img-fluid rounded mb-5" src="../admin/' . $row['foto'] . '" alt="' . $row['judul'] . '" />';
                            echo '                            <!-- Portfolio Modal - Text-->';
                            echo '                            <p class="mb-1">' . $row['deskripsi'] . '</p>';
                            echo '                            <p class="mb-1">Lokasi: ' . $row['lokasi'] . '</p>';
                            echo '                            <p class="mb-1">Tanggal: ' . $row['tanggal'] . '</p>';
                            echo '                            <p class="mb-1">Kapasitas Tersedia: ' . $row['kapasitas_tersedia'] . '</p>';
                            echo '                            <a href="pendaftaran.php?id=' . $row['id'] . '" class="btn btn-primary">';
                            echo '                                <i class="fas fa-user-plus fa-fw"></i>';
                            echo '                                Daftar Event';
                            echo '                            </a>';
                            echo '                        </div>';
                            echo '                    </div>';
                            echo '                </div>';
                            echo '            </div>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </div>
            </div>
        </section>

        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Location</h4>
                        <p class="lead mb-0">
                            2215 John Daniel Drive
                            <br />
                            Clark, MO 65243
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Around the Web</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">About Freelancer</h4>
                        <p class="lead mb-0">
                            Freelance is a free to use, MIT licensed Bootstrap theme created by
                            <a href="http://startbootstrap.com">Start Bootstrap</a>
                            .
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container">
                <small>&copy; Copyright ProEvent 2024</small>
            </div>
        </div>
        

        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
