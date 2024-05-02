<?php
require 'koneksi.php';
require_once __DIR__ . '/vendor/autoload.php';

$nisn = $_GET['nisn'];
$tahun = $_COOKIE['tahun'];
$semester = $_COOKIE['semester'];
$lihat = query("SELECT * FROM nilai
    INNER JOIN mapel ON nilai.kd_mp = mapel.kd_mp
    INNER JOIN siswa on nilai.nisn = siswa.nisn
    WHERE nilai.nisn = $nisn AND kd_tahun = '$tahun' AND semester = '$semester'");


$mpdf = new \Mpdf\Mpdf();
$html =
    '<html>
<body>

<h1 align=center> SDN 236/IX AUR DURI II </h1>
<p align=center> Alamat : Lorong Perikanan Rt 20 Aur Duri II Mendalo Darat</p>
<hr /><br>
<p> NISN = ' . $nisn . '</p>
<p> Tahun Ajaran = ' . $tahun . '</p>
<p> Semester = ' . $semester . '</p>
<br>
    <table border = "1" cellpadding="10" cellspacing="0" align=center width=100%>
<tr> 
<th>No</th>
<th>Mata Pelajaran</th>
<th>Tugas</th>
<th>Ulangan</th>
<th>Ujian</th>
</tr>';

$i = 1;
foreach ($lihat as $nilai) {
    $html .= '<tr>
    <td>' . $i++ . '</td>
    <td>' . $nilai["nama_mp"]  . '</td>
    <td>' . $nilai["harian"]  . '</td>
    <td>' . $nilai["ulangan"]  . '</td>
    <td>' . $nilai["ujian"]  . '</td>
    </tr>';
}

$html .=
    '</table>

</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output();
