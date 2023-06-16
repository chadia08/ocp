<?php

namespace App\Providers;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Session;
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
        $this->app['events']->listen(Authenticated::class, function (Authenticated $event) {
            $user = $event->user;
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name);
            Session::put('matricule', $user->matricule);
            Session::put('prenom', $user->prenom);
            Session::put('role', $user->role);
            Session::put('password', $user->password);
            
            
            // Ajoutez d'autres informations de connexion que vous souhaitez stocker dans la session
        });
    }
}
