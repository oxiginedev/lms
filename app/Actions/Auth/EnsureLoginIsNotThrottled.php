<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\RateLimiters\LoginRateLimiter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

final readonly class EnsureLoginIsNotThrottled
{
    public function __construct(
        private LoginRateLimiter $limiter
    ) {}

    public function handle(Request $request, callable $next)
    {
        if (! $this->limiter->tooManyAttempts($request)) {
            return $next($request);
        }

        return with($this->limiter->availableIn($request), function ($seconds): never {
            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ])->status(Response::HTTP_TOO_MANY_REQUESTS);
        });
    }
}
