<?php

namespace App\Console\Commands\User;

use App\User;
use Illuminate\Console\Command;

class CreateUserRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user role to admin';

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
    public function handle(User $user)
    {
        $arg_name = $this->argument('name');
        $arg_email = $this->argument('email');
        $arg_password = $this->argument('password');

        try {

            $user = User::where('email', $arg_email)->first();
            if ( $user ) {
                throw new \Exception('User already exists');
            }

            $newUser = new User();


            $newUser->newUser($arg_name, $arg_email, $arg_password, User::USER_ROLE_ADMIN, User::STATUS_VERIFY_ACTIVE);

            $this->info('Admin created');

        }catch (\Exception $e) {

            $this->error($e->getMessage());

        }

    }
}
