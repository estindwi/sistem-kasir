<?php

namespace App\Queries\FinancialReport;

use App\Models\Pengeluaran;
use App\Models\TransaksiPenjualan;
use Carbon\Carbon;

class GetFinancialReportQuery
{
    public function execute(
        string $period = 'monthly',
        ?int $month = null,
        ?int $year = null
    ): array {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        if ($period === 'yearly') {
            return $this->yearly($year);
        }

        return $this->monthly($month, $year);
    }

    private function monthly(int $month, int $year): array
    {
        $startDate = Carbon::create($year, $month, 1)->startOfDay();
        $endDate = $startDate->copy()->endOfMonth();

        $totalIncome = (float) TransaksiPenjualan::query()
            ->where('status', 'completed')
            ->whereBetween('tanggal_transaksi', [
                $startDate,
                $endDate,
            ])
            ->sum('total');

        $totalExpense = (float) Pengeluaran::query()
            ->whereBetween('tanggal_pengeluaran', [
                $startDate->toDateString(),
                $endDate->toDateString(),
            ])
            ->sum('jumlah');

        $netBalance = $totalIncome - $totalExpense;

        $netMargin = $totalIncome > 0
            ? ($netBalance / $totalIncome) * 100
            : 0;

        $dailyIncome = TransaksiPenjualan::query()
            ->where('status', 'completed')
            ->whereBetween('tanggal_transaksi', [
                $startDate,
                $endDate,
            ])
            ->selectRaw('DATE(tanggal_transaksi) as tanggal, SUM(total) as total')
            ->groupByRaw('DATE(tanggal_transaksi)')
            ->pluck('total', 'tanggal');

        $dailyExpense = Pengeluaran::query()
            ->whereBetween('tanggal_pengeluaran', [
                $startDate->toDateString(),
                $endDate->toDateString(),
            ])
            ->selectRaw('tanggal_pengeluaran as tanggal, SUM(jumlah) as total')
            ->groupBy('tanggal_pengeluaran')
            ->pluck('total', 'tanggal');

        $dailyFlow = [];

        for ($day = 1; $day <= $startDate->daysInMonth; $day++) {
            $date = Carbon::create($year, $month, $day);
            $dateKey = $date->format('Y-m-d');

            $dailyFlow[] = [
                'label' => $day,
                'income' => (float) ($dailyIncome[$dateKey] ?? 0),
                'expense' => (float) ($dailyExpense[$dateKey] ?? 0),
            ];
        }

        $categoryExpenses = $this->getCategoryExpenses(
            $startDate->toDateString(),
            $endDate->toDateString()
        );

        return [
            'period' => 'monthly',
            'month' => $month,
            'year' => $year,

            'monthName' => $startDate
                ->locale('id')
                ->translatedFormat('F'),

            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'netBalance' => $netBalance,
            'netMargin' => $netMargin,

            'chartLabels' => collect($dailyFlow)
                ->pluck('label')
                ->values()
                ->all(),

            'chartIncome' => collect($dailyFlow)
                ->pluck('income')
                ->values()
                ->all(),

            'chartExpense' => collect($dailyFlow)
                ->pluck('expense')
                ->values()
                ->all(),

            'categoryExpenses' => $categoryExpenses,
        ];
    }

    private function yearly(int $year): array
    {
        $startDate = Carbon::create($year, 1, 1)->startOfDay();
        $endDate = Carbon::create($year, 12, 31)->endOfDay();

        $totalIncome = (float) TransaksiPenjualan::query()
            ->where('status', 'completed')
            ->whereBetween('tanggal_transaksi', [
                $startDate,
                $endDate,
            ])
            ->sum('total');

        $totalExpense = (float) Pengeluaran::query()
            ->whereBetween('tanggal_pengeluaran', [
                $startDate->toDateString(),
                $endDate->toDateString(),
            ])
            ->sum('jumlah');

        $netBalance = $totalIncome - $totalExpense;

        $netMargin = $totalIncome > 0
            ? ($netBalance / $totalIncome) * 100
            : 0;

        $monthlyIncome = TransaksiPenjualan::query()
            ->where('status', 'completed')
            ->whereBetween('tanggal_transaksi', [
                $startDate,
                $endDate,
            ])
            ->selectRaw(
                'MONTH(tanggal_transaksi) as bulan, SUM(total) as total'
            )
            ->groupByRaw('MONTH(tanggal_transaksi)')
            ->pluck('total', 'bulan');

        $monthlyExpense = Pengeluaran::query()
            ->whereBetween('tanggal_pengeluaran', [
                $startDate->toDateString(),
                $endDate->toDateString(),
            ])
            ->selectRaw(
                'MONTH(tanggal_pengeluaran) as bulan, SUM(jumlah) as total'
            )
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $chartLabels = [];
        $chartIncome = [];
        $chartExpense = [];

        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::create($year, $month, 1);

            $chartLabels[] = $date
                ->locale('id')
                ->translatedFormat('M');

            $chartIncome[] = (float) ($monthlyIncome[$month] ?? 0);
            $chartExpense[] = (float) ($monthlyExpense[$month] ?? 0);
        }

        $categoryExpenses = $this->getCategoryExpenses(
            $startDate->toDateString(),
            $endDate->toDateString()
        );

        return [
            'period' => 'yearly',
            'month' => null,
            'year' => $year,

            'monthName' => null,

            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'netBalance' => $netBalance,
            'netMargin' => $netMargin,

            'chartLabels' => $chartLabels,
            'chartIncome' => $chartIncome,
            'chartExpense' => $chartExpense,

            'categoryExpenses' => $categoryExpenses,
        ];
    }

    private function getCategoryExpenses(
        string $startDate,
        string $endDate
    ): array {
        return Pengeluaran::query()
            ->with('kategori')
            ->whereBetween('tanggal_pengeluaran', [
                $startDate,
                $endDate,
            ])
            ->get()
            ->groupBy('kategori_id')
            ->map(function ($items) {
                return [
                    'label' => $items->first()->kategori->nama_kategori
                        ?? 'Tanpa Kategori',

                    'total' => (float) $items->sum('jumlah'),
                ];
            })
            ->values()
            ->sortByDesc('total')
            ->values()
            ->all();
    }
}