<?php
/**
 * Panel sampel page
 */

require_once dirname(__DIR__, 3).'/app/Helpers/database.php';

if (! isset($_GET['nks']) || ! isset($_GET['nus'])) {
    header('Location:index.php');
    exit;
}

date_default_timezone_set('Asia/Makassar');

try {
    $conn = getDbConnection();
    $nks = sanitizeInput($_GET['nks']);
    $nus = sanitizeInput($_GET['nus']);

    $query2 = 'SELECT * FROM art WHERE nks = ? AND r109 = ? ORDER BY r109, r401 ASC';
    $stmt = mysqli_prepare($conn, $query2);
    mysqli_stmt_bind_param($stmt, 'ss', $nks, $nus);

    mysqli_stmt_execute($stmt);
    $result2 = mysqli_stmt_get_result($stmt);

    mysqli_stmt_execute($stmt);
    $result3 = mysqli_stmt_get_result($stmt);

    mysqli_stmt_execute($stmt);
    $result4 = mysqli_stmt_get_result($stmt);

    mysqli_stmt_execute($stmt);
    $result5 = mysqli_stmt_get_result($stmt);
} catch (Exception $e) {
    exit('Database error: '.$e->getMessage());
}
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Data Susenas Maret 2023</title>
  <meta name="description" content="DATA SERUTI TW 3">
  <meta name="author" content="SitePoint">
  <style>
      * {
  font-family: sans-serif; /* Change your font family */
}

.content-table {
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.9em;
  min-width: 400px;
  border-radius: 5px 5px 0 0;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.content-table thead tr {
  background-color: #009879;
  color: #ffffff;
  text-align: left;
  font-weight: bold;
}

.content-table th,
.content-table td {
  padding: 12px 15px;
}

.content-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.content-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.content-table tbody tr:last-of-type {
  border-bottom: 2px solid #009879;
}

.content-table tbody tr.active-row {
  font-weight: bold;
  color: #009879;
}
.headcol {
  position: absolute;
}

  </style>
 </head>

<body>
    <h2>Keterangan Anggota Rumah Tangga</h2>
    <h3>Blok IV</h3>
    <div style="overflow-x:scroll;">

    <table class="content-table">
        <thead>
            <tr>
<th>r401</th>
<th>r402</th>
<th>r403</th>
<th>r404</th>
<th>r405</th>
<th>r406a</th>
<th>r406b</th>
<th>r406c</th>
<th>r407</th>
<th>r408</th>
<th>r409</th>

           </tr>

        </thead>
        <tbody>
            <?php
                 while ($row2 = mysqli_fetch_array($result2)) {
                     echo '<tr>
<td>'.$row2['r401'].'</td>
<td>'.$row2['r402'].'</td>
<td>'.$row2['r403'].'</td>
<td>'.$row2['r404'].'</td>
<td>'.$row2['r405'].'</td>
<td>'.$row2['r406a'].'</td>
<td>'.$row2['r406b'].'</td>
<td>'.$row2['r406c'].'</td>
<td>'.$row2['r407'].'</td>
<td>'.$row2['r408'].'</td>
<td>'.$row2['r409'].'</td>

                    </tr>';
                 }
?>
        </tbody>
    </table>
</div>

<h3>Blok V</h3>
    <div style="overflow-x:scroll;">

    <table class="content-table">
        <thead>
            <tr>
<th>r401</th>
<th>r402</th>
<th>r505</th>

           </tr>

        </thead>
        <tbody>
            <?php
while ($row3 = mysqli_fetch_array($result3)) {
    echo '<tr>
<td>'.$row3['r401'].'</td>
<td>'.$row3['r402'].'</td>
<td>'.$row3['r505'].'</td>
                    </tr>';
}
?>
        </tbody>
    </table>
</div>

<h3>Blok VI</h3>
    <div style="overflow-x:scroll;">

    <table class="content-table">
        <thead>
            <tr>
<th>r401</th>
<th>r402</th>
<th>r610</th>
<th>r611</th>
<th>r612</th>
<th>r613</th>
<th>r614</th>
<th>r615</th>
           </tr>

        </thead>
        <tbody>
            <?php
while ($row4 = mysqli_fetch_array($result4)) {
    echo '<tr>
<td>'.$row4['r401'].'</td>
<td>'.$row4['r402'].'</td>
<td>'.$row4['r610'].'</td>
<td>'.$row4['r611'].'</td>
<td>'.$row4['r612'].'</td>
<td>'.$row4['r613'].'</td>
<td>'.$row4['r614'].'</td>
<td>'.$row4['r615'].'</td>
                    </tr>';
}
?>
        </tbody>
    </table>
</div>
<h2>Isian PML untuk rincian r400</h2>
    <div style="overflow-x:scroll;">

    <table class="content-table">
        <thead>
            <tr>
<th>r401</th>
<th>r402</th>
<th>r400</th>

           </tr>

        </thead>
        <tbody>
            <?php
while ($row5 = mysqli_fetch_array($result5)) {
    echo '<tr>
<td>'.$row5['r401'].'</td>
<td>'.$row5['r402'].'</td>
<td>'.$row5['r400'].'</td>


                    </tr>';
}
?>
        </tbody>
    </table>
</div>
</body>
</html>