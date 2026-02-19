<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Constant\Status;
use Constant\Message;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
       $user = $request->user();

        if (!in_array($user->role, $roles)) {
            return response()->json([
                'message' => Message::FORBIDDEN_REQUEST
            ], Status::STATUS_CODE_FORBIDDEN);
        }

        return $next($request);
    }
}
