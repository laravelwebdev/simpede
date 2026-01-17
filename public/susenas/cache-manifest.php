<?php

header('Content-Type: application/javascript');

$baseUrl = '/susenas';
$root = __DIR__;

$files = [
    "$baseUrl/bpjs.php",
    "$baseUrl/imunisasi.php",
    "$baseUrl/kesehatan.php",
    "$baseUrl/konsistensi.php",
    "$baseUrl/konversi.php",
    "$baseUrl/listrik.php",
    "$baseUrl/oop.php",
    "$baseUrl/pbb.php",
    "$baseUrl/menu.php",
    "$baseUrl/pdam.php",
    "$baseUrl/pph.php",
    "$baseUrl/r502.php",
    "$baseUrl/sekolah.php",
    "$baseUrl/stnk.php",
    "$baseUrl/version.php",
    "$baseUrl/makanan.php",
    "$baseUrl/sw.js",
    "$baseUrl/eval.php",
    "$baseUrl/monitoring/index.php",
];

function scan($dir, $baseUrl)
{
    $out = [];
    $it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir)
    );

    foreach ($it as $file) {
        if ($file->isDir()) {
            continue;
        }
        $path = str_replace(__DIR__, '', $file->getPathname());
        $out[] = $baseUrl.$path;
    }

    return $out;
}

foreach (['js', 'css', 'fonts'] as $dir) {
    if (is_dir("$root/$dir")) {
        $files = array_merge($files, scan("$root/$dir", $baseUrl));
    }
}

$version = md5(json_encode($files));

echo "self.CACHE_VERSION = '$version';\n";
echo 'self.FILES_TO_CACHE = '.json_encode(array_values(array_unique($files))).";\n";
