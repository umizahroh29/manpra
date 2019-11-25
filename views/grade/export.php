<?php
$data = $_SESSION['export_data'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Export Nilai</title>
</head>
<body>
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Nilai Praktikan.xls");
?>
<center>
    <h4>Data Nilai Praktikum <?= $_SESSION['practicum_name'] ?></h4>
</center>

<table border="1">
    <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Modul</th>
        <th>Tes Awal</th>
        <th>Jurnal</th>
        <th>Tes Akhir</th>
        <th>Nilai Akhir</th>
    </tr>
    <?php foreach ($data as $datum) { ?>
        <tr>
            <td align="center" width="50"><?= $datum['no'] ?></td>
            <td align="center" width="120"><?= $datum['nim'] ?></td>
            <td align="left" width="200"><?= $datum['name'] ?></td>
            <td align="center" width="100"><?= $datum['class'] ?></td>
            <td align="center" width="150"><?= $datum['module'] ?></td>
            <td align="right" width="100"><?= $datum['pretest_score'] ?></td>
            <td align="right" width="100"><?= $datum['journal_score'] ?></td>
            <td align="right" width="100"><?= $datum['posttest_score'] ?></td>
            <td align="right" width="100"><?= $datum['final_score'] ?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>