<x-layout active="dashboard">

    <x-breadcrumb
        :items="[
            ['label' => 'Dashboard']
        ]"
    />

    <x-page-header
        title="Dashboard"
        description="Ringkasan aktivitas sistem kasir hidroponik bulan {{ $dashboard['periode'] }}."
    >
        <x-button
            variant="success"
            :href="route('transaksi.create')"
        >
            <x-icon name="lucide:plus" />
            Transaksi Baru
        </x-button>
    </x-page-header>


    {{-- =========================
        STATISTIC
    ========================== --}}

    <div class="row g-4 mb-4">

        {{-- TRANSAKSI --}}
        <div class="col-sm-6 col-xl-3">

            <x-card>

                <div class="dashboard-stat">

                    <div class="dashboard-stat-icon green">
                        <x-icon name="lucide:shopping-cart" />
                    </div>

                    <div>

                        <div class="dashboard-stat-label">
                            Transaksi
                        </div>

                        <div class="dashboard-stat-value">
                            {{ number_format($dashboard['jumlahTransaksi']) }}
                        </div>

                        <div class="dashboard-stat-description">
                            Bulan ini
                        </div>

                    </div>

                </div>

            </x-card>

        </div>


        {{-- PENDAPATAN --}}
        <div class="col-sm-6 col-xl-3">

            <x-card>

                <div class="dashboard-stat">

                    <div class="dashboard-stat-icon green">
                        <x-icon name="lucide:trending-up" />
                    </div>

                    <div>

                        <div class="dashboard-stat-label">
                            Pendapatan
                        </div>

                        <div class="dashboard-stat-value">
                            Rp {{ number_format($dashboard['totalPendapatan'], 0, ',', '.') }}
                        </div>

                        <div class="dashboard-stat-description">
                            Bulan ini
                        </div>

                    </div>

                </div>

            </x-card>

        </div>


        {{-- PENGELUARAN --}}
        <div class="col-sm-6 col-xl-3">

            <x-card>

                <div class="dashboard-stat">

                    <div class="dashboard-stat-icon warning">
                        <x-icon name="lucide:trending-down" />
                    </div>

                    <div>

                        <div class="dashboard-stat-label">
                            Pengeluaran
                        </div>

                        <div class="dashboard-stat-value">
                            Rp {{ number_format($dashboard['totalPengeluaran'], 0, ',', '.') }}
                        </div>

                        <div class="dashboard-stat-description">
                            Bulan ini
                        </div>

                    </div>

                </div>

            </x-card>

        </div>


        {{-- SALDO --}}
        <div class="col-sm-6 col-xl-3">

            <x-card>

                <div class="dashboard-stat">

                    <div class="dashboard-stat-icon {{ $dashboard['saldoBersih'] >= 0 ? 'green' : 'danger' }}">
                        <x-icon name="lucide:wallet" />
                    </div>

                    <div>

                        <div class="dashboard-stat-label">
                            Saldo Bersih
                        </div>

                        <div class="dashboard-stat-value">
                            Rp {{ number_format($dashboard['saldoBersih'], 0, ',', '.') }}
                        </div>

                        <div class="dashboard-stat-description">
                            Pendapatan - Pengeluaran
                        </div>

                    </div>

                </div>

            </x-card>

        </div>

    </div>


    {{-- =========================
        MAIN CONTENT
    ========================== --}}

    <div class="row g-4">


        {{-- TRANSAKSI TERBARU --}}
        <div class="col-xl-8">

            <x-card title="Transaksi Terbaru">

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
                                        <span class="fw-semibold">
                                            {{ $transaksi->nomor_transaksi }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $transaksi->tanggal_transaksi->format('d/m/Y H:i') }}
                                    </td>

                                    <td>
                                        {{ $transaksi->user->nama ?? '-' }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($transaksi->total, 0, ',', '.') }}
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

                        <x-icon name="lucide:shopping-cart" />

                        <p>
                            Belum ada transaksi selesai bulan ini.
                        </p>

                    </div>

                @endif

            </x-card>

        </div>


        {{-- STOK MENIPIS --}}
        <div class="col-xl-4">

            <x-card title="Stok Menipis">

                @if($dashboard['stokMenipis']->count())

                    <div class="stock-list">

                        @foreach($dashboard['stokMenipis'] as $produk)

                            <div class="stock-item">

                                <div class="stock-info">

                                    <div class="stock-name">
                                        {{ $produk->nama_produk }}
                                    </div>

                                    <div class="stock-price">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
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

                    <div class="dashboard-empty">

                        <x-icon name="lucide:package-check" />

                        <p>
                            Semua stok masih aman.
                        </p>

                    </div>

                @endif

            </x-card>

        </div>


        {{-- RINGKASAN KEUANGAN --}}
        <div class="col-12">

            <x-card title="Ringkasan Keuangan">

                <div class="row g-4">

                    <div class="col-md-4">

                        <div class="finance-summary green">

                            <div class="finance-icon">
                                <x-icon name="lucide:arrow-up-right" />
                            </div>

                            <div>

                                <div class="finance-label">
                                    Total Pendapatan
                                </div>

                                <div class="finance-value">
                                    Rp {{ number_format($dashboard['totalPendapatan'], 0, ',', '.') }}
                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="finance-summary warning">

                            <div class="finance-icon">
                                <x-icon name="lucide:arrow-down-right" />
                            </div>

                            <div>

                                <div class="finance-label">
                                    Total Pengeluaran
                                </div>

                                <div class="finance-value">
                                    Rp {{ number_format($dashboard['totalPengeluaran'], 0, ',', '.') }}
                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="finance-summary {{ $dashboard['saldoBersih'] >= 0 ? 'green' : 'danger' }}">

                            <div class="finance-icon">
                                <x-icon name="lucide:wallet-cards" />
                            </div>

                            <div>

                                <div class="finance-label">
                                    Saldo Bersih
                                </div>

                                <div class="finance-value">
                                    Rp {{ number_format($dashboard['saldoBersih'], 0, ',', '.') }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </x-card>

        </div>

    </div>


    <style>

        /* =========================
           STAT
        ========================== */

        .dashboard-stat {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .dashboard-stat-icon {
            width: 44px;
            height: 44px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            font-size: 20px;
        }

        .dashboard-stat-icon.green {
            background: rgba(46, 125, 50, .10);
            color: #2E7D32;
        }

        .dashboard-stat-icon.warning {
            background: rgba(200, 155, 60, .10);
            color: #A97A16;
        }

        .dashboard-stat-icon.danger {
            background: rgba(217, 83, 79, .08);
            color: #C9302C;
        }

        .dashboard-stat-label {
            font-size: 12px;
            color: #8a9198;
            margin-bottom: 3px;
        }

        .dashboard-stat-value {
            font-size: 20px;
            font-weight: 700;
            color: #26352a;
            line-height: 1.2;
        }

        .dashboard-stat-description {
            font-size: 11px;
            color: #9ba29d;
            margin-top: 3px;
        }


        /* =========================
           TABLE
        ========================== */

        .dashboard-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 40px 20px;

            color: #9aa19c;
            text-align: center;
        }

        .dashboard-empty iconify-icon {
            font-size: 34px;
            margin-bottom: 10px;
            color: #A5D6A7;
        }

        .dashboard-empty p {
            margin: 0;
            font-size: 13px;
        }


        /* =========================
           STOCK
        ========================== */

        .stock-list {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .stock-item {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 12px 0;

            border-bottom: 1px solid #eef1ee;
        }

        .stock-item:last-child {
            border-bottom: none;
        }

        .stock-name {
            font-size: 13px;
            font-weight: 600;
            color: #344238;
        }

        .stock-price {
            margin-top: 3px;
            font-size: 11px;
            color: #9aa19c;
        }


        /* =========================
           FINANCE
        ========================== */

        .finance-summary {
            display: flex;
            align-items: center;
            gap: 12px;

            min-height: 82px;

            padding: 15px;

            border-radius: 12px;

            border: 1px solid transparent;
        }

        .finance-summary.green {
            background: rgba(46, 125, 50, .07);
            border-color: rgba(46, 125, 50, .14);
        }

        .finance-summary.warning {
            background: rgba(200, 155, 60, .08);
            border-color: rgba(200, 155, 60, .16);
        }

        .finance-summary.danger {
            background: rgba(217, 83, 79, .07);
            border-color: rgba(217, 83, 79, .15);
        }

        .finance-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 10px;

            background: rgba(255,255,255,.55);

            font-size: 18px;
            color: #2E7D32;
        }

        .finance-summary.warning .finance-icon {
            color: #A97A16;
        }

        .finance-summary.danger .finance-icon {
            color: #C9302C;
        }

        .finance-label {
            font-size: 11px;
            color: #7d8780;
        }

        .finance-value {
            margin-top: 3px;

            font-size: 16px;
            font-weight: 700;

            color: #26352a;
        }

    </style>

</x-layout>