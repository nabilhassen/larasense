<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('larasense:bot')->withoutOverlapping()->everyMinute();

Schedule::command('queue:work --tries=3')->withoutOverlapping()->everyMinute();

Schedule::command('queue:retry all')->withoutOverlapping()->everyMinute();
