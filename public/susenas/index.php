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

<style>
*{box-sizing:border-box;font-family:Segoe UI,Roboto,sans-serif}
body{
    margin:0;
    padding:12px;
    background:#f4f6f8;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
    Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial,
    sans-serif;
}

/* GRID 2 KOLOM */
.row{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:12px;
}

/* TILE */
.card{
    position:relative;
    height:102px;
    border-radius:8px;
    padding:12px;
    color:#fff;
    overflow:hidden;
    box-shadow:0 8px 18px rgba(0,0,0,.25);
}

/* TEXT */
.card h3{
    position:absolute;
    left:12px;
    bottom:12px;
    margin:0;
    font-size:13px;
    font-weight:500;
    z-index:2;
}

/* ICON IMAGE BESAR */
.card img{
    position:absolute;
    right:-28px;
    top:50%;
    transform:translateY(-50%);
    width:78px;
    height:78px;
    object-fit:contain;
    opacity:.25;
    z-index:1;
}

a{text-decoration:none}

/* RESPONSIVE TABLET */
@media(min-width:768px){
    .row{grid-template-columns:repeat(3,1fr)}
}
</style>
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
