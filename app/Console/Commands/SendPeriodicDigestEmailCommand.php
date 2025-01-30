<?php

namespace App\Console\Commands;

use App\Enums\DigestFrequency;
use App\Mail\PeriodicDigest;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

class SendPeriodicDigestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larasense:digest {--period=weekly}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send periodic email digests.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $period = $this->option('period');

        if (! in_array($period, ['weekly', 'monthly'])) {
            return;
        }

        User::query()
            ->where(function (Builder $query) use ($period) {
                $query->where('digest_frequency', DigestFrequency::tryFrom($period))
                    ->orWhere('digest_frequency', DigestFrequency::All);
            })
            ->whereNotNull('email_verified_at')
            ->when(
                app()->isProduction(),
                fn($q) => $q->whereIn('email', [
                    'nabiiilo77@gmail.com',
                ])
            )
            ->chunk(50, function (Collection $users) use ($period) {
                foreach ($users as $user) {                    
                    Mail::mailer('smtp')
                        ->to($user)
                        ->send(new PeriodicDigest($period));
                }
            });
    }
}
