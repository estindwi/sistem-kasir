<?php

namespace App\Http\Controllers;

use App\Queries\Dashboard\GetDashboardQuery;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected GetDashboardQuery $getDashboardQuery
    ) {
    }

    public function index(): View
    {
        $dashboard = $this->getDashboardQuery->execute();

        return view('dashboard.index', compact('dashboard'));
    }
}