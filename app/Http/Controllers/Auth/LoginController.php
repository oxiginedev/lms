<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\AttemptToAuthenticate;
use App\Actions\Auth\EnsureLoginIsNotThrottled;
use App\Actions\Auth\PrepareAuthenticatedSession;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class LoginController
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): Response
    {
        return $this->loginPipeline($request)->then(fn($request) => redirect()->intended(route('dashboard')));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login-view');
    }

    private function loginPipeline(Request $request): \Illuminate\Pipeline\Pipeline
    {
        return (new Pipeline(app()))->send($request)
            ->through(array_filter([
                EnsureLoginIsNotThrottled::class,
                AttemptToAuthenticate::class,
                PrepareAuthenticatedSession::class,
            ]));
    }
}
