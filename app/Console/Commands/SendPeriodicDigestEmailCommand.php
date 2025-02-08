<?php

namespace App\Console\Commands;

use App\Enums\DigestFrequency;
use App\Mail\PeriodicDigest;
use App\Models\Digest;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
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

        $cacheKey = "{$period}:digest:sentToIds";

        $sentToUserIds = Cache::pull($cacheKey, []);

        $digestExists = Digest::whereDate('created_at', today())->where('frequency', DigestFrequency::tryFrom($period))->exists();

        if (! $digestExists) {
            Digest::create([
                'frequency' => DigestFrequency::tryFrom($period),
            ]);
        }

        $digestCount = Digest::where('frequency', DigestFrequency::tryFrom($period))->count();

        User::query()
            ->whereNotIn('id', $sentToUserIds)
            ->whereIn('digest_frequency', [DigestFrequency::tryFrom($period), DigestFrequency::All])
            ->whereNotNull('email_verified_at')
            ->limit(80)
            ->get()
            ->each(function (User $user) use ($period, $digestCount, &$sentToUserIds) {
                Mail::mailer('smtp')
                    ->to($user)
                    ->send(new PeriodicDigest($digestCount, $period));

                $sentToUserIds[] = $user->id;
            });

        Cache::put($cacheKey, $sentToUserIds, now()->addDay());
    }
}
