<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('queue-monitor:stale --beforeDays=1')->withoutOverlapping()->daily();

Schedule::command('queue-monitor:purge --beforeDays=7')->withoutOverlapping()->daily();

Schedule::command('larasense:bot')->withoutOverlapping()->everyMinute();

Schedule::command('queue:work --tries=3')->withoutOverlapping()->everyMinute();

Schedule::command('queue:retry all')->withoutOverlapping()->everyMinute();
