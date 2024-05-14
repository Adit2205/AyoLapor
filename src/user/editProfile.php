<?php
// Mulai output buffering
ob_start();

// Mulai session
session_start();

$title = 'Edit Profile';
require '../../public/app.php';
require '../layouts/header.php';
require '../layouts/navUser.php';

// Periksa apakah pengguna sudah masuk
if (!isset($_SESSION['username'])) {
    // Jika belum, arahkan pengguna ke halaman login atau halaman lainnya
    header("Location: login.php");
    exit(); // Pastikan untuk keluar dari skrip untuk menghentikan eksekusi lebih lanjut
}

// Memastikan koneksi ke database tersedia (sesuaikan dengan cara Anda)
$conn = mysqli_connect("localhost", "root", "", "laporan");

// Memeriksa koneksi database
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Mendapatkan username dari sesi
$username = $_SESSION['username'];

// Mendapatkan data pengguna dari database
$query = "SELECT * FROM masyarakat WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// Memeriksa apakah query berhasil dieksekusi
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Memeriksa apakah ada baris hasil
if (mysqli_num_rows($result) > 0) {
    // Mengambil data pengguna
    $user = mysqli_fetch_assoc($result);
} else {
    // Jika tidak ada baris hasil, berikan pesan kesalahan atau lakukan tindakan yang sesuai
    die("User dengan username yang diberikan tidak ditemukan.");
}

// Set default value untuk pesan
$success_message = '';

// Memeriksa apakah ada pengiriman formulir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract form data
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];

    // Handle file upload for profile picture
    $foto_profil = $user['foto_profil']; // Default value
    if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../../assets/img/"; // Directory where the file will be saved
        $target_file = $target_dir . basename($_FILES['foto_profil']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['foto_profil']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['foto_profil']['size'] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $target_file)) {
                $foto_profil = basename($_FILES['foto_profil']['name']);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update user data in database
    $update_query = "UPDATE masyarakat SET username = '$new_username', password = '$new_password', foto_profil = '$foto_profil' WHERE username = '$username'";
    $update_result = mysqli_query($conn, $update_query);

    // Memeriksa apakah query update berhasil dieksekusi
    if ($update_result) {
        // Set pesan sukses
        $success_message = "Profil berhasil diperbarui.";

        // Update sesi pengguna dengan username baru
        $_SESSION['username'] = $new_username;

        // Update foto profil di sesi pengguna
        $_SESSION['foto_profil'] = $foto_profil;

        // Redirect to dashboard or profile page
        //header("Location: dashboard.php");
        //exit();
    } else {
        // Jika gagal, tampilkan pesan error
        $error_message = "Gagal memperbarui profil: " . mysqli_error($conn);
    }
}

// Menutup koneksi database (opsional, tergantung pada preferensi Anda)
mysqli_close($conn);

// Akhir output buffering dan kirimkan output ke browser
ob_end_flush();
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Profile</div>
                <div class="card-body">
                    <?php if(isset($error_message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($success_message)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama Pengguna</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>">
                        </div>
                        <!-- Tambahkan input file untuk foto profil -->
                        <div class="form-group">
                            <label for="foto_profil">Foto Profil</label>
                            <input type="file" class="form-control-file" id="foto_profil" name="foto_profil">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
