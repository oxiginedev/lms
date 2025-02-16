<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\RateLimiters\LoginRateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

final readonly class AttemptToAuthenticate
{
    public function __construct(
        private LoginRateLimiter $limiter
    ) {}

    public function handle(Request $request, callable $next)
    {
        if (Auth::guard()->attempt(
            $request->only(['email', 'password']),
            $request->boolean('remember')
        )) {
            return $next($request);
        }

        $this->limiter->increment($request);

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }
}
