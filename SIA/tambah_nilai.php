<?php
require 'koneksi.php';

$cook = $_COOKIE['cook'];

if (isset($_POST["submit"])) {

    $nisn =  $_POST['nisn'];
    $kd_mp = $_POST['kd_mp'];
    $harian = $_POST['harian'];
    $ulangan = $_POST['ulangan'];
    $ujian = $_POST['ujian'];
    $semester = $_POST['semester'];
    $tahunajaran = $_POST['tahunajaran'];

    $query_cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM nilai 
	WHERE nisn = $nisn AND kd_mp = '$kd_mp' AND
	semester = '$semester' AND kd_tahun = '$tahunajaran'
	"));
    if ($query_cek > 0) {
        echo "<script> 
		alert('Nilai yang dimasukkan sudah ada, periksa kembali!!');
		document.location.href = 'nilai.php?nisn=$cook';
		</script>";
    } else {
        mysqli_query($conn, "INSERT INTO nilai (nisn, kd_mp, harian, ulangan, ujian, semester, kd_tahun)
        VALUES
        ('$nisn', '$kd_mp', '$harian', '$ulangan', '$ujian','$semester', '$tahunajaran')") or die(mysqli_error($conn));
        return mysqli_affected_rows($conn);
        echo "<script>
        alert('Nilai berhasil ditambahkan');
        document.location.href = 'nilai.php?nisn=$cook';
        </script>";
    }
}
