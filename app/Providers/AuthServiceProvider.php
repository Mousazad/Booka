<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Book;
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
         'App\Models\Book' => 'App\Policies\BookPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
		// Gate::define('create_book', function (User $user) {
			// return $user->role == 'admin';
		// });
    }
}
