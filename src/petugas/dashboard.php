<?php
$title = 'Dashboard';
// Start the session
session_start();
// Require header and navigation files
require '../layouts/header.php';
require '../layouts/navPetugas.php';
// Initialize welcome message
$nama_petugas = "";
$welcome_message = "";
// Check if user session has 'nama_petugas' set
if(isset($_SESSION['nama_petugas'])) {
    // If logged in, set welcome message
    $nama_petugas = $_SESSION['nama_petugas'];
    $welcome_message = "<h2 class='text-primary'>Selamat datang, " . $nama_petugas . "!</h2>";
}

// Initialize today's date
$tanggal_hari_ini = date('d F Y');

?>

<!-- Di dalam tag head -->
<style>
  body {
    background-color: #f8f9fc;
    font-family: Arial, sans-serif;
  }

  .container-fluid {
    padding-top: 0px;
  }

  .card {
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    padding: 50px;
  }

  .card i {
    font-size: 4em;
    margin-bottom: 20px;
  }

  .card h1 {
    font-size: 2.5em;
    color: #333333;
    margin-bottom: 10px;
  }

  .card p {
    font-size: 1.2em;
    color: #666666;
    margin-bottom: 20px;
  }

  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    transition: background-color 0.3s ease;
    border-radius: 20px;
    padding: 10px 10px; /* Adjust padding */
    font-size: 0.5em; /* Adjust font size */
  }

  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
  }

  .btn-primary .icon {
    margin-right: 5px;
  }

  .btn-primary .text {
    font-weight: bold;
  }
</style>


<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 mx-auto text-center py-5">
      <div class="card shadow">
        <i class="fas fa-atlas fa-5x text-primary"></i>
        <?php echo $welcome_message; ?>
        <h1>Semoga hari ini penuh dengan kebahagiaan dan kesuksesan.</h1>
        <p><?php echo $tanggal_hari_ini; ?></p>
        </a>
      </div>
    </div>
  </div>
</div>


<?php require '../layouts/footer.php'; ?>
