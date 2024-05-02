<?php
require 'koneksi.php';

$nisn = $_COOKIE['nisn'];

if (isset($_POST["lihat"])) {


    // $nisn = $_GET["nisn"];
    $tahun = $_POST["tahun"];
    $lh_sms = $_POST["lh_semester"];
    $lihat = query("SELECT * FROM nilai
    INNER JOIN mapel ON nilai.kd_mp = mapel.kd_mp
    INNER JOIN siswa on nilai.nisn = siswa.nisn
    WHERE nilai.nisn = $nisn AND tahun = '$tahun' AND semester = '$lh_sms'
    ");
    echo "
<script>
    document.location.href = 'nilai.php?nisn=$nisn&tahun=$tahun&semester=$lh_sms';
</script>
";
}
