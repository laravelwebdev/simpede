<?php
require_once dirname(__DIR__, 2).'/app/Helpers/database.php';
date_default_timezone_set('Asia/Makassar');

$conn = getDbConnection();

$queryVersion = 'SELECT version FROM susenas_settings LIMIT 1';
$resultVersion = mysqli_query($conn, $queryVersion);
$version = mysqli_fetch_assoc($resultVersion)['version'];

$queryFitur = 'SELECT * FROM susenas_fiturs WHERE is_active = 1';
$resultFitur = mysqli_query($conn, $queryFitur);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/menu.css">  
</head>
<body>

<div class="row">
<?php
$colors = [
    '#A4C400', '#60A917', '#008A00', '#00ABA9', '#1BA1E2',
    '#0050EF', '#6A00FF', '#AA00FF', '#F472D0', '#D80073',
    '#A20025', '#E51400', '#FA6800', '#F0A30A', '#E3C800',
];
$i = 0;

while ($row = mysqli_fetch_assoc($resultFitur)) {
    $bg = $colors[$i++ % count($colors)];
    ?>
<a href="<?= $row['path'] ?>">
    <div class="card" style="background:<?= $bg ?>">
        <h3><?= htmlspecialchars($row['nama_fitur']) ?></h3>
        <img src="<?= $row['image'] ?>" alt="">
    </div>
</a>
<?php } ?>
</div>

</body>
</html>
