<?php
/**
 * Monitoring updating evaluasi page
 */

require_once dirname(__DIR__, 4).'/app/Helpers/database.php';

date_default_timezone_set('Asia/Makassar');

try {
    $conn = getDbConnection();
    $query = "SELECT nks, pcl, pml, (p2c-p1c) as selisih, ROUND(100*(p2c-p1c)/p1c, 2) as persen FROM updating WHERE statusc='sudah' ORDER BY nks ASC";
    $result = mysqli_query($conn, $query);
} catch (Exception $e) {
    exit('Database error: '.$e->getMessage());
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
  <form class="vue-form" @submit.prevent="submit">
    <div class="blue-message">
      <p>EVALUASI PENDATAAN</p>
    </div>

    <fieldset>
      <div class="success">
      <p>Pemutakhiran (Perubahan Jumlah KK)</p>
    </div>
    <table>
      <tr>
        <td><div class="success">
          <p>NKS</p>
        </div></td>
        <td colspan="2"><div class="success">
          <p>PCL</p>
        </div></td>
        <!--<td><div class="success">-->
        <!--  <p>Selisih</p>-->
        <!--</div></td>-->
        <td><div class="success">
          <p>Persen</p>
        </div></td>
      </tr>
      <?php
           while ($row = mysqli_fetch_array($result)) {
               echo '<tr>
        <td><label class="label-result">'.$row['nks'].'</label></td>
        <td colspan="2"><label class="label-result">'.$row['pcl'].'</label></td>
       
        <td class="right"><label class="label-result">'.$row['persen'].'</label></td>
       
      </tr>
      ';
           }
?>
          </table>
    </fieldset>
  </form>

</div>

</body>

</html>