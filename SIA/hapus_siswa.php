<?php
require 'koneksi.php';

$kelas = $_COOKIE['kelas'];
$nisn = $_GET['nisn'];

if (hapus_siswa($nisn) > 0) {

    echo "
<script>
    alert('data berhasil dihapus');
    document.location.href = 'profil_kelas1.php?kelas=$kelas';
</script>
";
} else {
    echo "
<script>
    alert('data gagal dihapus');
    document.location.href = '#';
</script>
";
}
