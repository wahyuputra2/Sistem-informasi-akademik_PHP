<?php
require 'koneksi.php';

$kd_mp = $_POST['kd_mp'];


$ambil_mp = query("SELECT * FROM guru_mapel1 
INNER JOIN guru ON guru.nip = guru_mapel1.nip
INNER JOIN mapel ON mapel.kd_mp = guru_mapel1.kd_mp
WHERE kd_mp = $kd_mp") or die(mysqli_error($conn));

echo "<option>--- Pilih Guru ---</option>";
foreach ($ambil_mp as $dt) {
    echo '<option value="' . $dt['kd_gm'] . '">' . $dt['nama_guru'] . '</option>';
}

// $query_cek = mysqli_query($conn, "SELECT * FROM jadwal WHERE kd_jadwal = '$kd_jadwal'") or die(mysqli_error($conn));
	// if (mysqli_num_rows($query_cek) > 0) {
	// 	echo "<script> 
	// alert('Jadwal Guru yang dimasukkan sudah ada, periksa kembali!!');
	// document.location.href = '#';
	// </script>";
	// }
