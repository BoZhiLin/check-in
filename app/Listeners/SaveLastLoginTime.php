<?php

namespace App\Listeners;

use App\Events\AdminLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveLastLoginTime
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdminLogin  $event
     * @return void
     */
    public function handle(AdminLogin $event)
    {
        $admin_user = auth('admin')->setToken($event->token)->user();
        $admin_user->last_login_at = now();
        $admin_user->save();
    }
}
