<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum BlogPostStatus: string implements HasColor, HasLabel
{
    case Draft = 'Draft';
    case Published = 'Published';
    case Scheduled = 'Scheduled';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Draft => 'gray',
            self::Published => 'success',
            self::Scheduled => 'info',
        };
    }
}
