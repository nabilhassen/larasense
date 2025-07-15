<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueueableVerifyEmailNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;
}
