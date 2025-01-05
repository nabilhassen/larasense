<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::firstOrCreate([
            'email' => 'admin@larasense.com',
        ], [
            'name' => 'Nabil Hassen (Admin)',
            'is_admin' => 1,
            'email_verified_at' => now(),
            'password' => 'nabilhassen',
        ]);

        $this->info('Admin user created. Credentials:');

        $this->newLine();

        $this->info('Email: admin@larasense.com');

        $this->info('Password: nabilhassen');
    }
}
