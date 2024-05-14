<?php
$title = 'Buat Laporan';

session_start();
require '../../public/app.php';

require '../layouts/header.php';

require '../layouts/navUser.php';

// Function to get petugas from database
function getPetugas() {
    global $conn;
    $sql = "SELECT * FROM petugas";
    $result = mysqli_query($conn, $sql);
    $petugas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $petugas[] = $row;
    }
    return $petugas;
}

// Initialize the NIK and nama variables
$telp = ""; // Initialize with an empty string or any default value you prefer

// Check if session exists and username is set
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

// Logic
if (isset($_POST["submit"])) {

    $username = isset($_POST['username']) ? $_POST['username'] : "";

    // Mendapatkan tanggal hari ini
    $tgl_pengaduan = date('Y-m-d');
    
    $isi_laporan = $_POST["isi_laporan"];
    $status = "proses";

    // Mengunggah file foto
    $foto = $_FILES["foto"]["name"];
    $temp_name = $_FILES["foto"]["tmp_name"];
    $foto_destination = "../../assets/img/" . $foto;
    
    // Assigning a manual value to NIK
    $telp = isset($_POST['telp']) ? $_POST['telp'] : ""; // Assuming the input field for NIK is named 'nik'
    
    // Mendapatkan lokasi
    $lokasi = isset($_POST['lokasi']) ? $_POST['lokasi'] : ""; 

    // Mendapatkan petugas yang dipilih
    $petugas_id = isset($_POST['petugas']) ? $_POST['petugas'] : "";

    // Menyimpan foto ke dalam folder
    if (move_uploaded_file($temp_name, $foto_destination)) {
        // Menyimpan data laporan ke dalam database
        if (tambahAduan($username, $tgl_pengaduan, $telp, $lokasi, $isi_laporan, $foto, $status, $petugas_id) > 0) {
            $sukses = true;
        } else {
            $error = true;
        }
    } else {
        // Jika gagal mengunggah foto
        $error = true;
    }
}

?>

<!-- Tambahkan gaya CSS di bawah ini -->
<style>
    /* Container styling */
    .container {
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Form styling */
    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 8px;
        margin-bottom: 10px;
    }

    /* Button styling */
    .btn-outline-primary {
        color: #007bff;
        background-color: transparent;
        border-color: #007bff;
        border-radius: 5px;
        padding: 10px 20px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* Image styling */
    .image img {
        max-width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Text styling */
    .text-lg {
        font-size: 18px;
        font-weight: bold;
    }

    /* Label styling */
    label {
        font-weight: bold;
    }
</style>

<h3 class="text-gray-900" data-aos="fade-left">Buat laporan keluh kesah anda disini</h3>
<hr>
<div class="card border-bottom-primary shadow" data-aos="fade-up">
    <div class="card-body">
        <div class="container">
            <?php if (isset($sukses)) : ?>
                <div class="alert alert-dismissible fade show" style="background-color: #3bb849;" role="alert">
                    <h5 class="text-gray-100 mt-2">Aduan atau laporan sedang di proses, Terima kasih!.</h5>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (isset($error)) : ?>
                <div class="alert alert-dismissible fade show" style="background-color: #b52d2d;" role="alert">
                    <h6 class="text-light mt-2">Maaf aduan atau laporan anda gagal di proses</h6>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

<div class="row">
    <div class="col-md-4">
        <div class="image">
            <img src="../../assets/img/img-buat-laporan.svg" width="300" alt="">
        </div>
    </div>
    <div class="col-md-8 mt-2">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="text" class="form-control" id="tanggal" name="tgl_pengaduan" value="<?= date('Y-m-d'); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" readonly>
            </div>

            <div class="form-group">
                <label for="telp">No Telepon</label>
                <input type="number" class="form-control" id="telp" name="telp" value="<?= $telp ?>">
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="foto" name="foto" onchange="updateFileName()">
                    <label class="custom-file-label" for="foto" id="foto-label">Choose file</label>
                </div>
            </div>

            <script>
                function updateFileName() {
                    var input = document.getElementById('foto');
                    var label = document.getElementById('foto-label');
                    var fileName = input.files[0].name;
                    label.innerHTML = fileName;
                }
            </script>

            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi">
            </div>

            <div class="form-group">
                <label for="isi">Isi laporan</label>
                <textarea class="form-control" id="isi" rows="5" name="isi_laporan"></textarea>
            </div>

            <div class="form-group">
                <label for="petugas">Tujuan Pengaduan</label>
                <select class="form-control" id="petugas" name="petugas">
                    <?php foreach (getPetugas() as $petugas) : ?>
                        <?php if ($petugas['level'] != 'admin') : ?>
                            <option value="<?= $petugas['id_petugas'] ?>"><?= $petugas['nama_petugas'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="hidden" name="status" value="proses">

            <div class="text-center">
                <button class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
