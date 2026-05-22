<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Note;

class NoteObserver
{
    public function created(Note $note): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'created',
            'model_type' => Note::class,
            'model_id' => $note->id,
            'new_values' => $note->toArray(),
        ]);
    }

    public function updated(Note $note): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'model_type' => Note::class,
            'model_id' => $note->id,
            'old_values' => $note->getOriginal(),
            'new_values' => $note->getChanges(),
        ]);
    }

    // Soft delete (Trash)
    public function deleted(Note $note): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'trashed',
            'model_type' => Note::class,
            'model_id' => $note->id,
            'old_values' => $note->toArray(),
        ]);
    }

    // Restore from trash
    public function restored(Note $note): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'restored',
            'model_type' => Note::class,
            'model_id' => $note->id,
            'new_values' => $note->toArray(),
        ]);
    }

    // 🔥 IMPORTANT: Permanent delete
    public function deleting(Note $note): void
    {
        // agar force delete ho raha hai
        if ($note->isForceDeleting()) {

            // pehle logs delete karo
            $note->activityLogs()->delete();
        }
    }

    public function forceDeleted(Note $note): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'deleted',
            'model_type' => Note::class,
            'model_id' => $note->id,
            'old_values' => $note->toArray(),
        ]);
    }
}
