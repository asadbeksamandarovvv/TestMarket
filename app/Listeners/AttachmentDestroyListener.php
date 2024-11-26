<?php

namespace App\Listeners;

use App\Events\AttachmentDestroyEvent;
use App\Services\AttachmentService;

class AttachmentDestroyListener
{
    /**
     * Create the event listener.
     */
    public function __construct(protected AttachmentService $service)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AttachmentDestroyEvent $event): void
    {
        $this->service->destroy($event->files);
    }
}
