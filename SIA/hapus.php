<?php

require 'koneksi.php';

$nip = $_GET["nip"];


if (hapus_guru($nip) > 0) {
    echo "
        <script> 
            alert('data berhasil dihapus');
            document.location.href = 'guru.php';
        </script>    
    ";
} else {
    echo "
    <script> 
            alert('data gagal dihapus');
            document.location.href = 'guru.php';
        </script>
        ";
}
