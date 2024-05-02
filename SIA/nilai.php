<?php
require 'koneksi.php';

session_start();

if (!isset($_SESSION["masuk"])) {
    header("Location: login.php ");
    exit;
} else {
    $masuk = $_SESSION['masuk'];
    $sql_masuk = mysqli_query($conn, "SELECT * FROM user WHERE username = '$masuk'");
    $vusr = mysqli_fetch_array($sql_masuk);
    $lvl = $vusr['level'];
}


$mapel = query("SELECT * FROM mapel");
$tahun_ajaran = query("SELECT * FROM tahun");

$nisn = $_GET["nisn"];
setcookie('cook', $nisn);

if (isset($_POST["lihat"])) {

    // $nisn = $_GET["nisn"];
    $tahun = $_POST["tahun"];
    $lh_sms = $_POST["lh_semester"];
    setcookie("tahun", $tahun);
    setcookie("semester", $lh_sms);
    $lihat = query("SELECT * FROM nilai
    INNER JOIN mapel ON nilai.kd_mp = mapel.kd_mp
    INNER JOIN siswa on nilai.nisn = siswa.nisn
    WHERE nilai.nisn = $nisn AND kd_tahun = '$tahun' AND semester = '$lh_sms'
    ");
} else {
    // $halaman = $_GET["halaman"];
    $lihat = query("SELECT * FROM nilai
INNER JOIN mapel ON nilai.kd_mp = mapel.kd_mp
INNER JOIN siswa on nilai.nisn = siswa.nisn
WHERE nilai.nisn = $nisn AND kd_tahun = '2021' AND semester = 'ganjil'
");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIA SD 236/IX AUR DURI</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <br>
            <a class="sidebar-brand d-flex align-items-center justify-content-center"">
                <div>
                    <img src=" logo_sekolah.png" width="100" height="100">
    </div>
    </a> <br>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Halaman Utama</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php
    if ($lvl == 'admin') :
    ?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Data Master</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="tambah_is.php">Tambah Siswa</a>
                    <a class="collapse-item" href="tambah_guru.php">Tambah Guru</a>
                    <a class="collapse-item" href="tambah_mp.php">Tambah Mata Pelajaran</a>
                    <a class="collapse-item" href="tambah_jadwal.php">Tambah Jadwal</a>
                    <a class="collapse-item" href="tambah_pengguna.php">Tambah Pengguna</a>
                    <a class="collapse-item" href="tambah_tahun.php">Tambah Tahun Ajaran</a>
                </div>
            </div>
        </li>
    <?php
    endif;
    ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Tables -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    </ul>
    <!-- End of Sidebar -->



    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="sidebar-brand-text mx-3">SIA SD 236/IX AUR DURI II</div>
                </form>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <!-- Dropdown - Messages -->
                    </li>

                    <!-- Nav Item - Alerts -->

                    <!-- Nav Item - Messages -->


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            keluar
                        </a>
                        <!-- Dropdown - User Information -->

                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Nilai</h1>
                <br>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="kd_kelas" class="col-1 col-form-label">TA</label>
                                <div class="col-sm-2">
                                    <select class="custom-select" id="tahun" name="tahun">
                                        <?php $i = 1; ?>
                                        <?php foreach ($tahun_ajaran as $ta) : ?>
                                            <option value="<?= $ta["kd_tahun"]; ?>"><?= $ta["tahun_ajaran"]; ?></option>
                                            <?php $i++; ?>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <label for="kd_kelas" class="col-1 col-form-label">Semester</label>
                                <div class="col-sm-2">
                                    <select class="custom-select" id="lh_semester" name="lh_semester">
                                        <option value="ganjil">
                                            Ganjil
                                        </option>
                                        <option value="genap">
                                            Genap
                                        </option>

                                    </select>
                                </div>
                                <button type="submit" name="lihat" class="btn btn-primary">Lihat</button>
                            </div>
                        </form>
                        <!-- Button trigger modal -->
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Tugas</th>
                                        <th>Ulangan</th>
                                        <th>Ujian</th>
                                        <th></th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;    ?>
                                    <?php foreach ($lihat as $nil) : ?>
                                        <tr>
                                            <td><?= $i ?> </td>
                                            <td><?= $nil["nama_mp"]; ?></td>
                                            <td><?= $nil["harian"]; ?></td>
                                            <td><?= $nil["ulangan"]; ?></td>
                                            <td><?= $nil["ujian"]; ?></td>
                                            <td>
                                                <?php
                                                if ($lvl == 'guru') :
                                                ?>
                                                    <a class="btn btn-danger" href="hapus_nilai.php?id_nilai=<?= $nil["id_nilai"]; ?>" role="button" onclick=" return confirm   ('Apa Anda ingin menghapus data ini?');">
                                                        Hapus</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <?php
                            if ($lvl == 'admin') :
                            ?>
                                <center><a href="laporan_nilai.php?nisn=<?= $nisn ?>" target="_black"><button class="btn btn-default btn-xs"><i class="fa fa-print"></i>Cetak</button>
                                    </a>
                                <?php
                            endif;
                                ?>
                                <?php
                                if ($lvl == 'guru') :
                                ?>
                                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#tambah">
                                        masukkan nilai
                                    </button>
                                <?php
                                endif;
                                ?>
                                <!-- Modal -->
                                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Masukkan Nilai Siswa</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="tambah_nilai.php">
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-2 col-form-label">NISN</label>
                                                        <!-- <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="no_hp" name="nisn" required value="<?= $_GET["nisn"]; ?>">
                                                    </div> -->
                                                        <div class="col-sm-10">
                                                            <input type="text" readonly class="form-control-plaintext" id="nisn" name="nisn" require value="<?= $_GET["nisn"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kd_kelas" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                                                        <div class="col-sm-10">
                                                            <select class="custom-select" id="tahunajaran" name="tahunajaran">
                                                                <option value="">--- Tahun Ajaran ---</option>
                                                                <?php $i = 1; ?>
                                                                <?php foreach ($tahun_ajaran as $ta) : ?>
                                                                    <option value="<?= $ta["kd_tahun"]; ?>"><?= $ta["tahun_ajaran"]; ?></option>
                                                                    <?php $i++; ?>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kd_kelas" class="col-sm-2 col-form-label">Semester</label>
                                                        <div class="col-sm-10">
                                                            <select class="custom-select" id="semester" name="semester">
                                                                <option value="">--- Pilih Semester ---</option>
                                                                <option value="ganjil">Ganjil</option>
                                                                <option value="genap">Genap</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kd_kelas" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                                                        <div class="col-sm-10">
                                                            <select class="custom-select" id="kd_kelas" name="kd_mp">
                                                                <option value="">--- Pilih Mata Pelajaran ---</option>
                                                                <?php $i = 1; ?>
                                                                <?php foreach ($mapel as $mpl) : ?>
                                                                    <option value="<?= $mpl["kd_mp"]; ?>"><?= $mpl["nama_mp"]; ?></option>
                                                                    <?php $i++; ?>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kd_kelas" class="col-sm-2 col-form-label">Tugas</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="no_hp" name="harian">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kd_kelas" class="col-sm-2 col-form-label">Ulangan</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="no_hp" name="ulangan">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kd_kelas" class="col-sm-2 col-form-label">Ujian</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="no_hp" name="ujian">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Sistem Informasi Akademik | SDN 236/IX AUR DURI II</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>