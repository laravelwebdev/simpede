<?php
/**
 * Panel index page
 */

require_once dirname(__DIR__, 3).'/app/Helpers/database.php';

try {
    $conn = getDbConnection();
    $query = 'SELECT DISTINCT nks FROM art ORDER BY nks ASC';
    $result = mysqli_query($conn, $query);
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
        <td><div class="blue">
          <p>Detail</p>
        </div></td>
      </tr>
      <?php
           while ($row = mysqli_fetch_array($result)) {

               echo '<tr>
        <td><label class="label-result">'.$row['nks'].'</label></td>
        <td><div class="blue">
          <p><a href="nks.php?nks='.$row['nks'].'">Detail</a></p>
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