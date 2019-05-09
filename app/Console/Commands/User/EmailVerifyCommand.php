<?php

namespace App\Console\Commands\User;

use App\User;
use Illuminate\Console\Command;

class EmailVerifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:verify {user_email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email verified for user and user status on active';

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
        $email = $this->argument('user_email');

        $user = User::where('email', '=', $email)->first();

        if (!$user) {
            $this->error('Undefied user with email ' . $email);

            return false;
        }

        if ($user->email_verified_at == null && $user->status == User::STATUS_VERIFY_WAIT) {

            $user->update([
                'email_verified_at' => now(),
                'status' => User::STATUS_VERIFY_ACTIVE,
            ]);

            $this->info(
                'User name: ' . $user->name .
                ' email: ' . $user->email .
                '- Email successfully verified'
            );
        } else {

            $this->error('User already verified');
        }

    }
}
