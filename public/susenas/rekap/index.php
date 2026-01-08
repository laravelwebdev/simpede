<?php
/**
 * Rekap index page
 */

require_once dirname(__DIR__, 3).'/app/Helpers/database.php';

date_default_timezone_set('Asia/Makassar');

try {
    $conn = getDbConnection();
    $query = 'SELECT DISTINCT kode_pcl,pcl FROM cacah ORDER BY pcl ASC';
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
      <p>REKAPITULASI</p>
    </div>

    <fieldset>
    <table>
      <tr>
        <td><div class="success">
          <p>Nama PCL</p>
        </div></td>
        <td><div class="success">
          <p>Rekap</p>
        </div></td>
      </tr>
      <?php
           while ($row = mysqli_fetch_array($result)) {

               echo '<tr>
        <td><label class="label-result">'.$row['pcl'].'</label></td>
        <td><div class="blue">
          <p><a href="dcacah.php?nama='.$row['kode_pcl'].'">Rekap</a></p>
        </div></td>
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