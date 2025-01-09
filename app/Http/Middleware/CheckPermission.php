<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Provides access to the resource:
     * - for any user, if route or permission is not set;
     * - for an authenticated user, if permission is granted.
     *
     * Otherwise, redirects to the home page.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $route = $request->route();

        if (!$route instanceof Route || !Permission::query()->where('name', '=', $route->getName())->exists()) {
            return $next($request);
        }

        if ($user instanceof User && $user->hasPermission($route->getName())) {
            return $next($request);
        }

        return redirect('frontend.frontend.index');
    }
}
