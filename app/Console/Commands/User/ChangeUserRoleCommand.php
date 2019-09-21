<?php

namespace App\Console\Commands\User;

use App\User;
use Illuminate\Console\Command;

class ChangeUserRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user role';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $arg_email = $this->argument('email');

        $user = User::where('email', $arg_email)->first();

        if(!$user) {

            $this->error('User with email ' . $arg_email . ' not found');

            return false;
        }


        $user->role = User::USER_ROLE_ADMIN;

        $user->save();


        $this->info('user role successfully changed to - ' . User::USER_ROLE_ADMIN);
    }
}
