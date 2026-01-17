<?php
/**
 * Main index page for monitoring cacah
 */

require_once dirname(__DIR__, 4).'/app/Helpers/database.php';

date_default_timezone_set('Asia/Makassar');

try {
    $conn = getDbConnection();

    $query = "SELECT kode_pcl, pcl, SUM(CASE WHEN statusc='sudah' THEN 1 ELSE 0 END) AS sudah, count(statusc) as total from cacah GROUP BY pcl ORDER BY sudah DESC";
    $result = mysqli_query($conn, $query);

    $qtotal = "SELECT prov FROM cacah WHERE statusc='sudah'";
    $rtotal = mysqli_query($conn, $qtotal);
    $total = mysqli_num_rows($rtotal);

    $qsampel = 'SELECT id from cacah';
    $rsampel = mysqli_query($conn, $qsampel);
    $sampel = mysqli_num_rows($rsampel);

} catch (Exception $e) {
    exit('Database error: '.$e->getMessage());
}

$qpml = "SELECT pml, SUM(CASE WHEN statusc='sudah' THEN 1 ELSE 0 END) AS sudah, count(statusc) as total from cacah GROUP BY pml ORDER BY sudah DESC";
$rpml = mysqli_query($conn, $qpml);

?>

<!DOCTYPE html>
<html lang='en' class=''>

<head>
  <meta charset='UTF-8'>
  <title>iSusenas</title>
  <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  <meta content="utf-8" http-equiv="encoding">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../css/style.css">  
</head>

<body>
  <div id="app">
  <form class="vue-form" @submit.prevent="submit">
    <div class="blue-message">
      <p>PROGRESS PENDATAAN</p>
    </div>

    <fieldset>
      <div class="success">
      <p>Per PCL</p>
    </div>
    <table>
      <tr>
        <td><div class="success">
          <p>Nama PCL</p>
        </div></td>
        <td class="td-small"><div class="success">
          <p>Progress</p>
        </div></td>
        <td class="td-small"><div class="success">
          <p>Aksi</p>
        </div></td>
      </tr>
      <?php
           while ($row = mysqli_fetch_array($result)) {
               $colorc = 'blue';

               echo '<tr>
        <td><label class="label-result">'.$row['pcl'].'</label></td>
        <td><div class="'.$colorc.'"><p>'.$row['sudah'].'/'.$row['total'].'</p></div></td>
        <td><div class="blue">
          <p><a href="index2.php?nama='.$row['kode_pcl'].'">Lihat</a></p>
        </div></td>
      </tr>
      ';
           }
?>
      <tr>
        <td><label class="label-result">TOTAL</label></td>
        <td><div class="success">
          <p><?php echo $total; ?></p>
        </div></td>
        <td><div class="success">
          <p><?php echo $sampel > 0 ? round(100 * $total / $sampel, 2).'%' : '0%'; ?></p>
        </div></td>
      </tr>
     
      </table>

      <div class="warning">
        <p>Per PML</p>
      </div>

      <table>
        <tr>
          <td colspan="3"><div class="warning">
            <p>Nama PML</p>
          </div></td>
          <td><div class="warning">
            <p>Progress</p>
          </div></td>          
        </tr>
      <?php
      while ($rowpml = mysqli_fetch_array($rpml)) {
          $colork = 'blue';
          echo '<tr>
        <td colspan="3"><label class="label-result">'.$rowpml['pml'].'</label></td>
        <td class="right"><div class="'.$colork.'"><p>'.$rowpml['sudah'].'/'.$rowpml['total'].'</p></div></td>

      </tr>
      ';
      }
?>

        <tr>
          <td colspan="3"><div class="warning">
            <p>TOTAL</p>
          </div></td>
          <td><div class="warning">
            <p><?php echo $total; ?></p>
          </div></td>          
        </tr>
        </table>

    </fieldset>
  </form>

</div>

</body>

</html>