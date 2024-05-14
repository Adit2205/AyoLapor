<?php

$title = 'Feedback';

// Require header and navigation files
require '../layouts/header.php';
require '../layouts/navUser.php';

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan");

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek apakah halaman dimuat melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lakukan validasi dan simpan feedback jika ada
    if (isset($_POST["isi"])) {
        // Tangkap isi feedback dari formulir
        $isi_feedback = $_POST["isi"];
        
        // Ambil tanggal saat ini
        $tanggal = date('Y-m-d');

        // Query untuk menyimpan feedback ke dalam database
        $sql = "INSERT INTO feedback (isi, tanggal) VALUES ('$isi_feedback', '$tanggal')";

        // Eksekusi query
        if (mysqli_query($conn, $sql)) {
            // Tampilkan pesan sukses
            echo "<h2>Terima kasih atas feedback Anda!</h2>";
        } else {
            // Tampilkan pesan error jika query gagal dieksekusi
            echo "<h2>Terjadi kesalahan. Mohon coba lagi.</h2>";
        }
    }
}

// Tutup koneksi database
mysqli_close($conn);
?>

<!-- Formulir Feedback -->
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="card-title">Beri Feedback</h5>
                    <form action="feedback.php" method="post">
                        <div class="form-group">
                            <label for="isi">Isi Feedback:</label>
                            <textarea class="form-control" id="isi" name="isi" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Kirim Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require '../layouts/footer.php'; ?>
