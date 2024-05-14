<?php
session_start(); // Mulai session

$title = 'Aduan Masyarakat';

require '../../public/app.php';

require '../layouts/header.php';

// logic backend

// mengambil angka pengaduan dari database
$pengaduan = mysqli_query($conn, "SELECT * FROM pengaduan ORDER BY id_pengaduan  DESC LIMIT 1");

// mengambil angka tanggapan dari database
$tanggapan = mysqli_query($conn, "SELECT * FROM tanggapan ORDER BY id_tanggapan DESC LIMIT 1");

// mengambil angka akun masyarakat dari database
$masyarakat = mysqli_query($conn, "SELECT * FROM masyarakat ORDER BY id_masyarakat  DESC LIMIT 1");

// Set session jika pengguna telah login
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Lakukan sesuatu dengan username yang disimpan dalam session
    // Contoh: Menampilkan pesan sambutan sesuai dengan username
    $welcome_message = "Selamat datang, $username!";
} else {
    // Jika pengguna belum login, arahkan mereka ke halaman login
    header("Location: login.php");
    exit; // Pastikan untuk keluar setelah melakukan redirect
}

?>



<a class="navbar-brand" href="#" data-aos="zoom-in">
  <img src="../../assets/img/logo_pemweb_nw.png" width="65" alt="Logo"> AYO LAPOR
</a>



<!-- Tambahkan efek hover ke tombol -->
<a href="login.php" class="btn btn-outline-info mr-3" data-aos="fade-right" data-aos-duration="300">Login</a>
<a href="register.php" class="btn btn-outline-info mr-3" data-aos="fade-left" data-aos-duration="300">Registrasi</a>

<div class="bg-gradient-primary rounded-bottom-80 p-5" style="animation: slideInFromLeft 1s ease; background: linear-gradient(to bottom right, #87CEEB, #4682B4);">
  <div class="container d-flex justify-content-center align-items-center" data-aos="zoom-in">
    <div class="text-center col-md-8 text-light" style="animation: fadeIn 1s ease;">
      <h1 class="display-4 font-weight-bold">AYO LAPOR</h1>
      <p class="lead">"Ayo Lapor" adalah sebuah platform pengaduan masyarakat yang bertujuan untuk memberikan sarana kepada masyarakat untuk melaporkan berbagai permasalahan atau keluhan yang mereka hadapi kepada pihak yang berwenang. Melalui website ini, masyarakat dapat dengan mudah mengirimkan laporan mengenai berbagai masalah seperti infrastruktur, keamanan, lingkungan, dan lainnya.</p>
      <a href="login.php" class="btn btn-primary btn-lg btn-modern" style="animation: bounce 2s infinite;">

  <span>Buat laporan sekarang!</span>
  <i class="fas fa-arrow-right ml-2"></i>
</a>

    </div>
  </div>
</div>


<style>
@keyframes slideInFromLeft {
    0% {
        transform: translateX(-100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

@keyframes bounce {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

@keyframes slideInFromLeft {
    0% {
      opacity: 0;
      transform: translateX(-100%);
    }
    100% {
      opacity: 1;
      transform: translateX(0);
    }
  }
  
  @keyframes slideInFromRight {
    0% {
      opacity: 0;
      transform: translateX(100%);
    }
    100% {
      opacity: 1;
      transform: translateX(0);
    }
  }




</style>

<div class="container" style="margin-top: -35px ;">
  <!-- Card -->
  <?php while ($row = mysqli_fetch_assoc($pengaduan)) : ?>
    <div class="row mb-3">
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="500">
        <div class="card border-left-info border-bottom-info shadow-lg h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col ml-3">
                <div class="h5 mb-0 font-weight-bold text-info"><?= $row['id_pengaduan']; ?> Pengaduan</div>
              </div>
              <i class="fas fa-comment fa-2x text-gray-500"></i>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>

    <?php while ($row = mysqli_fetch_assoc($tanggapan)) : ?>
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="700">
        <div class="card border-left-success border-bottom-success shadow-lg h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col ml-3">
                <div class="h5 mb-0 font-weight-bold text-success"><?= $row['id_tanggapan']; ?> Tanggapan</div>
              </div>
              <i class="fas fa-comments fa-2x text-gray-500"></i>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>

    <?php while ($row = mysqli_fetch_assoc($masyarakat)) : ?>
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="900">
        <div class="card border-left-warning border-bottom-warning shadow-lg h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col ml-3">
              <div class="h5 mb-0 font-weight-bold text-success"><?= $row['id_masyarakat']; ?> Akun Masyarakat</div>
              <i class="fas fa-users fa-2x text-gray-500"></i>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile ?>
    </div>

<div class="container">
  <div class="row">
    <div class="col-6" data-aos="fade-right">
      <div class="desc" style="margin-top: 130px; animation: slideInFromLeft 1s ease;">
        <h4 class="text-justify text-gray-900">Buat laporan, aduan dan keluh kesah anda di website aduan masyarakat ini dan jangan meyebarkan berita hoax!</h4>
      </div>
    </div>
    <div class="col-6">
      <div class="img mt-5 ml-3" data-aos="slideInFromRight">
        <img src="../../assets/img/landing3.svg" width="450" alt="">
      </div>
    </div>

    <div class="col-6" style="margin-top: -45px;">
      <div class="img" data-aos="slideInFromLeft">
        <img src="../../assets/img/landing2.svg" width="450" alt="">
      </div>
    </div>
    <div class="col-6" style="margin-top: -45px;">
      <div class="desc ml-3" style="margin-top: 130px; animation: slideInFromRight 1s ease;" data-aos="fade-left">
        <h4 class="text-justify text-gray-900">Jangan lupa mengirimkan foto anda saat menyampaikan laporan, aduan ataupun keluh kesah anda di web ini.</h4>
      </div>
    </div>

    <div class="col-6" style="margin-top: -45px;">
      <div class="desc" style="margin-top: 130px; animation: slideInFromLeft 1s ease;" data-aos="fade-right">
        <h4 class="text-justify text-gray-900">Setelah menyapaikan laporan, aduan atau keluh kesah anda dapat menunggu tanggapan dengan santay.</h4>
      </div>
    </div>
    <div class="col-6" style="margin-top: -45px;" data-aos="slideInFromRight">
      <div class="img ml-3">
        <img src="../../assets/img/landing1.svg" width="450" alt="">
      </div>
    </div>
  </div>
</div>
<footer class="bg-dark text-light py-4" style="position: relative; bottom: 0; width: 100%;">
  <div class="container-fluid text-center">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <p>&copy; 2024 Aditya. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>

<style>
  
</style>




<!-- footer -->


<?php require '../layouts/footer.php'; ?>