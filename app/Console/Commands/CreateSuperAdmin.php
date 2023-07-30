<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:super-admin {name=Administrator} {email=admin@admin.com} {password=admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create supper admin data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $arguments = $this->arguments();
        $name = $arguments['name'];
        $email = $arguments['email'];

        User::firstOrCreate(['name' => $name, 'email' => $email], $arguments);
    }
}