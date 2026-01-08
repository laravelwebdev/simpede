<?php

namespace App\Console\Commands;

use App\Models\SusenasSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class SusenasInit extends Command
{
    protected $signature = 'simpede:susenas';

    protected $description = 'Generate database configuration helper for Susenas module';

    public function handle()
    {
        if (! SusenasSetting::query()->exists()) {
            SusenasSetting::create(['version' => '2024.1']);
        }
        $db = Config::get('database.connections.mysql');

        if (! $db) {
            $this->error('MySQL configuration not found.');

            return 1;
        }

        $content = <<<PHP
<?php

/**
 * Database Configuration
 * AUTO-GENERATED FROM LARAVEL CONFIG
 * DO NOT EDIT MANUALLY
 */

define('DB_HOST', '{$db['host']}');
define('DB_USER', '{$db['username']}');
define('DB_PASS', '{$db['password']}');
define('DB_NAME', '{$db['database']}');

function getDbConnection()
{
    static \$connection = null;

    if (\$connection === null) {
        \$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (! \$connection) {
            throw new Exception('Database connection failed: ' . mysqli_connect_error());
        }

        mysqli_set_charset(\$connection, 'utf8mb4');
    }

    return \$connection;
}

function executeQuery(\$query, \$params = [], \$types = '')
{
    \$conn = getDbConnection();
    \$stmt = mysqli_prepare(\$conn, \$query);

    if (! \$stmt) {
        throw new Exception('Query preparation failed: ' . mysqli_error(\$conn));
    }

    if (! empty(\$params) && ! empty(\$types)) {
        mysqli_stmt_bind_param(\$stmt, \$types, ...\$params);
    }

    mysqli_stmt_execute(\$stmt);
    \$result = mysqli_stmt_get_result(\$stmt);

    return \$result !== false ? \$result : true;
}

function sanitizeInput(\$data)
{
    if (is_array(\$data)) {
        return array_map('sanitizeInput', \$data);
    }

    return htmlspecialchars(strip_tags(trim(\$data)), ENT_QUOTES, 'UTF-8');
}

function redirect(\$url, \$message = '')
{
    if (! empty(\$message)) {
        echo "<script>alert('" . addslashes(\$message) . "');</script>";
    }
    echo "<script>window.location.replace('{\$url}');</script>";
    exit;
}

PHP;

        $path = app_path('Helpers/database.php');

        File::ensureDirectoryExists(dirname($path));
        File::put($path, $content);

        $this->info('Database helper generated: app/Helpers/database.php');

        return 0;
    }
}
