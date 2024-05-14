<?php
session_start(); // Start the session

$title = 'Login';

require '../layouts/header.php';
require '../../public/app.php'; 

// Logic backend
//if(isset($_SESSION['username'])) {
//    Jika sudah login, tampilkan pesan selamat datang
//    echo "Selamat datang, " . $_SESSION['username'] . "! <br>";
//    header("location:dashboard.php");
//    echo "<a href='logout.php'>Logout</a>"; // Tambahkan link untuk logout
//} else {
    // Jika belum login, tampilkan form login
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Proses login jika form login telah dikirimkan
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Koneksi ke database (ganti dengan informasi database Anda)
        $conn = new mysqli("localhost", "root", "", "laporan");

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Lakukan query untuk memeriksa username dan password
        $sql = "SELECT * FROM masyarakat WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        // Jika ditemukan 1 baris, berarti login berhasil
        if ($result->num_rows == 1) {
            // Ambil data pengguna
            $user_data = $result->fetch_assoc();
            
            // Set session username
            $_SESSION['username'] = $username;
            $_SESSION['nama'] = $user_data['nama']; // Simpan nama pengguna ke dalam session
            $_SESSION['foto_profil'] = $user_data['foto_profil']; // Simpan nama file foto profil ke dalam session
            
            // Redirect ke halaman dashboard.php setelah login berhasil
            header("Location: dashboard.php");
            exit();
        } else {
            // Jika tidak ditemukan, tampilkan pesan error
            $error = true; // Tambahkan variabel error untuk menampilkan pesan error pada form
        }

        // Tutup koneksi database
        $conn->close();
    }
//}
?>


<div class="container-fluid" style="width: 100%; height: 100vh; background: linear-gradient(to right, #667eea, #764ba2) 100%;">
    <div class="row justify-content-center align-items-center" style="height: 100%;">
        <div class="col-lg-4 col-md-6">
            <div class="card shadow border-bottom-primary">
                <div class="card-body">
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-dismissible fade show" style="background-color: #b52d2d;" role="alert">
                            <h6 class="text-gray-100 mt-2">Maaf username atau password anda salah</h6>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" class="text-light">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['success_message']; ?>
                        </div>
                        <?php unset($_SESSION['success_message']); ?> <!-- Clear the success message after displaying -->
                    <?php endif; ?>

                    <h3 class="text-center text-primary text-uppercase text-bold">Login</h3>
                    <hr class="bg-gradient-primary">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control shadow" style="border: none;" id="username" placeholder="..." name="username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control shadow" style="border: none;" id="password" placeholder="..." name="password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <div class="">
                            <button type="submit" name="submit" class="btn btn-primary shadow-lg">Masuk</button>
                            <a href="../petugas/login.php" class="btn btn-outline-primary ml-2">Masuk sebagai petugas</a>
                            <!-- Tambahkan tombol untuk lupa password -->
                            <a href="lupa_password.php" class="btn btn-link ml-2">Lupa Password?</a>
                        </div>
                        <div class="text-center mt-2">
                            <a href="register.php" class="text-gray-600" style="text-decoration: none;">Belum Punya Akun?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php' ?>

