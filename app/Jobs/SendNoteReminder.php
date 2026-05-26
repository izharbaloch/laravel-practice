<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendNoteReminder implements ShouldQueue
{
    use Queueable;
    public $note;

    /**
     * Create a new job instance.
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Sending reminder for Note ID: ' . $this->note->id . ' with title: ' . $this->note->title);
    }
}
