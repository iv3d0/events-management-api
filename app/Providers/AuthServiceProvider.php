<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Event;
use App\Models\Attendee;
use App\Policies\EventPolicy;
use App\Policies\AttendeePolicy;
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
        Event::class => EventPolicy::class,
        Attendee::class => AttendeePolicy::class,
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
