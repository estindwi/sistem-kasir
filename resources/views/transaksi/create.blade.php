<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Transaksi - Sistem Kasir Hidroponik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7f6;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #198754;
            color: white;
        }

        .sidebar .brand {
            font-size: 20px;
            font-weight: bold;
            padding: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .content {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 12px;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar p-0">

            <div class="brand">
                🌱 Kasir Hidroponik
            </div>

            <a href="{{ route('dashboard') }}">
                Dashboard
            </a>

            <a href="{{ route('produk.index') }}">
                Produk
            </a>

            <a href="{{ route('transaksi.index') }}" class="active">
                Transaksi Penjualan
            </a>

            <a href="#">
                Pengeluaran
            </a>

            <a href="#">
                Laporan Keuangan
            </a>

            <form action="{{ route('logout') }}" method="POST" class="mt-3 px-3">
                @csrf
                <button type="submit" class="btn btn-light w-100">
                    Logout
                </button>
            </form>

        </div>

        <!-- Content -->
        <div class="col-md-9 col-lg-10 content">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-1">Buat Transaksi Penjualan</h3>
                    <p class="text-muted mb-0">
                        Buat transaksi penjualan baru
                    </p>
                </div>

                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                    ← Kembali
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="tanggal_transaksi" class="form-label">
                                Tanggal Transaksi
                            </label>

                            <input
                                type="datetime-local"
                                name="tanggal_transaksi"
                                id="tanggal_transaksi"
                                class="form-control @error('tanggal_transaksi') is-invalid @enderror"
                                value="{{ old('tanggal_transaksi', now()->format('Y-m-d\TH:i')) }}"
                            >

                            @error('tanggal_transaksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Total
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="Rp 0"
                                disabled
                            >

                            <div class="form-text">
                                Produk dan total transaksi akan ditambahkan setelah transaksi dibuat.
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                Buat Transaksi
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>