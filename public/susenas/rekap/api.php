<?php

/**
 * API handler for saving cacah data.
 */

require_once dirname(__DIR__, 3).'/app/Helpers/database.php';

// Get and sanitize POST data
if (! isset($_POST['nks']) || ! isset($_POST['nus'])) {
    exit("<script type='text/javascript'>alert('Invalid request'); history.back();</script>");
}

$nks = sanitizeInput($_POST['nks']);
$nus = sanitizeInput($_POST['nus']);
$makanan = sanitizeInput($_POST['makanan']);
$nonmakanan = sanitizeInput($_POST['nonmakanan']);
$data = json_encode($_POST);

// Prepare and execute query
$query = 'UPDATE cacah SET data = ?, p2p = ?, p3p = ? WHERE nks = ? AND nus = ?';

try {
    $conn = getDbConnection();
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssss', $data, $makanan, $nonmakanan, $nks, $nus);
    mysqli_stmt_execute($stmt);

    echo "<script type='text/javascript'>alert('NKS $nks nomor sampel $nus berhasil simpan'); document.referrer ? window.location = document.referrer : history.back();</script>";
} catch (Exception $e) {
    echo "<script type='text/javascript'>alert('Error: ".addslashes($e->getMessage())."'); history.back();</script>";
}
