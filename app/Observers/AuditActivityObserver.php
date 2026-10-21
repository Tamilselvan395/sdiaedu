<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditActivityObserver
{
    /**
     * Models/fields to ignore from logging.
     */
    protected array $ignoredFields = [
        'updated_at',
        'password',
        'remember_token',
    ];

    public function created(Model $model): void
    {
        if ($model instanceof ActivityLog || ! Auth::check()) {
            return;
        }

        $label = $this->getModelLabel($model);

        ActivityLogger::log(
            action: 'created',
            description: "Created {$label}",
            subject: $model,
            properties: [
                'attributes' => $this->sanitize($model->getAttributes()),
            ]
        );
    }

    public function updated(Model $model): void
    {
        if ($model instanceof ActivityLog || ! Auth::check()) {
            return;
        }

        $changes = $model->getChanges();
        foreach ($this->ignoredFields as $field) {
            unset($changes[$field]);
        }

        if (empty($changes)) {
            return;
        }

        $label = $this->getModelLabel($model);
        $original = [];
        foreach (array_keys($changes) as $key) {
            $original[$key] = $model->getOriginal($key);
        }

        ActivityLogger::log(
            action: 'updated',
            description: "Updated {$label}",
            subject: $model,
            properties: [
                'changes' => $this->sanitize($changes),
                'original' => $this->sanitize($original),
            ]
        );
    }

    public function deleted(Model $model): void
    {
        if ($model instanceof ActivityLog || ! Auth::check()) {
            return;
        }

        $label = $this->getModelLabel($model);

        ActivityLogger::log(
            action: 'deleted',
            description: "Deleted {$label}",
            subject: $model,
            properties: [
                'attributes' => $this->sanitize($model->getAttributes()),
            ]
        );
    }

    protected function getModelLabel(Model $model): string
    {
        $classBasename = class_basename($model);
        $identifier = $model->getAttribute('name')
            ?? $model->getAttribute('title')
            ?? $model->getAttribute('parent_name')
            ?? $model->getAttribute('student_name')
            ?? $model->getAttribute('email')
            ?? $model->getAttribute('key')
            ?? "#{$model->getKey()}";

        return "{$classBasename}: {$identifier}";
    }

    protected function sanitize(array $data): array
    {
        foreach ($this->ignoredFields as $field) {
            unset($data[$field]);
        }

        return $data;
    }
}
