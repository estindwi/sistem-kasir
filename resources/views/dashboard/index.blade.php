<x-layout active="dashboard">

    <x-breadcrumb
        :items="[
            ['label' => 'Dashboard']
        ]"
    />


    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="dashboard-header">

        <div>

            <div class="dashboard-greeting">
                Selamat datang kembali 👋
            </div>

            <h1 class="dashboard-title">
                Dashboard
            </h1>

            <p class="dashboard-description">
                Pantau aktivitas kasir dan kondisi keuangan
                hidroponik pada bulan {{ $dashboard['periode'] }}.
            </p>

        </div>


        <x-button
            variant="success"
            size="lg"
            :href="route('transaksi.create')"
        >
            <x-icon name="lucide:plus" />
            Transaksi Baru
        </x-button>

    </div>


    {{-- ========================================================= --}}
    {{-- OVERVIEW BANNER --}}
    {{-- ========================================================= --}}

    <div class="overview-banner mb-4">

        <div class="overview-content">

            <div class="overview-icon">
                <x-icon name="lucide:sprout" />
            </div>

            <div>

                <div class="overview-title">
                    Ringkasan {{ $dashboard['periode'] }}
                </div>

                <div class="overview-text">
                    Pantau pemasukan, pengeluaran, transaksi,
                    dan stok produk dalam satu tempat.
                </div>

            </div>

        </div>


        <x-button
            variant="success-soft"
            :href="route('laporan-keuangan.index')"
        >
            <x-icon name="lucide:chart-no-axes-combined" />
            Lihat Laporan
        </x-button>

    </div>


    {{-- ========================================================= --}}
    {{-- STATISTIK --}}
    {{-- ========================================================= --}}

    <div class="row g-3 mb-4">

        {{-- TRANSAKSI --}}
        <div class="col-sm-6 col-xl-3">

            <x-card>

                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-icon green">
                            <x-icon name="lucide:shopping-cart" />
                        </div>

                        <span class="stat-period">
                            Bulan ini
                        </span>

                    </div>


                    <div class="stat-value">

                        {{ number_format($dashboard['jumlahTransaksi']) }}

                    </div>


                    <div class="stat-label">
                        Transaksi Penjualan
                    </div>

                </div>

            </x-card>

        </div>


        {{-- PENDAPATAN --}}
        <div class="col-sm-6 col-xl-3">

            <x-card>

                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-icon income">
                            <x-icon name="lucide:arrow-up-right" />
                        </div>

                        <span class="stat-period">
                            Bulan ini
                        </span>

                    </div>


                    <div class="stat-value">

                        Rp {{ number_format(
                            $dashboard['totalPendapatan'],
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>


                    <div class="stat-label">
                        Total Pendapatan
                    </div>

                </div>

            </x-card>

        </div>


        {{-- PENGELUARAN --}}
        <div class="col-sm-6 col-xl-3">

            <x-card>

                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-icon expense">
                            <x-icon name="lucide:arrow-down-right" />
                        </div>

                        <span class="stat-period">
                            Bulan ini
                        </span>

                    </div>


                    <div class="stat-value">

                        Rp {{ number_format(
                            $dashboard['totalPengeluaran'],
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>


                    <div class="stat-label">
                        Total Pengeluaran
                    </div>

                </div>

            </x-card>

        </div>


        {{-- SALDO --}}
        <div class="col-sm-6 col-xl-3">

            <x-card>

                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-icon balance">
                            <x-icon name="lucide:wallet" />
                        </div>

                        <span
                            class="balance-status
                            {{ $dashboard['saldoBersih'] >= 0
                                ? 'positive'
                                : 'negative' }}"
                        >
                            {{ $dashboard['saldoBersih'] >= 0
                                ? 'Positif'
                                : 'Minus' }}
                        </span>

                    </div>


                    <div
                        class="stat-value
                        {{ $dashboard['saldoBersih'] >= 0
                            ? 'text-positive'
                            : 'text-negative' }}"
                    >

                        Rp {{ number_format(
                            $dashboard['saldoBersih'],
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>


                    <div class="stat-label">
                        Saldo Bersih
                    </div>

                </div>

            </x-card>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <div class="row g-3">


        {{-- ===================================================== --}}
        {{-- TRANSAKSI TERBARU --}}
        {{-- ===================================================== --}}

        <div class="col-xl-8">

            <x-card>

                <div class="section-header">

                    <div>

                        <h5 class="section-title">
                            Transaksi Terbaru
                        </h5>

                        <p class="section-description">
                            Transaksi penjualan terbaru pada sistem.
                        </p>

                    </div>

                    <a
                        href="{{ route('transaksi.index') }}"
                        class="section-link"
                    >
                        Lihat semua
                        <x-icon name="lucide:arrow-right" />
                    </a>

                </div>


                @if($dashboard['transaksiTerbaru']->count())

                    <x-table>

                        <thead>

                            <tr>
                                <th>No. Transaksi</th>
                                <th>Tanggal</th>
                                <th>Kasir</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach($dashboard['transaksiTerbaru'] as $transaksi)

                                <tr>

                                    <td>

                                        <div class="transaction-code">

                                            <span class="transaction-icon">
                                                <x-icon name="lucide:receipt-text" />
                                            </span>

                                            <span>
                                                {{ $transaksi->nomor_transaksi }}
                                            </span>

                                        </div>

                                    </td>


                                    <td>

                                        <span class="table-muted">

                                            {{ $transaksi->tanggal_transaksi
                                                ->format('d/m/Y H:i') }}

                                        </span>

                                    </td>


                                    <td>

                                        <div class="cashier-name">

                                            <span class="cashier-avatar">
                                                <x-icon name="lucide:user-round" />
                                            </span>

                                            {{ $transaksi->user->nama ?? '-' }}

                                        </div>

                                    </td>


                                    <td>

                                        <strong>

                                            Rp {{ number_format(
                                                $transaksi->total,
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                        </strong>

                                    </td>


                                    <td>

                                        <x-badge variant="success">
                                            Selesai
                                        </x-badge>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </x-table>

                @else

                    <div class="dashboard-empty">

                        <div class="dashboard-empty-icon">
                            <x-icon name="lucide:shopping-cart" />
                        </div>

                        <strong>
                            Belum ada transaksi
                        </strong>

                        <p>
                            Belum ada transaksi selesai pada bulan ini.
                        </p>

                        <x-button
                            variant="success-soft"
                            :href="route('transaksi.create')"
                        >
                            <x-icon name="lucide:plus" />
                            Buat Transaksi
                        </x-button>

                    </div>

                @endif

            </x-card>

        </div>


        {{-- ===================================================== --}}
        {{-- STOK MENIPIS --}}
        {{-- ===================================================== --}}

        <div class="col-xl-4">

            <x-card>

                <div class="section-header">

                    <div>

                        <h5 class="section-title">
                            Stok Menipis
                        </h5>

                        <p class="section-description">
                            Produk yang perlu diperhatikan.
                        </p>

                    </div>

                    <a
                        href="{{ route('produk.index') }}"
                        class="section-link"
                    >
                        Produk
                    </a>

                </div>


                @if($dashboard['stokMenipis']->count())

                    <div class="stock-list">

                        @foreach($dashboard['stokMenipis'] as $produk)

                            <div class="stock-item">

                                <div class="stock-product">

                                    <div class="stock-product-icon">
                                        <x-icon name="lucide:leaf" />
                                    </div>

                                    <div>

                                        <div class="stock-name">
                                            {{ $produk->nama_produk }}
                                        </div>

                                        <div class="stock-price">
                                            Rp {{ number_format(
                                                $produk->harga,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </div>

                                    </div>

                                </div>


                                @if($produk->stok <= 0)

                                    <x-badge variant="danger">
                                        Habis
                                    </x-badge>

                                @elseif($produk->stok <= 5)

                                    <x-badge variant="danger">
                                        {{ $produk->stok }} stok
                                    </x-badge>

                                @else

                                    <x-badge variant="warning">
                                        {{ $produk->stok }} stok
                                    </x-badge>

                                @endif

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="dashboard-empty compact">

                        <div class="dashboard-empty-icon">
                            <x-icon name="lucide:package-check" />
                        </div>

                        <strong>
                            Stok aman
                        </strong>

                        <p>
                            Semua produk masih tersedia.
                        </p>

                    </div>

                @endif

            </x-card>

        </div>


        {{-- ===================================================== --}}
        {{-- RINGKASAN KEUANGAN --}}
        {{-- ===================================================== --}}

        <div class="col-12">

            <x-card>

                <div class="section-header">

                    <div>

                        <h5 class="section-title">
                            Ringkasan Keuangan
                        </h5>

                        <p class="section-description">
                            Kondisi keuangan pada {{ $dashboard['periode'] }}.
                        </p>

                    </div>

                    <a
                        href="{{ route('laporan-keuangan.index') }}"
                        class="section-link"
                    >
                        Laporan Keuangan
                        <x-icon name="lucide:arrow-right" />
                    </a>

                </div>


                <div class="row g-3">

                    {{-- PENDAPATAN --}}

                    <div class="col-md-4">

                        <div class="finance-box income">

                            <div class="finance-box-icon">
                                <x-icon name="lucide:arrow-up-right" />
                            </div>

                            <div>

                                <span class="finance-box-label">
                                    Total Pendapatan
                                </span>

                                <strong>
                                    Rp {{ number_format(
                                        $dashboard['totalPendapatan'],
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </strong>

                            </div>

                        </div>

                    </div>


                    {{-- PENGELUARAN --}}

                    <div class="col-md-4">

                        <div class="finance-box expense">

                            <div class="finance-box-icon">
                                <x-icon name="lucide:arrow-down-right" />
                            </div>

                            <div>

                                <span class="finance-box-label">
                                    Total Pengeluaran
                                </span>

                                <strong>
                                    Rp {{ number_format(
                                        $dashboard['totalPengeluaran'],
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </strong>

                            </div>

                        </div>

                    </div>


                    {{-- SALDO --}}

                    <div class="col-md-4">

                        <div
                            class="finance-box
                            {{ $dashboard['saldoBersih'] >= 0
                                ? 'balance'
                                : 'negative' }}"
                        >

                            <div class="finance-box-icon">
                                <x-icon name="lucide:wallet-cards" />
                            </div>

                            <div>

                                <span class="finance-box-label">
                                    Saldo Bersih
                                </span>

                                <strong>
                                    Rp {{ number_format(
                                        $dashboard['saldoBersih'],
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </x-card>

        </div>

    </div>


    <style>

        /* =========================================================
           HEADER
        ========================================================= */

        .dashboard-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            gap: 24px;

            margin-bottom: 22px;
        }


        .dashboard-greeting {
            margin-bottom: 3px;

            color: #2e7d32;

            font-size: 12px;
            font-weight: 600;
        }


        .dashboard-title {
            margin: 0;

            color: #26352a;

            font-size: 28px;
            font-weight: 750;

            letter-spacing: -0.02em;
        }


        .dashboard-description {
            margin: 6px 0 0;

            color: #8a948d;

            font-size: 13px;
        }


        /* =========================================================
           OVERVIEW
        ========================================================= */

        .overview-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 17px 18px;

            border: 1px solid rgba(46, 125, 50, .11);

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #f1f8f2 0%,
                    #f8fbf8 100%
                );
        }


        .overview-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }


        .overview-icon {
            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 11px;

            background: #dceedd;
            color: #2e7d32;
        }


        .overview-icon iconify-icon {
            font-size: 21px;
        }


        .overview-title {
            margin-bottom: 2px;

            color: #344238;

            font-size: 13px;
            font-weight: 700;
        }


        .overview-text {
            color: #7d8780;

            font-size: 12px;
        }


        /* =========================================================
           STATISTIC
        ========================================================= */

        .stat-card {
            position: relative;

            min-height: 138px;
        }


        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 15px;
        }


        .stat-icon {
            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;
        }


        .stat-icon iconify-icon {
            font-size: 20px;
        }


        .stat-icon.green {
            background: #eaf5ec;
            color: #2e7d32;
        }


        .stat-icon.income {
            background: #eaf5ec;
            color: #198754;
        }


        .stat-icon.expense {
            background: #fff0f0;
            color: #d32f2f;
        }


        .stat-icon.balance {
            background: #eef4ff;
            color: #2563eb;
        }


        .stat-period {
            padding: 4px 8px;

            border-radius: 20px;

            background: #f5f6f5;

            color: #9aa19c;

            font-size: 10px;
        }


        .stat-value {
            color: #26352a;

            font-size: 21px;
            font-weight: 750;

            line-height: 1.25;
        }


        .stat-value.text-positive {
            color: #2e7d32;
        }


        .stat-value.text-negative {
            color: #d32f2f;
        }


        .stat-label {
            margin-top: 3px;

            color: #8a948d;

            font-size: 12px;
        }


        .balance-status {
            padding: 4px 8px;

            border-radius: 20px;

            font-size: 10px;
            font-weight: 600;
        }


        .balance-status.positive {
            background: #eaf5ec;
            color: #2e7d32;
        }


        .balance-status.negative {
            background: #fff0f0;
            color: #d32f2f;
        }


        /* =========================================================
           SECTION
        ========================================================= */

        .section-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 18px;
        }


        .section-title {
            margin: 0;

            color: #344238;

            font-size: 15px;
            font-weight: 700;
        }


        .section-description {
            margin: 4px 0 0;

            color: #9aa19c;

            font-size: 11px;
        }


        .section-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;

            flex-shrink: 0;

            color: #2e7d32;

            text-decoration: none;

            font-size: 11px;
            font-weight: 600;
        }


        .section-link:hover {
            color: #1b5e20;
        }


        .section-link iconify-icon {
            font-size: 14px;
        }


        /* =========================================================
           TRANSACTION
        ========================================================= */

        .transaction-code {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }


        .transaction-icon {
            width: 30px;
            height: 30px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 8px;

            background: #eaf5ec;
            color: #2e7d32;
        }


        .transaction-icon iconify-icon {
            font-size: 15px;
        }


        .table-muted {
            color: #7d8780;
        }


        .cashier-name {
            display: flex;
            align-items: center;
            gap: 7px;
        }


        .cashier-avatar {
            width: 27px;
            height: 27px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #f1f4f2;
            color: #6b7280;
        }


        .cashier-avatar iconify-icon {
            font-size: 14px;
        }


        /* =========================================================
           EMPTY
        ========================================================= */

        .dashboard-empty {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;

            padding: 48px 20px;

            color: #9aa19c;

            text-align: center;
        }


        .dashboard-empty.compact {
            padding: 42px 20px;
        }


        .dashboard-empty-icon {
            width: 56px;
            height: 56px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 11px;

            border-radius: 15px;

            background: #eaf5ec;
            color: #74a878;
        }


        .dashboard-empty-icon iconify-icon {
            font-size: 25px;
        }


        .dashboard-empty strong {
            margin-bottom: 4px;

            color: #4b5563;

            font-size: 14px;
        }


        .dashboard-empty p {
            margin: 0 0 14px;

            color: #9aa19c;

            font-size: 12px;
        }


        /* =========================================================
           STOCK
        ========================================================= */

        .stock-list {
            display: flex;
            flex-direction: column;
        }


        .stock-item {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 12px;

            padding: 10px 0;

            border-bottom: 1px solid #eef1ee;
        }


        .stock-item:last-child {
            border-bottom: none;
        }


        .stock-product {
            display: flex;
            align-items: center;
            gap: 9px;

            min-width: 0;
        }


        .stock-product-icon {
            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 9px;

            background: #edf7ee;
            color: #4b9550;
        }


        .stock-product-icon iconify-icon {
            font-size: 17px;
        }


        .stock-name {
            overflow: hidden;

            color: #344238;

            font-size: 12px;
            font-weight: 600;

            text-overflow: ellipsis;
            white-space: nowrap;
        }


        .stock-price {
            margin-top: 2px;

            color: #9aa19c;

            font-size: 10px;
        }


        /* =========================================================
           FINANCE
        ========================================================= */

        .finance-box {
            display: flex;
            align-items: center;
            gap: 12px;

            min-height: 82px;

            padding: 14px;

            border: 1px solid transparent;

            border-radius: 12px;
        }


        .finance-box.income {
            background: #f1f8f2;
            border-color: #dceedd;
        }


        .finance-box.expense {
            background: #fff4f4;
            border-color: #f6dddd;
        }


        .finance-box.balance {
            background: #f1f6ff;
            border-color: #dce7fb;
        }


        .finance-box.negative {
            background: #fff4f4;
            border-color: #f6dddd;
        }


        .finance-box-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 10px;

            background: rgba(255, 255, 255, .7);

            color: #2e7d32;
        }


        .finance-box.expense .finance-box-icon,
        .finance-box.negative .finance-box-icon {
            color: #d32f2f;
        }


        .finance-box.balance .finance-box-icon {
            color: #2563eb;
        }


        .finance-box-icon iconify-icon {
            font-size: 18px;
        }


        .finance-box-label {
            display: block;

            margin-bottom: 3px;

            color: #7d8780;

            font-size: 11px;
        }


        .finance-box strong {
            display: block;

            color: #26352a;

            font-size: 16px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 768px) {

            .dashboard-header {
                align-items: flex-start;

                flex-direction: column;
            }


            .overview-banner {
                align-items: flex-start;

                flex-direction: column;
            }


            .overview-banner .ui-button {
                width: 100%;
            }

        }


        @media (max-width: 576px) {

            .dashboard-title {
                font-size: 24px;
            }


            .dashboard-description {
                line-height: 1.5;
            }


            .section-header {
                align-items: flex-start;

                flex-direction: column;
            }


            .section-link {
                align-self: flex-end;
            }

        }

    </style>

</x-layout>