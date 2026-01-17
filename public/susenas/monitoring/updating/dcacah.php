<?php
/**
 * Monitoring updating detail cacah page
 */

require_once dirname(__DIR__, 4).'/app/Helpers/database.php';

if (! isset($_GET['nama'])) {
    header('Location:index.php');
    exit;
}

try {
    $conn = getDbConnection();
    $nama = sanitizeInput($_GET['nama']);

    $query = 'SELECT nks, statusc FROM updating WHERE kode_pcl = ? ORDER BY nks ASC';
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $nama);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
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
      <p>Pemutakhiran</p>
    </div>
    <table>
      <tr>
        <td><div class="success">
          <p>NKS</p>
        </div></td>
        <td><div class="success">
          <p>Status</p>
        </div></td>
        <td><div class="success">
          <p>Aksi</p>
        </div></td>
      </tr>
      <?php
           while ($row = mysqli_fetch_array($result)) {

               echo '<tr>
        <td><label class="label-result">'.$row['nks'].'</label></td>
        <td><label class="label-result">'.$row['statusc'].'</label></td>
        <td><div class="blue">
          <p><a href="cacah.php?nks='.$row['nks'].'&nama='.$nama.'">Ubah</a></p>
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