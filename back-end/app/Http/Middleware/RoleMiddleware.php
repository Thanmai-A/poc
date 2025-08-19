<?php
namespace App\Http\Middleware;
use Closure;
class RoleMiddleware {
    public function handle($request, Closure $next, $roles)
{
    $user = auth('api')->user();
    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
 
   $allowed = array_map('trim', explode(',', $roles));
    if (!in_array($user->role, $allowed, true)) {
        return response()->json(['error' => 'Forbidden'], 403);
    }
 
    return $next($request);
}
}
