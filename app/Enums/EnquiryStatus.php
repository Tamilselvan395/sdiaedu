<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum EnquiryStatus: string implements HasColor, HasLabel
{
    case New = 'New';
    case Contacted = 'Contacted';
    case Interested = 'Interested';
    case Counselling = 'Counselling';
    case TrialBooked = 'Trial Booked';
    case TrialCompleted = 'Trial Completed';
    case AdmissionPending = 'Admission Pending';
    case Admitted = 'Admitted';
    case FollowUp = 'Follow Up';
    case NotInterested = 'Not Interested';
    case Closed = 'Closed';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::New => 'info',
            self::Contacted => 'primary',
            self::Interested => 'warning',
            self::Counselling => 'purple',
            self::TrialBooked => 'amber',
            self::TrialCompleted => 'cyan',
            self::AdmissionPending => 'orange',
            self::Admitted => 'success',
            self::FollowUp => 'yellow',
            self::NotInterested => 'gray',
            self::Closed => 'danger',
        };
    }
}
