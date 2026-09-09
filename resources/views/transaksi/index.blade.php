<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Sistem Kasir Hidroponik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="bg-success text-white p-3 min-vh-100" style="width: 250px;">

        <h4 class="mb-4">Kasir Hidroponik</h4>

        <div class="mb-4">
            <small>Selamat datang,</small>
            <br>
            <strong>{{ auth()->user()->nama }}</strong>
        </div>

        <div class="nav flex-column">

            <a href="{{ route('dashboard') }}"
               class="nav-link text-white mb-2">
                🏠 Dashboard
            </a>

            <a href="{{ route('produk.index') }}"
               class="nav-link text-white mb-2">
                📦 Produk
            </a>

            <a href="{{ route('transaksi.index') }}"
               class="nav-link active bg-white text-success rounded mb-2">
                🛒 Transaksi
            </a>

            <a href="#"
               class="nav-link text-white mb-2">
                💸 Pengeluaran
            </a>

            <a href="#"
               class="nav-link text-white mb-2">
                📊 Laporan
            </a>

        </div>

        <hr>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="btn btn-light w-100">
                Logout
            </button>
        </form>

    </div>


    <!-- CONTENT -->
    <div class="flex-grow-1 p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2>Transaksi Penjualan</h2>
                <p class="text-muted mb-0">
                    Riwayat transaksi penjualan hidroponik
                </p>
            </div>

            <a href="{{ route('transaksi.create') }}"
               class="btn btn-success">
                + Buat Transaksi
            </a>

        </div>


        <!-- PESAN SUCCESS -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <!-- TABEL TRANSAKSI -->
        <div class="card shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-success">

                            <tr>
                                <th>No</th>
                                <th>Nomor Transaksi</th>
                                <th>Tanggal</th>
                                <th>Kasir</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($transaksi as $item)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $item->nomor_transaksi }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $item->tanggal_transaksi->format('d-m-Y H:i') }}
                                    </td>

                                    <td>
                                        {{ $item->user->nama ?? '-' }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($item->total, 0, ',', '.') }}
                                    </td>

                                    <td>

                                        <a href="{{ route('transaksi.show', $item->id) }}"
                                           class="btn btn-sm btn-outline-success">
                                            Detail
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6"
                                        class="text-center text-muted py-4">

                                        Belum ada transaksi penjualan.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>