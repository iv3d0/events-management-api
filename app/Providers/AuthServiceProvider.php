<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('update-event', fn (User $user, Event $event) => $user->id === $event->user_id);
        Gate::define('delete-event', fn (User $user, Event $event) => $user->id === $event->user_id);
    }
}
