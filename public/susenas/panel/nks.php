<?php
/**
 * Panel NKS page
 */

require_once dirname(__DIR__, 3).'/app/Helpers/database.php';

if (! isset($_GET['nks'])) {
    header('Location:index.php');
    exit;
}

try {
    $conn = getDbConnection();
    $nks = sanitizeInput($_GET['nks']);

    $query = 'SELECT DISTINCT nks, r109 as nus, krt FROM art WHERE nks = ? ORDER BY nus ASC';
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $nks);
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
  <title>Data Susenas Maret 2023</title>
  <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  <meta content="utf-8" http-equiv="encoding">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../rekap/style.css">  
</head>

<body>
  <div id="app">
  <form class="vue-form" @submit.prevent="submit">
    <div class="blue-message">
      <p>DATA SUSENAS MARET 2023</p>
    </div>

    <fieldset>

    <table>
      <tr>
        <td><div class="success">
          <p>NKS</p>
        </div></td>
        <td><div class="success">
          <p>NUS 2023</p>
        </div></td>
        <td><div class="success">
          <p>KRT</p>
        </div></td>
        <td><div class="blue">
          <p>Detail</p>
        </div></td>
      </tr>
      <?php
           while ($row = mysqli_fetch_array($result)) {

               echo '<tr>
        <td><label class="label-result">'.$row['nks'].'</label></td>
        <td><label class="label-result">'.sprintf('%02d', $row['nus']).'</label></td>
        <td><label class="label-result">'.$row['krt'].'</label></td>
        <td><div class="blue">
          <p><a href="sampel.php?nks='.$row['nks'].'&nus='.$row['nus'].'">Detail</a></p>
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