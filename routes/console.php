<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('queue-monitor:stale --beforeDays=1')->withoutOverlapping()->daily();

Schedule::command('queue-monitor:purge --beforeDays=7')->withoutOverlapping()->daily();

Schedule::command('larasense:bot')->withoutOverlapping()->everyTenMinutes();

Schedule::command('pulse:check')->withoutOverlapping()->everyMinute();

Schedule::command('queue:work --tries=3 --backoff=3 --stop-when-empty')->withoutOverlapping()->everySecond();
