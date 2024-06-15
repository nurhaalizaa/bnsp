<?php
include 'koneksi.php';
session_start();
if (isset($_SESSION['user_id'])) {
   // Cek role pengguna untuk menentukan halaman redirect
   if ($_SESSION['role'] === 'user') {
       header('Location: user/');
       exit();
   } elseif ($_SESSION['role'] === 'admin') {
       header('Location: admin/');
       exit();
   }
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>ProEvent</title>
      <link rel="icon" href="assets/images/1.png"/>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="assets/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="assets/images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;800&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
   </head>
   <body>
      <!-- header top section start -->
      <!-- header top section start -->
      <!-- header section start -->
      <div class="header_section">
         <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <div class="logo"><a href="index.php"><img src="assets/images/logoputih.png"></a></div>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#event">Event</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                     </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0">
                     
                     <div class="quote_btn"><a href="login.php">Login</a></div>
                  </form>
               </div>
            </nav>
         </div>
         <!-- banner section start -->
         <div class="banner_section layout_padding">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="banner_taital_main">
                                 <h1 class="banner_taital">DISCOVER, JOIN, ENJOY!</h1>
                                 <p class="banner_text">
                                 Explore the vibrant world of events, where every moment is an opportunity to connect, learn, and celebrate life
                                 </p>
                                 <div class="btn_main">
                                    <!-- <div class="started_text active"><a href="#">Contact US</a></div> -->
                                    <div class="started_text"><a href="#about">About Us</a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="container">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="banner_taital_main">
                                 <h1 class="banner_taital">GET MOVING WITH GREAT EVENTS</h1>
                                 <p class="banner_text">
                                 Embark on an adventure with ProEvent. Discover the thrill of exploring endless event opportunities, meeting remarkable people, and creating unforgettable moments
                                 </p>
                                 <div class="btn_main">
                                    <!-- <div class="started_text active"><a href="#">Contact US</a></div> -->
                                    <div class="started_text"><a href="#about">About Us</a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="container">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="banner_taital_main">
                                 <h1 class="banner_taital">EASY EVENT FINDER FOR AN ACTIVE LIFE</h1>
                                 <p class="banner_text">
                                 Gives you the easiest way to find events for an active lifestyle, connecting you with the most exciting happenings, ensuring you never miss out on what matters most
                                 </p>
                                 <div class="btn_main">
                                    <!-- <div class="started_text active"><a href="#">Contact US</a></div> -->
                                    <div class="started_text"><a href="#about">About Us</a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
               <i class="fa fa-angle-left"></i>
               </a>
               <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
               <i class="fa fa-angle-right"></i>
               </a>
            </div>
         </div>
        <!-- banner section end -->
      </div>
      <!-- header section end -->
      <!-- services section start -->
      <div class="services_section layout_padding" id="event">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <h1 class="services_taital">Our Events</h1>
                  <p class="services_text_1">temukan dan segera daftarkan diri anda untuk pengalaman yang seru</p>
               </div>
            </div>
            <div class="services_section_2">
               <div class="row">
                  <?php
                     $stmt = $conn->query("SELECT * FROM event limit 4");
                     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="col-lg-3 col-sm-6">
                     <div class="box_main">
                        <div class="card-img-top">
                          <img src="<?php echo 'admin/'.$row['foto']; ?>" alt="foto event">
                        </div>
                        <h4 class="development_text"><?php echo $row['judul']; ?></h4>
                        <p class="services_text"><?php echo $row['deskripsi']; ?></p>
                        <div class="readmore_bt"><a href="login.php">Read More</a></div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
      <!-- services section end -->
      <!-- about sectuion start -->
      <div class="about_section layout_padding"  id="about">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <h1 class="about_taital">About Us</h1>
                  <p class="about_text">
                  ProEvent adalah destinasi utama Anda untuk menemukan dan berpartisipasi dalam berbagai acara menarik. Kami berusaha menghubungkan para penggemar dengan acara-acara yang memenuhi berbagai minat, sehingga semua orang dapat menemukan sesuatu yang mereka sukai. Platform kami menawarkan pengalaman yang mulus, memudahkan Anda untuk menjelajahi, bergabung, dan menikmati setiap acara.
                  </p>
                  <div class="read_bt_1"><a href="registrasi.php">Join Us</a></div>
               </div>
               <div class="col-md-6">
                  <div class="about_img">
                     <div class="video_bt">
                        <div class="play_icon"><img src="assets/images/play-icon.png"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- about sectuion end -->


      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="location_text">
                     <ul>
                        <li>
                           <a href="#"><span class="padding_15"><i class="fa fa-mobile" aria-hidden="true"></i></span> <br>Call +62 1234567890</a>
                        </li>
                        <li class="active">
                           <a href="#"><span class="padding_15"><i class="fa fa-envelope" aria-hidden="true"></i></span> <br>pevent@gmail.com</a>
                        </li>
                        <li>
                           <a href="#"><span class="padding_15"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <br>Location</a>
                        </li> 
                     </ul>
                  </div>
               </div>
            </div>

            <div class="social_icon">
               <ul>
                  <li>
                     <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                  </li>
                  <li>
                     <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  </li>
                  <li>
                     <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                  </li>
                  <li>
                     <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <!-- footer section end -->

      <!-- Javascript files-->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/jquery-3.0.0.min.js"></script>
      <script src="assets/js/plugin.js"></script>
   </body>
</html>