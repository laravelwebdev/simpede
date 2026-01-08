<?php
/**
 * Monitoring cacah data export
 */

require_once dirname(__DIR__, 4).'/app/Helpers/database.php';

$conn = getDbConnection();
$setRec = mysqli_query($conn, 'SELECT prov, kab, nks, nus0324, statusc, p1c, p2c, p1p, p2p, p3p, p4p, p5p, p1k, p2k FROM cacah ORDER BY nks ASC, nus0324 + 0 ASC');

$columnHeader =
 'prov'."\t".
 'kab'."\t".
 'nks'."\t".
 'nus'."\t".
 'status'."\t".
 'Hasil Pencacahan K'."\t".
 'Hasil Pencacahan KP'."\t".
 'Jumlah ART'."\t".
 'Pengeluaran Makanan Sebulan'."\t".
 'Pengeluaran Bukan Makanan Sebulan'."\t".
 'Jumlah Komoditas Bahan Makanan'."\t".
 'Jumlah Komoditas Barang-Barang bukan Makanan'."\t".
 'Catatan K'."\t".
 'Catatan KP'."\t";

$setData = '';
while ($rec = mysqli_fetch_row($setRec)) {
    $rowData = '';
    foreach ($rec as $value) {
        $value = '"'.$value.'"'."\t";
        $rowData .= $value;
    }
    $setData .= trim($rowData)."\n";
}

header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename=mon_pencacahan.xls');
header('Pragma: no-cache');
header('Expires: 0');

echo $columnHeader."\n".$setData."\n";
?> 