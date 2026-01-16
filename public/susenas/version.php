<?php
require_once dirname(__DIR__, 2).'/app/Helpers/database.php';
date_default_timezone_set('Asia/Makassar');

$conn = getDbConnection();

$queryVersion = 'SELECT version FROM susenas_settings LIMIT 1';
$resultVersion = mysqli_query($conn, $queryVersion);
$version = mysqli_fetch_assoc($resultVersion)['version'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Version</title>
</head>
<body>
	<script type="text/javascript">
		alert('Aplikasi iSusenas\nVersi <?php echo $version; ?>\nCreated by Muhlis Abdi');
		window.history.back();
	</script>
</body>
</html>