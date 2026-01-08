<?php
/**
 * Cacah detail view
 */

require_once dirname(__DIR__, 4).'/app/Helpers/database.php';

if (! isset($_GET['nks']) || ! isset($_GET['nus']) || ! isset($_GET['nama'])) {
    header('Location:dcacah.php');
    exit;
}

$conn = getDbConnection();
$nks = sanitizeInput($_GET['nks']);
$nus = sanitizeInput($_GET['nus']);
$nama = sanitizeInput($_GET['nama']);

$query = 'SELECT * FROM cacah WHERE nus = ? AND nks = ?';
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ss', $nus, $nks);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_array($result)) {
    $data = $row;
}

$csudah = '';
$cbelum = 'checked';
if ($data['statusc'] === 'sudah') {
    $csudah = 'checked';
    $cbelum = '';
}

$ksudah = '';
$kbelum = 'checked';
if ($data['p1k'] == 1) {
    $ksudah = 'checked';
    $kbelum = '';
}

$kpsudah = '';
$kpbelum = 'checked';
if ($data['p2k'] == 1) {
    $kpsudah = 'checked';
    $kpbelum = '';
}

?>

<!DOCTYPE html>
<html lang='en' class=''>

<head>
  <meta charset='UTF-8'>
  <title>iSusenas</title>
  <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  <meta content="utf-8" http-equiv="encoding">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">  
</head>

<body>
  <div id="app">
  <form class="vue-form" action="a_cacah.php" method="post">
    <div class="error-message">
      <p>PROGRESS PENCACAHAN</p>
    </div>
    <fieldset>

      <div>
        <h4>NKS</h4>
        <p class="select">
          <select class="budget" name="nks">
                <?php

      echo '<option value="'.$nks.'">'.$nks.'</option>';
?>
		</select>
        </p>
      </div>

      <div>
        <h4>Nomor Urut Sampel Panel Periode Lalu</h4>
        <p class="select">
          <select class="budget"  name="nus">
                <?php
 echo '<option value="'.$nus.'">'.$nus.'</option>';
?>
					</select>
        </p>
      </div>
     <div>
        <label class="label" for="nus0324">No Urut Sampel</label>
        <input type="number" onClick="this.select()"  name="nus0324" id="nus0324" required="" ref="nus0324" min="0" value="<?php echo $data['nus0324']; ?>">
      </div>
      
     <div>
        <label class="label" for="krt0324">Nama Kepala Rumah Tanggal</label>
        <input type="text" onClick="this.select()"  name="krt0324" id="krt0324" required="" ref="krt0324" value="<?php echo $data['krt0324']; ?>">
      </div>

      <div>
        <h4>Status Pencacahan</h4>
        <ul class="vue-form-list">
          <li>
            <input type="radio" name="statusc" id="radio-1" value="belum" required <?php echo $cbelum; ?>>
            <label for="radio-1">Belum</label>
          </li>
          <li>
            <input type="radio" name="statusc" id="radio-2" value="sudah" required <?php echo $csudah; ?>>
            <label for="radio-2">Sudah</label>
          </li>
        </ul>
      </div>
      <div class="success">
        <p>Isian diambil dari dokumen VSEN26.K</p>
      </div>
      <div>
        <label class="label" for="p1c">Hasil Pencacahan (Rincian 203)</label>
        <input type="number" onClick="this.select()"  name="p1c" id="p1c" required="" ref="p1c" min=0 value="<?php echo $data['p1c']; ?>">
      </div>

      <div>
        <label class="label" for="p1p">Jumlah ART (Rincian 301)</label>
        <input type="number" onClick="this.select()"  name="p1p" id="p1p" required="" ref="p1p" min=0 value="<?php echo $data['p1p']; ?>">
      </div>
      <div>
        <label class="label" for="pendidikan">Pendidkan KRT (Rincian 615 baris pertama)</label>
        <input type="number" onClick="this.select()"  name="pendidikan" id="pendidikan" required="" ref="pendidikan" min=0 value="<?php echo $data['pendidikan']; ?>">
      </div>      
    <div>
        <h4>Apakah Blok XIX.Catatan Terisi?</h4>
        <ul class="vue-form-list">
                      <li>
            <input type="radio" name="p1k" id="radio-8" value="1" required <?php echo $ksudah; ?>>
            <label for="radio-8">Ya</label>
          </li>
          <li>
            <input type="radio" name="p1k" id="radio-7" value="0" required <?php echo $kbelum; ?>>
            <label for="radio-7">Tidak</label>
          </li>

        </ul>
      </div>
      
      
      <div class="success">
        <p>Isian diambil dari dokumen VSEN26.KP</p>
      </div>

      <div>
        <label class="label" for="p2c">Hasil Pencacahan (Rincian 203)</label>
        <input type="number" onClick="this.select()"  name="p2c" id="p2c" required="" ref="p2c" min=0 value="<?php echo $data['p2c']; ?>">
      </div>
    <div>
        <label class="label" for="p4p">Jumlah Komoditas Bahan Makanan (Rincian 304)</label>
        <input type="number" onClick="this.select()"  name="p4p" id="p4p" required="" ref="p4p" min=0 value="<?php echo $data['p4p']; ?>">
      </div>
      <div>
        <label class="label" for="p5p">Jumlah Komoditas Barang-Barang bukan Makanan (Rincian 305)</label>
        <input type="number" onClick="this.select()"  name="p5p" id="p5p" required="" ref="p5p" min=0 value="<?php echo $data['p5p']; ?>">
      </div>
      <div>
        <label class="label" for="p2p">Pengeluaran Makanan Sebulan(Blok IV.3.2 Rincian 16 kol 5)</label>
        <input type="number" onClick="this.select()"  name="p2p" id="p2p" required="" ref="p2p" min=0 value="<?php echo $data['p2p']; ?>">
      </div>
      <div>
        <label class="label" for="p3p">Pengeluaran Bukan Makanan Sebulan (Blok IV.3.3 Rincian 8 kol 3)</label>
        <input type="number" onClick="this.select()"  name="p3p" id="p3p" required="" ref="p3p" min=0 value="<?php echo $data['p3p']; ?>">
      </div>
      <div>
        <h4>Apakah Blok VIII. Catatan Terisi?</h4>
        <ul class="vue-form-list">
        <li>
            <input type="radio" name="p2k" id="radio-10" value="1" required <?php echo $kpsudah; ?>>
            <label for="radio-10">Ya</label>
          </li>
          <li>
            <input type="radio" name="p2k" id="radio-9" value="0" required <?php echo $kpbelum; ?>>
            <label for="radio-9">Tidak</label>
          </li>
        </ul>
      </div>
      <div>
          <input type="hidden" name="nama" value="<?php echo $nama; ?>">
      <input type="submit" name="submit" value="Kirim">
      </div>
      
    </fieldset>
  </form>

</div>

</body>

</html>