<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BlockInactiveUsers extends Command
{

    protected $signature = 'app:block-inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function handle()
    {
        // Get users who haven't logged in for 3 days
        $inactiveUsers = User::where('last_login_at', '<=', Carbon::now()->subDays(3))->get();

        // Block inactive users
        foreach ($inactiveUsers as $user) {
            $user->blocked = true;
            $user->save();
        }

        $this->info('Inactive users have been blocked.');
    }
}
