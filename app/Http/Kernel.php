<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
/**
* The application's global HTTP middleware stack.
*
* @var array
*/
protected $middleware = [
\Illuminate\Http\Middleware\TrustProxies::class,
\Illuminate\Http\Middleware\CheckForMaintenanceMode::class,
\Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
\App\Http\Middleware\EncryptCookies::class,
\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
\Illuminate\Session\Middleware\StartSession::class,
\Illuminate\Session\Middleware\AuthenticateSession::class,
\Illuminate\View\Middleware\ShareErrorsFromSession::class,
\Illuminate\Routing\Middleware\SubstituteBindings::class,
];

/**
* The application's route middleware groups.
*
* @var array
*/
protected $middlewareGroups = [
'web' => [
\App\Http\Middleware\VerifyCsrfToken::class,
\Illuminate\Routing\Middleware\SubstituteBindings::class,
],

'api' => [
'throttle:api',
\Illuminate\Routing\Middleware\SubstituteBindings::class,
],
];

/**
* The application's route middleware.
*
* These middleware may be assigned to groups or used individually.
*
* @var array
*/
protected $routeMiddleware = [
'auth' => \App\Http\Middleware\Authenticate::class,
'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
'team.owns' => \App\Http\Middleware\EnsureUserOwnsTeam::class,
'team.owner' => \App\Http\Middleware\EnsureUserOwnsTeam::class,
'rolkontrol' => \App\Http\Middleware\RoleMiddleware::class
];

    /**
     * @return array|string[]
     */
    public function getRouteMiddleware(): array
    {
        return $this->routeMiddleware;
    }

    /**
     * @param array|string[] $routeMiddleware
     */
    public function setRouteMiddleware(array $routeMiddleware): void
    {
        $this->routeMiddleware = $routeMiddleware;
    }
}
