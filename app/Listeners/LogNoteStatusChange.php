<?php

namespace App\Listeners;

use App\Events\NoteStatusChanged;
use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogNoteStatusChange
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NoteStatusChanged $event): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'status_changed',
            'model_type' => \App\Models\Note::class,
            'model_id' => $event->note->id,
            'old_values' => [
                'status' => $event->oldStatus
            ],
            'new_values' => [
                'status' => $event->newStatus
            ],
        ]);
    }
}
