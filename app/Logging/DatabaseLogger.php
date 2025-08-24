<?php

namespace App\Logging;

use App\Models\ErrorLog;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

class DatabaseLogger extends AbstractProcessingHandler
{
    public function __construct()
    {
        $envLevel = config('logging.channels.database.level', env('LOG_LEVEL', 'warning'));
        parent::__construct(Logger::toMonologLevel($envLevel));
    }

    protected function write(LogRecord $record): void
    {
        $message = $record->message;
        $level = $record->level->getName();
        $context = $record->context;

        $file = null;
        $line = null;

        $e = null;

        if (isset($context['exception']) && $context['exception'] instanceof \Throwable) {
            $e = $context['exception'];
            $trace = $e->getTrace();

            // cari yang pertama dari /app/
            $topAppTrace = collect($trace)->first(fn ($t) => isset($t['file']) && str_contains($t['file'], '/app/') && ! str_contains($t['file'], '/app/public/'));

            if ($topAppTrace) {
                $file = $topAppTrace['file'];
                $line = $topAppTrace['line'];
            } else {
                // fallback ke file & line utama exception
                $file = $e->getFile();
                $line = $e->getLine();
            }

        }

        // Cek duplikat log
        $existing = ErrorLog::where('message', $message)
            ->where('level', $level)
            ->where('file', $file)
            ->where('line', $line)
            ->where('resolved', false)
            ->latest('id')
            ->first();

        if ($existing) {
            $existing->increment('count');
            $existing->touch();
        } else {
            ErrorLog::create([
                'message' => $message,
                'context' => $e ? get_class($e) : 'System Log',
                'level' => $level,
                'file' => $file ? $this->pathToClass($file) : null,
                'line' => $line,
                'resolved' => false,
                'count' => 1,
            ]);
        }
    }

    private function pathToClass(string $path): ?string
    {
        $appPath = realpath(app_path());
        $path = realpath($path);

        if (! str_starts_with($path, $appPath)) {
            return $path; // file bukan di dalam app/
        }

        $relative = str_replace($appPath.DIRECTORY_SEPARATOR, '', $path);
        $withoutExt = preg_replace('/\.php$/', '', $relative);

        return 'App\\'.str_replace(DIRECTORY_SEPARATOR, '\\', $withoutExt);
    }
}
