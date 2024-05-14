<?php
$title = 'Register';
require '../../public/app.php';
require '../layouts/header.php';

// Logic Backend
if (isset($_POST['submit'])) {
    // Pastikan semua data yang diperlukan tersedia sebelum memanggil fungsi regisUser
    if (
        isset($_POST['nik']) &&
        isset($_POST['nama']) &&
        isset($_POST['username']) &&
        isset($_POST['password']) &&
        isset($_FILES['foto_profil']['name'])
    ) {
        // Handle file upload for profile picture
        $target_dir = "../../assets/img/"; // Directory where the file will be stored
        $foto_profil = $_FILES['foto_profil']['name']; // Original file name
        $foto_profil_tmp = $_FILES['foto_profil']['tmp_name']; // Temporary file name
        
        // Give the uploaded file a unique name to avoid overwriting
        $foto_profil_unique = uniqid() . '_' . $foto_profil;
        $target_file = $target_dir . $foto_profil_unique;

        // Memanggil fungsi regisUser untuk melakukan registrasi
        $_POST['foto_profil'] = $foto_profil_unique; // Menambahkan nama file foto profil ke dalam $_POST

        if (regisUser($_POST) > 0) {
            // Jika registrasi berhasil, ambil id terakhir dari database
            $last_id = getLastUserId();
            // Set session id_masyarakat dengan id terbaru
            $_SESSION['id_masyarakat'] = $last_id;

            // Pindahkan file foto profil yang diunggah ke direktori yang ditentukan
            if (move_uploaded_file($foto_profil_tmp, $target_file)) {
                echo "The file ". htmlspecialchars($foto_profil) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

            // Redirect ke halaman sukses
            header("location: sukses.php");
            exit(); // Pastikan tidak ada output lain sebelum redirect
        } else {
            echo "Failed to register user.";
        }
    } else {
        echo "Missing required data.";
    }
}

// Function to get the last inserted user ID
function getLastUserId() {
    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "laporan");
    // Check database connection
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Query to get the last inserted user ID
    $sql = "SELECT MAX(id_masyarakat) AS last_id FROM masyarakat";
    $result = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['last_id'];
    } else {
        // Handle query error
        return 0; // Or any default value you prefer
    }

    // Close database connection
    mysqli_close($conn);
}
?>

<div class="d-flex justify-content-center py-5">
    <div class="card w-25 shadow" data-aos="zoom-in">
        <div class="card-body border-bottom-primary">
            <h5 class="text-primary text-center">Registrasi</h5>
            <hr class="bg-primary">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="number" class="form-control py-4 shadow-sm" placeholder="NIK" style="border-radius: 25px;" name="nik">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control py-4 shadow-sm" placeholder="Nama" style="border-radius: 25px;" name="nama">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control py-4 shadow-sm" placeholder="Username" style="border-radius: 25px;" name="username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control py-4 shadow-sm" placeholder="Password" style="border-radius: 25px;" name="password">
                </div>
                <div class="form-group">
                    <label for="foto_profil">Foto Profil</label>
                    <input type="file" class="form-control-file shadow-sm" style="border-radius: 25px;" name="foto_profil" id="foto_profil">
                </div>
                <div class="mb-2 text-center">
                    <a href="login.php" class="text-gray-600" style="text-decoration: none;">Sudah Punya Akun?</a>
                </div>
                <div class="button">
                    <button class="btn btn-primary shadow-sm py-2 col-12" name="submit" style="border-radius: 25px;">Registrasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
