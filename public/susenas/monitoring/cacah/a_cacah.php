<?php

/**
 * Action handler for updating cacah data.
 */

require_once dirname(__DIR__, 4).'/app/Helpers/database.php';

// Get and sanitize POST data
$input = filter_input_array(INPUT_POST);

if (! $input) {
    redirect('dcacah.php', 'Invalid request');
}

// Sanitize all inputs
$nks = sanitizeInput($input['nks']);
$nus = sanitizeInput($input['nus']);
$statusc = sanitizeInput($input['statusc']);
$p1c = sanitizeInput($input['p1c']);
$p2c = sanitizeInput($input['p2c']);
$p1p = sanitizeInput($input['p1p']);
$p2p = sanitizeInput($input['p2p']);
$p3p = sanitizeInput($input['p3p']);
$p4p = sanitizeInput($input['p4p']);
$p5p = sanitizeInput($input['p5p']);
$p1k = sanitizeInput($input['p1k']);
$p2k = sanitizeInput($input['p2k']);
$pendidikan = sanitizeInput($input['pendidikan']);
$nus0324 = sanitizeInput($input['nus0324']);
$krt0324 = sanitizeInput($input['krt0324']);
$nama = sanitizeInput($input['nama']);

// Prepare and execute query using prepared statements
$query = 'UPDATE cacah SET 
    statusc = ?, p1c = ?, p2c = ?, p1p = ?, p2p = ?, p3p = ?, p4p = ?, 
    nus0324 = ?, krt0324 = ?, p5p = ?, p1k = ?, p2k = ?, pendidikan = ?
    WHERE nks = ? AND nus = ?';

try {
    $conn = getDbConnection();
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssssssssss',
        $statusc, $p1c, $p2c, $p1p, $p2p, $p3p, $p4p,
        $nus0324, $krt0324, $p5p, $p1k, $p2k, $pendidikan, $nks, $nus
    );
    mysqli_stmt_execute($stmt);

    redirect("dcacah.php?nama=$nama&nks=$nks", "NKS $nks nomor sampel $nus berhasil diupdate");
} catch (Exception $e) {
    redirect("dcacah.php?nama=$nama&nks=$nks", 'Error: '.$e->getMessage());
}
