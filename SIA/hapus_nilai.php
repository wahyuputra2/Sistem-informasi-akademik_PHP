<?php
require 'koneksi.php';


$nilai = $_GET['id_nilai'];

if (hapus_nilai($nilai) > 0) {

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
