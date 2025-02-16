<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\RateLimiters\LoginRateLimiter;
use Illuminate\Http\Request;

final readonly class PrepareAuthenticatedSession
{
    public function __construct(
        private LoginRateLimiter $limiter
    ) {}

    public function handle(Request $request, callable $next)
    {
        if ($request->hasSession()) {
            $request->session()->regenerate();
        }

        $this->limiter->clear($request);

        return $next($request);
    }
}
