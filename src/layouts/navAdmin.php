<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
<a class="navbar-brand" href="" data-aos="zoom-in" style="background: none; display: flex; align-items: center;">
  <img src="../../assets/img/logo_pemweb_nw.png" width="65" alt="Logo" style="margin-right: 15px; margin-left: 0.45cm; background-color: transparent;">
  <span style="color: white; margin-left: 0.16cm;">AYO LAPOR</span>
</a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if ($title === "Dashboard") echo "active"; ?>">
      <a class="nav-link" href="../admin/dashboard.php">
        <i class="fas fa-user-astronaut"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Fiture
    </div>



    <!-- Nav Item - Laporan masyarakat -->
   <li class="nav-item <?php if ($title === "Laporan Masyarakat") echo "active"; ?>">
      <a class="nav-link" href="../admin/laporan.php">
        <i class="fas fa-book-open"></i>
        <span>Laporan Masyarakat</span></a>
    </li>

    <!-- Nav Item - Laporan masyarakat -->
   <!-- <li class="nav-item <?php if ($title === "Laporan Terverifikasi") echo "active"; ?>">
      <a class="nav-link" href="../admin/terverify.php">
        <i class="fas fa-check-circle"></i>
        <span>Laporan Terverify</span></a>
    </li>

    <!-- Nav Item - Generate -->
  <li class="nav-item <?php if ($title === "Tanggapan") echo "active"; ?>">
      <a class="nav-link" href="../admin/tanggapan.php">
        <i class="fas fa-bookmark"></i>
        <span>Tanggapan</span></a>
    </li>

    <!-- Nav Item - Petugas -->
    <li class="nav-item <?php if ($title === "Data Petugas") echo "active"; ?>">
      <a class="nav-link" href="../admin/petugas.php">
        <i class="fas fa-user-tie"></i>
        <span>Data Petugas</span></a>
    </li>

    <li class="nav-item <?php if ($title === "Data Masyarakat") echo "active"; ?>">
      <a class="nav-link" href="../admin/masyarakat.php">
        <i class="fas fa-user-tie"></i>
        <span>Data Masyarakat</span></a>
    </li>

    <!-- Nav Item - Feedback -->
<li class="nav-item <?php if ($title === "Feedback") echo "active"; ?>">
  <a class="nav-link" href="../admin/Hasilfeedback.php">
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
        <button id="sidebarToggleTop" class="btn btn-link d-md-none ">
          <i class="fa fa-bars"></i>
        </button>

        <h3 class="text-gray-800 ml-3"><?= $title; ?></h3>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

          <!-- Nav Item - logout -->
          <li class="nav-item dropdown no-arrow">
            <a href="../petugas/login.php" class="btn btn-outline-danger">Logout</a>
          </li>

        </ul>

      </nav>

      <div class="container">

        <!-- End of Topbar -->