<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('queue-monitor:stale --beforeDays=1')->withoutOverlapping()->daily();

Schedule::command('queue-monitor:purge --beforeDays=7')->withoutOverlapping()->daily();

Schedule::command('larasense:bot')->withoutOverlapping()->everyTenMinutes();

Schedule::command('queue:work --tries=2 --stop-when-empty')->withoutOverlapping()->everySecond();

Schedule::command('larasense:digest --period=weekly')->sundays()->hourly();

$lastDayOfMonth = now()->endOfMonth()->day;
Schedule::command('larasense:digest --period=monthly')->cron("0 * {$lastDayOfMonth} * *");
