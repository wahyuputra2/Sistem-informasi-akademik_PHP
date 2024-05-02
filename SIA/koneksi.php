<?php

$conn = mysqli_connect("localhost", "root", "", "kp");

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah_siswa($data)
{
	global $conn;

	$nisn = $data["nisn"];
	$nama = $data["nama_siswa"];
	$jk_siswa = $data["jk_siswa"];
	$kd_kelas = $data["kd_kelas"];
	$ttl = $data["ttl"];
	$wali = $data["wali"];
	$no_hp = $data["no_hp"];

	$gambar_siswa = upload();
	if (!$gambar_siswa) {
		return false;
	}

	$query = "INSERT INTO siswa
                VALUES 
                ('$nisn', '$nama', '$jk_siswa', '$kd_kelas', '$ttl', '$wali', '$no_hp', '$gambar_siswa')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload()
{
	$nama_gambar = $_FILES['gambar_siswa']['name'];
	$ukuran_gambar = $_FILES['gambar_siswa']['size'];
	$error = $_FILES['gambar_siswa']['error'];
	$simpan_gambar = $_FILES['gambar_siswa']['tmp_name'];

	move_uploaded_file($simpan_gambar, 'img/' . $nama_gambar);
	return $nama_gambar;
}

function hapus_siswa($nisn)
{

	global $conn;
	mysqli_query($conn, "DELETE FROM siswa WHERE nisn = $nisn");
	return mysqli_affected_rows($conn);
}

function ubah_siswa($data_siswa)
{

	global $conn;
	$nisn = $data_siswa["nisn"];
	$nama_siswa = $data_siswa["nama_siswa"];
	$jk_siswa = $data_siswa["jk_siswa"];
	$kd_kelas = $data_siswa["kd_kelas"];
	$ttl = $data_siswa["ttl"];
	$wali = $data_siswa["wali"];
	$no_hp = $data_siswa["no_hp"];



	$query = "UPDATE siswa SET 
				nama_siswa = '$nama_siswa',
				jk_siswa = '$jk_siswa',
				kd_kelas = '$kd_kelas',
				ttl = '$ttl', 
				wali = '$wali', 
				no_hp = '$no_hp' 
				
			WHERE nisn = '$nisn' 
				";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

////////////////// GURU ////////////////////////////////////////////////////////////////////////////////
function tambah_guru($data_guru)
{
	global $conn;
	$nip = $data_guru["nip"];
	$nama = $data_guru["nama_guru"];
	$ttl = $data_guru["ttl"];
	$no_guru = $data_guru["no_guru"];
	$status_guru = $data_guru["status_guru"];
	$jenis_kelamin = $data_guru["jenis_kelamin"];


	$query = "INSERT INTO guru
				VALUES
				('$nip', '$nama', '$ttl', '$no_guru', '$status_guru', '$jenis_kelamin')";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}


function hapus_guru($nip)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM guru WHERE nip = $nip");
	return mysqli_affected_rows($conn);
}


function ubah_guru($data_guru)
{

	global $conn;
	$nip = $data_guru["nip"];
	$nama = $data_guru["nama_guru"];
	$ttl = $data_guru["ttl"];
	$no_guru = $data_guru["no_guru"];
	$status_guru = $data_guru["status_guru"];
	$jenis_kelamin = $data_guru["jenis_kelamin"];

	$query = "UPDATE guru SET 
				nama_guru = '$nama', 
				ttl = '$ttl', 
				no_guru = '$no_guru', 
				status_guru = '$status_guru', 
				jenis_kelamin = '$jenis_kelamin'
			WHERE nip = '$nip' 
				";
	mysqli_query($conn, $query);

	// $mp_guru = $data_guru["mp_guru"];
	// foreach ($mp_guru as $kd_mp) {
	// 	mysqli_query($conn, "INSERT INTO guru_mapel (nip, kd_mp)
	// 	VALUES 
	// 	('$nip','$kd_mp')
	// 	") or die(mysqli_error($conn));
	// }
	// foreach ($mp_guru as $kd_mp) {
	// 	mysqli_query($conn, "UPDATE guru_mapel SET 
	// 	kd_mp = '$kd_mp'

	// 	WHERE nip = $nip") or die(mysqli_error($conn));
	// }

	return mysqli_affected_rows($conn);
}


function cari_guru($keyword_guru)
{

	$query = "SELECT * FROM guru
				 WHERE 
	 nama_guru LIKE '%$keyword_guru%'
	 ";
	return query($query);
}

///////////////////////////////////////////////////////////////////////////////////////////////////

function tambah_mp($data_mp)
{
	global $conn;
	$kd_mp = $data_mp["kd_mp"];
	$nama_mp = $data_mp["nama_mp"];



	$query = "INSERT INTO mapel
				VALUES
				('$kd_mp', '$nama_mp')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////

function tambah_jadwal($data)
{
	global $conn;

	$kd_jadwal = $data["kd_jadwal"];
	$kd_mp = $data["kd_mp"];
	$nip = $data["nip"];
	$kd_kelas = $data["kd_kelas"];
	$hari = $data["hari"];
	$jam_mulai = $data["jam_mulai"];
	$jam_selesai = $data["jam_selesai"];

	// $query = "INSERT INTO jadwal
	//             VALUES 
	//             ('$kd_jadwal', '$kd_mp', '$nip', '$kd_kelas', '$hari', '$jam_mulai', '$jam_selesai')";

	$query_cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM jadwal 
	WHERE nip = '$nip' AND
	hari = '$hari' AND (jam_mulai = '$jam_mulai' OR jam_selesai = '$jam_selesai') 
	-- AND kd_kelas = '$kd_kelas' 
	-- AND nip = '$nip'
	"));

	if ($query_cek > 0) {
		echo "<script> 
		alert('Jadwal Guru yang dimasukkan sudah ada, periksa kembali!!');
		document.location.href = '#';
		</script>";
	} else {
		mysqli_query($conn, "INSERT INTO jadwal
		            VALUES 
		             ('$kd_jadwal', '$kd_mp', '$nip', '$kd_kelas', '$hari', '$jam_mulai', '$jam_selesai')");
		return mysqli_affected_rows($conn);
	}
}

function hapus_jadwal($kd_jadwal)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM jadwal WHERE kd_jadwal = $kd_jadwal");
	return mysqli_affected_rows($conn);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function tambah_tahun($data_tahun)
{
	global $conn;
	$kd_tahun = $data_tahun["kd_tahun"];
	$tahun_ajaran = $data_tahun["tahun"];

	$query = "INSERT INTO tahun (kd_tahun, tahun_ajaran)
				VALUES
				('$kd_tahun', '$tahun_ajaran')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function tambah_pengguna($pengguna)
{
	global $conn;
	$username = $pengguna["username"];
	$password = $pengguna["password"];
	$level = $pengguna["level"];

	$query = "INSERT INTO user (username, password1, level)
				VALUES
				('$username','$password', '$level')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function hapus_nilai($nilai)
{
	global $conn;
	$query = ("DELETE FROM nilai WHERE id_nilai = $nilai");
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
