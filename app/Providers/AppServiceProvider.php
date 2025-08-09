<?php

namespace App\Providers;

use Exception;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Masbug\Flysystem\GoogleDriveAdapter;
use Sentry\Laravel\Facades\Sentry;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            $message = "Lazy loading violation: Attempted to access [{$relation}] on model [".get_class($model).'].';

            // Report to Sentry
            Sentry::captureMessage($message);
        });
        $this->loadGoogleStorageDriver();
    }

    private function loadGoogleStorageDriver(string $driverName = 'google')
    {
        try {
            Storage::extend($driverName, function ($app, $config) {
                $options = [];

                if (! empty($config['teamDriveId'] ?? null)) {
                    $options['teamDriveId'] = $config['teamDriveId'];
                }

                $client = new Client;
                $client->setClientId($config['clientId']);
                $client->setClientSecret($config['clientSecret']);
                $client->refreshToken($config['refreshToken']);

                $service = new Drive($client);
                $adapter = new GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
                $driver = new Filesystem($adapter);

                return new FilesystemAdapter($driver, $adapter);
            });
        } catch (Exception $e) {
            // your exception handling logic
        }
    }
}
