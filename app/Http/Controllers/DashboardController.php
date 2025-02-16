<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class DashboardController
{
    public function __invoke(): View
    {
        return view('pages.dashboard.index');
    }
}
