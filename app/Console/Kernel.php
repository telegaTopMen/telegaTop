<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Регистрация пользовательских команд Artisan (если есть).
     */
    protected $commands = [
        // \App\Console\Commands\SomeCommand::class,
    ];

    /**
     * Определяет расписание выполнения команд.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('send:order-create')->everyMinute();
    }


    /**
     * Регистрация хуков для Artisan.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
