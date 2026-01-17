<?php
/**
 * Rekap index page
 */

require_once dirname(__DIR__, 2).'/app/Helpers/database.php';

date_default_timezone_set('Asia/Makassar');

try {
    $conn = getDbConnection();

    $queryKonv = '
        SELECT
            no_urut,
            nama,
            satuan,
            harga1,
            harga2,
            fixed
        FROM rentang_harga
        ORDER BY no_urut ASC
    ';

    $resultKonv = mysqli_query($conn, $queryKonv);

    if (! $resultKonv) {
        throw new Exception('Query konversi gagal');
    }

    $konvs = [];
    while ($row = mysqli_fetch_assoc($resultKonv)) {
        $row['no_urut'] = (int) $row['no_urut'];
        $row['harga1'] = (int) $row['harga1'];
        $row['harga2'] = (int) $row['harga2'];
        $row['fixed'] = (int) $row['fixed'];
        $konvs[] = $row;
    }

} catch (Exception $e) {
    exit('Database error');
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
  <link rel="stylesheet" href="css/style.css">  
</head>

<body>
  <div id="app">
    <form class="vue-form" @submit.prevent="submit">
      <div class="error-message">
        <p>Kuantitas Makanan</p>
      </div>

      <fieldset>

        <div>
          <h4>Jenis Bahan Makanan</h4>
          <vue-single-select
            v-model="konv"
            :options="konvs"
            option-key="no_urut"
            option-label="nama" 
            placeholder="Ketik Nomor Urut/Nama Komoditas" 
            :required="true">
          </vue-single-select>
        </div>

        <div>
          <label class="label" for="harga">Harga Konsumsi (Rp.)</label>
          <currency inputmode="numeric"
            v-model="harga"
            name="harga"
            id="harga"
            required
            ref="harga"
            onClick="this.select()">
          </currency>
        </div>

        <span v-show="konv!=null">
          <table>
            <tr>
              <td colspan="2">
                <div class="success">
                  <p>{{ komoditas }}</p>
                </div>
              </td>
            </tr>
            <tr>
              <td><label class="label-result">Rentang Kuantitas: </label></td>
              <td class="right"><label class="label-result">min : {{ q2 }}</label></td>
            </tr>
            <tr>
              <td></td>
              <td class="right"><label class="label-result">max : {{ q1 }}</label></td>
            </tr>
          </table>
        </span>

      </fieldset>
    </form>
  </div>

  <script src="js/vue.min.js"></script>
  <script src="js/select.js"></script>
  <script src="js/currency.js"></script>

  <!-- ✅ SCRIPT EMBED DARI PHP -->
  <script>
    window.APP_DATA = Object.freeze({
      konvs: <?= json_encode($konvs, JSON_UNESCAPED_UNICODE); ?>
    })
  </script>

  <script src="js/makanan.js"></script> 
</body>
</html>
