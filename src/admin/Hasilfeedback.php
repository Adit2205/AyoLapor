<?php

$title = 'Feedback';

// Require header and navigation files
require '../layouts/header.php';
require '../layouts/navAdmin.php';

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan");

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data feedback dari database
$sql = "SELECT * FROM feedback";
$result = mysqli_query($conn, $sql);

// Tutup koneksi database
mysqli_close($conn);
?>

<!-- Tabel Feedback -->
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="card-title">Feedback</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Isi Feedback</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row["isi"] . "</td>";
                                        echo "<td>" . $row["tanggal"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>Tidak ada feedback</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="#" class="btn btn-primary mt-3" onclick="history.go(0)">Refresh</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require '../layouts/footer.php'; ?>
