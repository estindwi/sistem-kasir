<x-layout active="laporan-keuangan">

    <x-breadcrumb
        :items="[
            ['label' => 'Laporan Keuangan']
        ]"
    />

    <x-page-header
        title="Laporan Keuangan"
        description="Pantau pemasukan, pengeluaran, dan kondisi keuangan usaha."
    >
    </x-page-header>


    {{-- ========================================================= --}}
    {{-- FILTER LAPORAN --}}
    {{-- ========================================================= --}}

    <div class="report-toolbar mb-4">

        {{-- JENIS LAPORAN --}}
        <div class="report-type">

            <a
                href="{{ route('laporan-keuangan.index', [
                    'period' => 'monthly',
                    'month' => $report['month'] ?? now()->month,
                    'year' => $report['year']
                ]) }}"
                class="report-type-button {{ $report['period'] === 'monthly' ? 'active' : '' }}"
            >
                <x-icon name="lucide:calendar-days" />
                Bulanan
            </a>

            <a
                href="{{ route('laporan-keuangan.index', [
                    'period' => 'yearly',
                    'year' => $report['year']
                ]) }}"
                class="report-type-button {{ $report['period'] === 'yearly' ? 'active' : '' }}"
            >
                <x-icon name="lucide:calendar-range" />
                Tahunan
            </a>

        </div>


        {{-- FILTER TANGGAL --}}
        <form
            action="{{ route('laporan-keuangan.index') }}"
            method="GET"
            class="report-date-form"
        >

            <input
                type="hidden"
                name="period"
                value="{{ $report['period'] }}"
            >


            @if ($report['period'] === 'monthly')

                <select
                    name="month"
                    class="form-select"
                >

                    @for ($i = 1; $i <= 12; $i++)

                        <option
                            value="{{ $i }}"
                            {{ $report['month'] == $i ? 'selected' : '' }}
                        >
                            {{ \Carbon\Carbon::create()
                                ->month($i)
                                ->locale('id')
                                ->translatedFormat('F') }}
                        </option>

                    @endfor

                </select>

            @endif


            <select
                name="year"
                class="form-select"
            >

                @for ($i = now()->year; $i >= now()->year - 5; $i--)

                    <option
                        value="{{ $i }}"
                        {{ $report['year'] == $i ? 'selected' : '' }}
                    >
                        {{ $i }}
                    </option>

                @endfor

            </select>


            <x-button
                variant="success"
                type="submit"
            >
                <x-icon name="lucide:filter" />
                Tampilkan
            </x-button>

        </form>

    </div>


    {{-- ========================================================= --}}
    {{-- RINGKASAN KEUANGAN --}}
    {{-- ========================================================= --}}

    <div class="row g-3 mb-4">

        {{-- PEMASUKAN --}}
        <div class="col-xl-4 col-md-6">

            <x-card>

                <div class="finance-summary">

                    <div class="finance-icon income-icon">
                        <x-icon name="lucide:trending-up" />
                    </div>

                    <div>

                        <span class="finance-label">
                            Total Pemasukan
                        </span>

                        <strong class="income-value">
                            Rp {{ number_format($report['totalIncome'], 0, ',', '.') }}
                        </strong>

                    </div>

                </div>

            </x-card>

        </div>


        {{-- PENGELUARAN --}}
        <div class="col-xl-4 col-md-6">

            <x-card>

                <div class="finance-summary">

                    <div class="finance-icon expense-icon">
                        <x-icon name="lucide:trending-down" />
                    </div>

                    <div>

                        <span class="finance-label">
                            Total Pengeluaran
                        </span>

                        <strong class="expense-value">
                            Rp {{ number_format($report['totalExpense'], 0, ',', '.') }}
                        </strong>

                    </div>

                </div>

            </x-card>

        </div>


        {{-- SALDO --}}
        <div class="col-xl-4 col-md-12">

            <x-card>

                <div class="finance-summary">

                    <div class="finance-icon balance-icon">
                        <x-icon name="lucide:wallet" />
                    </div>

                    <div>

                        <span class="finance-label">
                            Saldo Bersih
                        </span>

                        <strong
                            class="{{ $report['netBalance'] >= 0 ? 'balance-positive' : 'balance-negative' }}"
                        >
                            Rp {{ number_format($report['netBalance'], 0, ',', '.') }}
                        </strong>

                    </div>

                </div>

            </x-card>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- GRAFIK --}}
    {{-- ========================================================= --}}

    <div class="row g-3 mb-4">

        {{-- ARUS KAS --}}
        <div class="col-xl-8">

            <x-card
                title="{{ $report['period'] === 'monthly'
                    ? 'Arus Kas Bulanan'
                    : 'Arus Kas Tahunan' }}"
            >

                <div class="chart-wrapper">

                    <canvas id="cashFlowChart"></canvas>

                </div>

            </x-card>

        </div>


        {{-- DONUT --}}
        <div class="col-xl-4">

            <x-card title="Pengeluaran Berdasarkan Kategori">

                @if (count($report['categoryExpenses']) > 0)

                    <div class="donut-wrapper">

                        <canvas id="expenseCategoryChart"></canvas>

                    </div>


                    <div class="category-legend">

                        @foreach ($report['categoryExpenses'] as $index => $item)

                            <div class="legend-item">

                                <div class="legend-left">

                                    <span
                                        class="legend-dot"
                                        data-index="{{ $index }}"
                                    ></span>

                                    <span class="legend-name">
                                        {{ $item['label'] }}
                                    </span>

                                </div>

                                <strong>
                                    Rp {{ number_format($item['total'], 0, ',', '.') }}
                                </strong>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="chart-empty">

                        <div class="chart-empty-icon">

                            <x-icon name="lucide:pie-chart" />

                        </div>

                        <strong>
                            Belum ada pengeluaran
                        </strong>

                        <span>
                            Belum ada data pengeluaran pada periode ini.
                        </span>

                    </div>

                @endif

            </x-card>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MARGIN + RINGKASAN --}}
    {{-- ========================================================= --}}

    <div class="row g-3">

        {{-- MARGIN BERSIH --}}
        <div class="col-xl-4">

            <x-card title="Margin Bersih">

                <div class="margin-card">

                    <div
                        class="margin-circle"
                        style="--margin: {{ max(0, min(100, $report['netMargin'])) }}%;"
                    >

                        <div class="margin-circle-inner">

                            <strong>
                                {{ number_format($report['netMargin'], 1, ',', '.') }}%
                            </strong>

                            <span>
                                Margin Bersih
                            </span>

                        </div>

                    </div>


                    <p class="margin-description">

                        Persentase pemasukan yang tersisa setelah dikurangi
                        seluruh pengeluaran

                        @if ($report['period'] === 'monthly')

                            pada bulan
                            {{ $report['monthName'] }}
                            {{ $report['year'] }}.

                        @else

                            sepanjang tahun
                            {{ $report['year'] }}.

                        @endif

                    </p>

                </div>

            </x-card>

        </div>


        {{-- RINGKASAN --}}
        <div class="col-xl-8">

            <x-card title="Ringkasan Periode">

                <div class="period-summary">

                    <div class="period-summary-item">

                        <span>
                            Pemasukan
                        </span>

                        <strong class="income-text">
                            Rp {{ number_format($report['totalIncome'], 0, ',', '.') }}
                        </strong>

                    </div>


                    <div class="period-summary-item">

                        <span>
                            Pengeluaran
                        </span>

                        <strong class="expense-text">
                            Rp {{ number_format($report['totalExpense'], 0, ',', '.') }}
                        </strong>

                    </div>


                    <div class="period-summary-item total">

                        <span>
                            Saldo Bersih
                        </span>

                        <strong
                            class="{{ $report['netBalance'] >= 0 ? 'balance-positive' : 'balance-negative' }}"
                        >
                            Rp {{ number_format($report['netBalance'], 0, ',', '.') }}
                        </strong>

                    </div>

                </div>

            </x-card>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CHART.JS --}}
    {{-- ========================================================= --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const chartLabels = @json($report['chartLabels']);
        const chartIncome = @json($report['chartIncome']);
        const chartExpense = @json($report['chartExpense']);
        const categoryExpenses = @json($report['categoryExpenses']);


        /*
        |--------------------------------------------------------------------------
        | GRAFIK ARUS KAS
        |--------------------------------------------------------------------------
        */

        const cashFlowCanvas =
            document.getElementById('cashFlowChart');

        if (cashFlowCanvas) {

            new Chart(cashFlowCanvas, {

                type: 'line',

                data: {

                    labels: chartLabels,

                    datasets: [

                        {
                            label: 'Pemasukan',

                            data: chartIncome,

                            borderColor: '#2e7d32',

                            backgroundColor:
                                'rgba(46, 125, 50, 0.08)',

                            tension: 0.35,

                            borderWidth: 2,

                            pointRadius: 3,

                            pointHoverRadius: 5,

                            fill: true
                        },


                        {
                            label: 'Pengeluaran',

                            data: chartExpense,

                            borderColor: '#d32f2f',

                            backgroundColor:
                                'rgba(211, 47, 47, 0.06)',

                            tension: 0.35,

                            borderWidth: 2,

                            pointRadius: 3,

                            pointHoverRadius: 5,

                            fill: true
                        }

                    ]

                },


                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    interaction: {

                        mode: 'index',

                        intersect: false

                    },


                    scales: {

                        y: {

                            beginAtZero: true,

                            ticks: {

                                callback: function(value) {

                                    return 'Rp ' +
                                        Number(value)
                                            .toLocaleString('id-ID');

                                }

                            }

                        }

                    },


                    plugins: {

                        legend: {

                            position: 'top',

                            labels: {

                                usePointStyle: true,

                                boxWidth: 8

                            }

                        },


                        tooltip: {

                            callbacks: {

                                label: function(context) {

                                    return context.dataset.label +
                                        ': Rp ' +
                                        Number(context.raw)
                                            .toLocaleString('id-ID');

                                }

                            }

                        }

                    }

                }

            });

        }


        /*
        |--------------------------------------------------------------------------
        | DONUT PENGELUARAN
        |--------------------------------------------------------------------------
        */

        const donutCanvas =
            document.getElementById('expenseCategoryChart');


        const expenseColors = [

            '#dc2626',
            '#ef4444',
            '#f97316',
            '#ea580c',
            '#f59e0b',
            '#b91c1c',
            '#fb7185'

        ];


        if (
            donutCanvas &&
            categoryExpenses.length > 0
        ) {

            new Chart(donutCanvas, {

                type: 'doughnut',

                data: {

                    labels: categoryExpenses.map(
                        item => item.label
                    ),

                    datasets: [

                        {
                            data: categoryExpenses.map(
                                item => item.total
                            ),

                            backgroundColor:
                                categoryExpenses.map(
                                    (_, index) =>
                                        expenseColors[
                                            index %
                                            expenseColors.length
                                        ]
                                ),

                            borderColor: '#ffffff',

                            borderWidth: 3

                        }

                    ]

                },


                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '68%',


                    plugins: {

                        legend: {
                            display: false
                        },


                        tooltip: {

                            callbacks: {

                                label: function(context) {

                                    return ' Rp ' +
                                        Number(context.raw)
                                            .toLocaleString('id-ID');

                                }

                            }

                        }

                    }

                }

            });


            document
                .querySelectorAll('.legend-dot')
                .forEach((dot, index) => {

                    dot.style.background =
                        expenseColors[
                            index %
                            expenseColors.length
                        ];

                });

        }


        /*
        |--------------------------------------------------------------------------
        | DOWNLOAD PDF
        |--------------------------------------------------------------------------
        */

        const pdfButton =
            document.getElementById('btn-download-pdf');

        if (pdfButton) {

            pdfButton.addEventListener(
                'click',
                function(event) {

                    event.preventDefault();

                    const period =
                        @json($report['period']);

                    const year =
                        @json($report['year']);

                    const month =
                        @json($report['month']);


                    let url =
                        `/laporan-keuangan/pdf?period=${period}&year=${year}`;


                    if (period === 'monthly') {

                        url +=
                            `&month=${month}`;

                    }


                    window.location.href = url;

                }
            );

        }

    </script>


    {{-- ========================================================= --}}
    {{-- STYLE --}}
    {{-- ========================================================= --}}

    <style>

        /* FILTER */

        .report-toolbar {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            padding: 14px 16px;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            background: #ffffff;

        }


        .report-type {

            display: flex;

            gap: 4px;

            padding: 4px;

            border-radius: 10px;

            background: #f3f5f4;

        }


        .report-type-button {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 9px 14px;

            border-radius: 8px;

            color: #6b7280;

            text-decoration: none;

            font-size: 13px;

            font-weight: 600;

            transition: all 0.2s ease;

        }


        .report-type-button iconify-icon {

            font-size: 16px;

        }


        .report-type-button:hover {

            color: #2e7d32;

        }


        .report-type-button.active {

            background: #ffffff;

            color: #2e7d32;

            box-shadow:
                0 1px 4px rgba(0, 0, 0, 0.08);

        }


        .report-date-form {

            display: flex;

            align-items: center;

            gap: 8px;

        }


        .report-date-form .form-select {

            min-width: 145px;

            min-height: 42px;

            border-radius: 9px;

        }


        /* FINANCE CARD */

        .finance-summary {

            display: flex;

            align-items: center;

            gap: 14px;

        }


        .finance-icon {

            width: 46px;

            height: 46px;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            border-radius: 12px;

        }


        .finance-icon iconify-icon {

            font-size: 21px;

        }


        .income-icon {

            background: #eaf5ec;

            color: #2e7d32;

        }


        .expense-icon {

            background: #fff1f1;

            color: #d32f2f;

        }


        .balance-icon {

            background: #eef4ff;

            color: #2563eb;

        }


        .finance-label {

            display: block;

            margin-bottom: 3px;

            color: #6b7280;

            font-size: 12px;

        }


        .finance-summary strong {

            font-size: 19px;

        }


        .income-value,
        .income-text {

            color: #2e7d32;

        }


        .expense-value,
        .expense-text {

            color: #d32f2f;

        }


        .balance-positive {

            color: #2e7d32;

        }


        .balance-negative {

            color: #d32f2f;

        }


        /* CHART */

        .chart-wrapper {

            position: relative;

            height: 340px;

        }


        .donut-wrapper {

            position: relative;

            width: 100%;

            height: 240px;

        }


        /* LEGEND */

        .category-legend {

            display: flex;

            flex-direction: column;

            gap: 9px;

            margin-top: 10px;

        }


        .legend-item {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

            padding-bottom: 8px;

            border-bottom: 1px solid #eef0ef;

            font-size: 13px;

        }


        .legend-left {

            display: flex;

            align-items: center;

            gap: 8px;

        }


        .legend-dot {

            width: 9px;

            height: 9px;

            display: inline-block;

            border-radius: 50%;

        }


        .legend-name {

            color: #6b7280;

        }


        .legend-item strong {

            color: #374151;

        }


        /* EMPTY */

        .chart-empty {

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            min-height: 280px;

            text-align: center;

        }


        .chart-empty-icon {

            width: 58px;

            height: 58px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 12px;

            border-radius: 15px;

            background: #fff1f1;

            color: #d32f2f;

        }


        .chart-empty-icon iconify-icon {

            font-size: 27px;

        }


        .chart-empty strong {

            margin-bottom: 4px;

            color: #374151;

            font-size: 14px;

        }


        .chart-empty span {

            color: #9ca3af;

            font-size: 12px;

        }


        /* MARGIN */

        .margin-card {

            display: flex;

            align-items: center;

            gap: 22px;

        }


        .margin-circle {

            --size: 150px;

            position: relative;

            width: var(--size);

            height: var(--size);

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background:
                conic-gradient(
                    #2e7d32 var(--margin),
                    #e9eceb var(--margin)
                );

        }


        .margin-circle-inner {

            width: 112px;

            height: 112px;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-direction: column;

            border-radius: 50%;

            background: #ffffff;

        }


        .margin-circle-inner strong {

            color: #2e7d32;

            font-size: 24px;

            line-height: 1;

        }


        .margin-circle-inner span {

            margin-top: 6px;

            color: #9ca3af;

            font-size: 11px;

        }


        .margin-description {

            margin: 0;

            color: #6b7280;

            font-size: 13px;

            line-height: 1.6;

        }


        /* SUMMARY */

        .period-summary {

            display: flex;

            flex-direction: column;

        }


        .period-summary-item {

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 14px 0;

            border-bottom: 1px solid #eef0ef;

        }


        .period-summary-item:first-child {

            padding-top: 0;

        }


        .period-summary-item:last-child {

            border-bottom: none;

        }


        .period-summary-item span {

            color: #6b7280;

            font-size: 13px;

        }


        .period-summary-item strong {

            font-size: 15px;

        }


        .period-summary-item.total {

            margin-top: 3px;

            padding-top: 17px;

        }


        /* RESPONSIVE */

        @media (max-width: 768px) {

            .report-toolbar {

                align-items: stretch;

                flex-direction: column;

            }


            .report-type {

                width: fit-content;

            }


            .report-date-form {

                width: 100%;

            }


            .report-date-form .form-select {

                flex: 1;

            }


            .report-date-form .ui-button {

                flex-shrink: 0;

            }


            .margin-card {

                align-items: center;

                flex-direction: column;

                text-align: center;

            }

        }

    </style>

</x-layout>