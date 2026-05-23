<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckColocationMember
{
    public function handle(Request $request, Closure $next): Response
    {
        $colocation = $request->route('colocation');

        if ($colocation) {
            $isMember = $colocation->members()->where('user_id', auth()->id())->exists();

            if (!$isMember) {
                abort(403, 'You are not a member of this colocation.');
            }
        }

        return $next($request);
    }
}