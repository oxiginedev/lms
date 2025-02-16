<?php

declare(strict_types=1);

namespace App\RateLimiters;

use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final readonly class LoginRateLimiter
{
    public function __construct(
        private RateLimiter $limiter
    ) {}

    public function attempts(Request $request): mixed
    {
        return $this->limiter->attempts($this->throttleKey($request));
    }

    public function tooManyAttempts(Request $request): bool
    {
        return $this->limiter->tooManyAttempts($this->throttleKey($request), 5);
    }

    public function increment(Request $request): void
    {
        $this->limiter->increment($this->throttleKey($request), 60);
    }

    public function availableIn(Request $request): int
    {
        return $this->limiter->availableIn($this->throttleKey($request));
    }

    public function clear(Request $request): void
    {
        $this->limiter->clear($this->throttleKey($request));
    }

    private function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
    }
}
