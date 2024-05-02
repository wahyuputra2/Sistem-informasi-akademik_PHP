<?php
require 'koneksi.php';


$kd_jadwal = $_GET['kd_jadwal'];

if (hapus_jadwal($kd_jadwal) > 0) {

    echo "
<script>
    alert('data berhasil dihapus');
    document.location.href = '#';
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
