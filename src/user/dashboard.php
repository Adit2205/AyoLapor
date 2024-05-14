<?php
$title = 'Dashboard';
// Start the session
session_start();
// Require header and navigation files
require '../layouts/header.php';
require '../layouts/navUser.php';
// Database connection
$conn = mysqli_connect("localhost", "root", "", "laporan");
// Check database connection
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// Initialize variables
$username = "";
$id_masyarakat = "";
// Check if user session has 'id_masyarakat' set
if(isset($_SESSION['username'])) {
    //Jika sudah login, tampilkan pesan selamat datang
    $welcome_message = "<h2 class='text-primary'>Selamat datang, " . $_SESSION['username'] . "!</h2>";
?>

<style>


    /* Container styling */
    .container-fluid {
        background-color: #f8f9fa; /* Warna latar belakang lebih cerah */
        padding: 50px;
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Welcome message styling */
    .welcome-message {
        margin-bottom: 20px;
    }

    /* Description styling */
    .desc {
        background-color: #fff; /* Warna latar belakang putih */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Text styling */
    .text-primary {
        color: #007bff; /* Warna biru lebih cerah */
    }

    /* Button styling */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Warna biru yang sedikit lebih gelap saat hover */
    }

    .btn-outline-primary {
        color: #007bff;
        border-color: #007bff;
        transition: color 0.3s ease, border-color 0.3s ease;
    }

    .btn-outline-primary:hover {
        color: #0056b3; /* Warna biru yang sedikit lebih gelap saat hover */
        border-color: #0056b3; /* Warna border yang sesuai saat hover */
    }

    /* Image styling */
    .image img {
        max-width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        filter: brightness(110%);
    }

    /* Foto profil styling */
    .foto-profil {
        max-width: 50px;
        border-radius: 50%;
        margin-right: 20px;
        margin-top: -60px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Styling untuk kolom-kolom */
    .column {
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between; /* Menyisipkan ruang kosong di antara elemen */
    }

    /* Style untuk teks deskripsi */
    .description {
        margin-bottom: 20px;
        font-size: 20px;
    }

    /* Style untuk foto profil dan deskripsi */
    .profile-info {
        display: flex;
        align-items: center;
        margin-top: 20px;
    }
</style>



<div class="container-fluid">
    <div class="row">
        <!-- Kolom pertama -->
        <div class="col-lg-6 column">
            <div class="desc">
                <div class="welcome-message">
                    <?php echo $welcome_message; ?>
                </div>
                <div class="profile-info">
                    <!-- Tambahkan foto profil di sini -->
                    <?php if(isset($_SESSION['foto_profil'])): ?>
                        <img src="../../assets/img/<?php echo $_SESSION['foto_profil']; ?>" alt="Foto Profil" class="foto-profil">
                    <?php endif; ?>
                    <div>
                        <p class="description">Website ini dibuat untuk melihat laporan atau keluhan masyarakat dan menjawabnya dengan satu platform.</p>
                        <!-- Tambahkan kode PHP untuk menampilkan tanggal hari ini -->
                        <p class="text-primary"><?php echo date('d F Y'); ?></p>
                        <?php if (!empty($id_masyarakat)) : ?>
                            <a href="buatLaporan.php" class="btn btn-lg btn-primary shadow">Buat Laporan</a>
                            <a href="lihatLaporan.php" class="btn btn-lg btn-outline-primary ml-2">Lihat Laporan</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Kolom kedua -->
        <div class="col-lg-6 column">
            <div class="image text-center">
                <img src="../../assets/img/img-dashboard-user.svg" width="80%" alt="">
            </div>
        </div>
    </div>
</div>


<?php require '../layouts/footer.php'; ?>
<?php } ?>

<script>
    // Get current date
    var currentDate = new Date();
    // Format the date as desired
    var formattedDate = currentDate.getDate() + '/' + (currentDate.getMonth() + 1) + '/' + currentDate.getFullYear();
    // You can now use 'formattedDate' wherever you need to display the current date in your script
    console.log(formattedDate); // For testing, you can log it to console
</script>
