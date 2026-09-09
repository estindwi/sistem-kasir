<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Produk - Sistem Kasir Hidroponik</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background-color: #f5f7f6;
        }

        .sidebar {
            min-height: 100vh;
            background: #198754;
        }

        .brand {
            color: white;
            font-size: 20px;
            font-weight: 700;
        }

        .sidebar a {
            color: rgba(255,255,255,.85);
            text-decoration: none;
            display: block;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255,255,255,.15);
            color: white;
        }

        .content {
            padding: 30px;
        }

        .page-title {
            font-weight: 700;
        }

        .form-card {
            border: none;
            border-radius: 16px;
        }

        .btn {
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3 col-lg-2 sidebar p-3">

            <div class="brand mb-4">
                🌱 Hidroponik
            </div>

            <small class="text-white-50">MENU UTAMA</small>

            <div class="mt-2">

                <a href="{{ route('dashboard') }}">
                    📊 Dashboard
                </a>

                <a href="{{ route('produk.index') }}" class="active">
                    📦 Produk
                </a>

                <a href="#">
                    🛒 Transaksi Penjualan
                </a>

                <a href="#">
                    💸 Pengeluaran
                </a>

                <a href="#">
                    📈 Laporan Keuangan
                </a>

            </div>

            <hr class="text-white">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button class="btn btn-outline-light w-100">
                    Keluar
                </button>
            </form>

        </div>


        <!-- CONTENT -->
        <div class="col-md-9 col-lg-10 content">

            <div class="mb-4">
                <h2 class="page-title mb-1">
                    Edit Produk
                </h2>

                <p class="text-muted mb-0">
                    Perbarui informasi produk hidroponik.
                </p>
            </div>


            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>Periksa kembali input:</strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="card form-card shadow-sm">

                <div class="card-body p-4">

                    <form
                        action="{{ route('produk.update', $produk->id) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div class="mb-3">

                            <label
                                for="nama_produk"
                                class="form-label fw-semibold"
                            >
                                Nama Produk
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="nama_produk"
                                name="nama_produk"
                                value="{{ old('nama_produk', $produk->nama_produk) }}"
                                required
                            >

                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label
                                    for="harga"
                                    class="form-label fw-semibold"
                                >
                                    Harga
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        class="form-control"
                                        id="harga"
                                        name="harga"
                                        value="{{ old('harga', $produk->harga) }}"
                                        min="0"
                                        step="0.01"
                                        required
                                    >

                                </div>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label
                                    for="stok"
                                    class="form-label fw-semibold"
                                >
                                    Stok
                                </label>

                                <input
                                    type="number"
                                    class="form-control"
                                    id="stok"
                                    name="stok"
                                    value="{{ old('stok', $produk->stok) }}"
                                    min="0"
                                    required
                                >

                            </div>

                        </div>


                        <div class="mb-3">

                            <label
                                for="status"
                                class="form-label fw-semibold"
                            >
                                Status Produk
                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-select"
                            >

                                <option
                                    value="1"
                                    {{ $produk->status ? 'selected' : '' }}
                                >
                                    Aktif
                                </option>

                                <option
                                    value="0"
                                    {{ !$produk->status ? 'selected' : '' }}
                                >
                                    Tidak Aktif
                                </option>

                            </select>

                        </div>


                        <div class="d-flex justify-content-end gap-2 mt-4">

                            <a
                                href="{{ route('produk.index') }}"
                                class="btn btn-light border px-4"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="btn btn-success px-4"
                            >
                                Simpan Perubahan
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