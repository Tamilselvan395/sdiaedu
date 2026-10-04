<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum CertificateStatus: string implements HasColor, HasLabel
{
    case Valid = 'Valid';
    case Revoked = 'Revoked';
    case Expired = 'Expired';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Valid => 'success',
            self::Revoked => 'danger',
            self::Expired => 'warning',
        };
    }
}
