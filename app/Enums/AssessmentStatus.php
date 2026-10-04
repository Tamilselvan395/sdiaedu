<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum AssessmentStatus: string implements HasColor, HasLabel
{
    case Scheduled = 'Scheduled';
    case Ongoing = 'Ongoing';
    case Completed = 'Completed';
    case Cancelled = 'Cancelled';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Scheduled => 'info',
            self::Ongoing => 'warning',
            self::Completed => 'success',
            self::Cancelled => 'danger',
        };
    }
}
