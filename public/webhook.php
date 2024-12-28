<?php

// Mengatur header konten sebagai JSON
header('Content-Type: application/json; charset=utf-8');

// Memuat autoloader Composer
require __DIR__.'/../vendor/autoload.php';

// Memuat aplikasi Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// Membuat instance kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Menangani request
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

// Mengakses konfigurasi Laravel
$config = $app['config'];

// Koneksi ke database menggunakan konfigurasi Laravel
$connection = $config->get('database.default');
$dbConfig = $config->get("database.connections.$connection");

// Membuat koneksi database menggunakan konfigurasi Laravel
$conn = new mysqli(
    $dbConfig['host'],
    $dbConfig['username'],
    $dbConfig['password'],
    $dbConfig['database']
);

// Cek koneksi
if ($conn->connect_error) {
    echo json_encode(['error' => 'Failed to connect to MySQL: '.$conn->connect_error]);
    exit();
}

// Mendapatkan data JSON dari input
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validasi data
if (isset($data['id']) && isset($data['status'])) {
    $id = $data['id'];
    $status = $data['status'];

    // Menggunakan prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare('UPDATE daftar_reminders SET status = ? WHERE message_id = ?');
    $stmt->bind_param('ss', $status, $id);

    // Eksekusi query
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
    } else {
        echo json_encode(['error' => 'Failed to update status']);
    }

    // Menutup statement
    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid input']);
}

// Menutup koneksi
$conn->close();

// Mengakhiri request
$kernel->terminate($request, $response);
