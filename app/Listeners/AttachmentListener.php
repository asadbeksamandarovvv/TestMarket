<?php

namespace App\Listeners;

use App\Events\AttachmentEvent;
use App\Services\AttachmentService;

class AttachmentListener
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
    public function handle(AttachmentEvent $event): void
    {
        $this->service->uploadFile(
            \Arr::wrap($event->files),
            $event->relation,
            $event->path,
            $event->identifier
        );
    }
}
