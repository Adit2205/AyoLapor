<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
<!-- Sidebar - Brand -->
<a class="navbar-brand" href="" data-aos="zoom-in" style="background: none; display: flex; align-items: center;">
  <img src="../../assets/img/logo_pemweb_nw.png" width="65" alt="Logo" style="margin-right: 15px; margin-left: 0.45cm; background-color: transparent;">
  <span style="color: white; margin-left: 0.16cm;">AYO LAPOR</span>
</a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        
        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?php if ($title === "Dashboard") echo "active"; ?>">
            <a class="nav-link" href="../user/dashboard.php">
                <i class="fas fa-users"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Fiture
        </div>


        <!-- Nav Item - Buat Laporan -->
        <li class="nav-item <?php if ($title === "Buat Laporan") echo "active"; ?>">
            <a class="nav-link" href="../user/buatLaporan.php">
                <i class="fas fa-edit"></i>
                <span>Buat Laporan</span></a>
        </li>

        <!-- Nav Item - Laporan masyarakat -->
        <li class="nav-item <?php if ($title === "Laporan") echo "active"; ?>">
            <a class="nav-link" href="../user/lihatLaporan.php">
                <i class="fas fa-book-open"></i>
                <span>Laporan masyarakat</span></a>
        </li>

        <!-- Nav Item - Tanggapan -->
        <li class="nav-item <?php if ($title === "Tanggapan") echo "active"; ?>">
            <a class="nav-link" href="../user/tanggapan.php">
                <i class="fas fa-bookmark"></i>
                <span>Tanggapan</span></a>
        </li>

         <!-- Nav Item - Feedback -->
    <li class="nav-item <?php if ($title === "Feedback") echo "active"; ?>">
        <a class="nav-link" href="../user/feedback.php">
            <i class="fas fa-comment"></i>
            <span>Feedback</span>
        </a>
    </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>


    </ul>
    <!-- End of Sidebar -->



    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none">
        <i class="fa fa-bars"></i>
    </button>

    <h3 class="text-gray-800 ml-3"><?=$title;?></h3>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto align-items-center">
    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle text-primary" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog mr-1"></i> <span class="d-none d-md-inline">Pengaturan</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="editProfile.php">
                <i class="fas fa-user mr-2"></i> Edit Profile
            </a>
            <a class="dropdown-item" href="https://api.whatsapp.com/send?phone=6281352324953&text=Halo,%20saya%20ada%20pertanyaan.">
                <i class="fab fa-whatsapp mr-2"></i> WhatsApp
            </a>
            <a class="dropdown-item" href="../user/">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </div>
    </li>
</ul>








</nav>

            <!-- End of Topbar -->

            <div class="container">
