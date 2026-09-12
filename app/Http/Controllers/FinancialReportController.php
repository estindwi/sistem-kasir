<?php

namespace App\Http\Controllers;

use App\Queries\FinancialReport\GetFinancialReportQuery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FinancialReportController extends Controller
{
    public function __construct(
        protected GetFinancialReportQuery $getFinancialReportQuery
    ) {
    }

    public function index(Request $request): View
    {
        $period = $request->input('period', 'monthly');
        $month = $request->integer('month') ?: now()->month;
        $year = $request->integer('year') ?: now()->year;

        $report = $this->getFinancialReportQuery->execute(
            $period,
            $month,
            $year
        );

        return view(
            'financial_report.index',
            compact('report')
        );
    }
}