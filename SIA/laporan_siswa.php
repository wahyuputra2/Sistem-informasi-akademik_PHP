<?php
require 'koneksi.php';
require_once __DIR__ . '/vendor/autoload.php';

$kelas = $_GET['kelas'];
$students = query("SELECT * FROM siswa WHERE kd_kelas = '$kelas'");


$mpdf = new \Mpdf\Mpdf();
$html =
    '<html>
<body>

<h1 align=center> SDN 236/IX AUR DURI II </h1>
<p align=center> Alamat : Lorong Perikanan Rt 20 Aur Duri II Mendalo Darat</p>
<hr /><br><br>
    <table border = "1" cellpadding="10" cellspacing="0" align=center width=100%>
<tr> 
<th>No</th>
<th>Nisn</th>
<th>Nama</th>
<th>Kelas</th>
<th>Orang Tua/Wali</th>
</tr>';

$i = 1;
foreach ($students as $student) {
    $html .= '<tr>
    <td>' . $i++ . '</td>
    <td>' . $student["nisn"]  . '</td>
    <td>' . $student["nama_siswa"]  . '</td>
    <td>' . $student["kd_kelas"]  . '</td>
    <td>' . $student["wali"]  . '</td>
    </tr>';
}

$html .=
    '</table>

</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output();
