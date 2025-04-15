<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    User::observe(UserObserver::class);

    $auth = Auth::user();
    View::share('auth', $auth);

    Gate::define('admin', function (User $user) {
      return $user->isAdmin();
    });

    Gate::define('customer', function (User $user) {
      return $user->isCustomer();
    });
  }
}
