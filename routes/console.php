<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('queue-monitor:stale --beforeDays=1')->withoutOverlapping()->daily();

Schedule::command('queue-monitor:purge --beforeDays=7')->withoutOverlapping()->daily();

Schedule::command('queue:retry all')->withoutOverlapping()->everyTenMinutes();

Schedule::command('larasense:bot')->withoutOverlapping()->everyTenMinutes();

Schedule::command('queue:work --tries=2 --stop-when-emtpy --max-time=300')->withoutOverlapping()->everyTenMinutes();
