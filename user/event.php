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
        <title>ProEvent | User</title>
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
                        <form action="../logout.php" method="post">
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
                <form class="d-flex" action="event.php" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Cari event..." aria-label="Search" name="keyword">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                
                <div class="row justify-content-center">
                <?php
                try {
                    if (isset($_GET['keyword'])) {
                        $keyword = '%' . $_GET['keyword'] . '%';
                        $stmt = $conn->prepare("SELECT e.id, e.judul, e.lokasi, e.tanggal, e.kapasitas, COUNT(r.event_id) AS jumlah_pendaftar, e.kapasitas - COUNT(r.event_id) AS kapasitas_tersedia, e.deskripsi, e.foto 
                                                FROM event e 
                                                LEFT JOIN registrations r ON e.id = r.event_id AND r.status = 'diterima' 
                                                WHERE e.judul LIKE :keyword
                                                GROUP BY e.id");
                        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
                        $stmt->execute();
                    } else {
                        $stmt = $conn->query("SELECT e.id, e.judul, e.lokasi, e.tanggal, e.kapasitas, COUNT(r.event_id) AS jumlah_pendaftar, e.kapasitas - COUNT(r.event_id) AS kapasitas_tersedia, e.deskripsi, e.foto 
                                            FROM event e 
                                            LEFT JOIN registrations r ON e.id = r.event_id AND r.status = 'diterima' 
                                            GROUP BY e.id");
                    }

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal<?php echo $row['id']; ?>">
                                <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                    <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <h3 class="text-center"><?php echo $row['judul']; ?></h3>
                                <img class="img-fluid" src="../admin/<?php echo $row['foto']; ?>" alt="<?php echo $row['judul']; ?>" />
                            </div>
                        </div>

                        <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="portfolioModal<?php echo $row['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                                    <div class="modal-body text-center pb-5">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-8">
                                                    <!-- Portfolio Modal - Title-->
                                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"><?php echo $row['judul']; ?></h2>
                                                    <!-- Icon Divider-->
                                                    <div class="divider-custom">
                                                        <div class="divider-custom-line"></div>
                                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                                        <div class="divider-custom-line"></div>
                                                    </div>
                                                    <!-- Portfolio Modal - Image-->
                                                    <img class="img-fluid rounded mb-5" src="../admin/<?php echo $row['foto']; ?>" alt="<?php echo $row['judul']; ?>" />
                                                    <!-- Portfolio Modal - Text-->
                                                    <p class="mb-1"><?php echo $row['deskripsi']; ?></p>
                                                    <p class="mb-1">Lokasi: <?php echo $row['lokasi']; ?></p>
                                                    <p class="mb-1">Tanggal: <?php echo $row['tanggal']; ?></p>
                                                    <p class="mb-1">Kapasitas Tersedia: <?php echo $row['kapasitas_tersedia']; ?></p>
                                                    <form method="POST" action="pendaftaran.php">
                                                        <input type="hidden" name="event_id" value="<?php echo $row['id']; ?>">
                                                        <button type="submit" class="btn btn-primary">Daftar Event</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    ?>
                </div>

            </div>
        </section>

        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Location</h4>
                        <p class="lead mb-0">
                            Jl. jaksa agung
                            <br />
                            Surabaya, Indonesia
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
                        <h4 class="text-uppercase mb-4">More Info</h4>
                        <p class="lead mb-0">
                        Tunggu apa lagi? Segera daftar dan jadilah bagian dari pengalaman acara yang tak terlupakan bersama kami!
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
