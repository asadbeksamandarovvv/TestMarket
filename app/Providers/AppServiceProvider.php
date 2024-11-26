<?php

namespace App\Providers;

use App\Events\AttachmentDestroyEvent;
use App\Listeners\AttachmentDestroyListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\Spatie\Permission\PermissionServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            AttachmentDestroyEvent::class,
            AttachmentDestroyListener::class,
        );
    }
}
