<?php
namespace App\Enums;

enum DigestFrequency: string {
    case Weekly = 'weekly';
    case Monthly = 'monthly';
    case All = 'all';
    case Never = 'never';

    public function label(): string
    {
        return match ($this) {
            DigestFrequency::Weekly => 'Weekly',
            DigestFrequency::Monthly => 'Monthly',
            DigestFrequency::All => 'All Schedules',
            DigestFrequency::Never => 'Never',
        };
    }
}
