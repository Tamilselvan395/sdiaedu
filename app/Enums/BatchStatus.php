<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum BatchStatus: string implements HasColor, HasLabel
{
    case Upcoming = 'Upcoming';
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
            self::Upcoming => 'info',
            self::Ongoing => 'success',
            self::Completed => 'gray',
            self::Cancelled => 'danger',
        };
    }
}
