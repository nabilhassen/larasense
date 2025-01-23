<?php
namespace App\Enums;

enum DigestFrequency: string {
    case Weekly  = 'weekly';
    case Monthly = 'monthly';
    case All     = 'all';
    case Never   = 'never';
}
