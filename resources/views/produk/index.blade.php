<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produk - Sistem Kasir Hidroponik</title>

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

        .card {
            border: none;
            border-radius: 16px;
        }

        .table {
            vertical-align: middle;
        }

        .table thead th {
            font-size: 14px;
            color: #6c757d;
            font-weight: 600;
            border-bottom: 1px solid #dee2e6;
        }

        .table tbody td {
            padding-top: 16px;
            padding-bottom: 16px;
        }

        .product-name {
            font-weight: 600;
        }

        .btn {
            border-radius: 8px;
        }

        .empty-state {
            padding: 50px 20px;
            text-align: center;
            color: #6c757d;
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

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h2 class="page-title mb-1">
                        Produk
                    </h2>

                    <p class="text-muted mb-0">
                        Kelola data produk hidroponik dan stok yang tersedia.
                    </p>
                </div>

                <a
                    href="{{ route('produk.create') }}"
                    class="btn btn-success px-4"
                >
                    + Tambah Produk
                </a>

            </div>


            <!-- SUCCESS MESSAGE -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>
                </div>
            @endif


            <!-- PRODUCT TABLE -->
            <div class="card shadow-sm">

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table mb-0">

                            <thead>
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th class="text-center pe-4">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($produk as $item)

                                    <tr>

                                        <td class="ps-4">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            <div class="product-name">
                                                {{ $item->nama_produk }}
                                            </div>
                                        </td>

                                        <td>
                                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                                        </td>

                                        <td>

                                            @if ($item->stok <= 10 && $item->status)
                                                <span class="text-danger fw-semibold">
                                                    {{ $item->stok }}
                                                </span>

                                                <small class="text-danger">
                                                    (Stok rendah)
                                                </small>
                                            @else
                                                {{ $item->stok }}
                                            @endif

                                        </td>

                                        <td>

                                            @if ($item->status)

                                                <span class="badge bg-success">
                                                    Aktif
                                                </span>

                                            @else

                                                <span class="badge bg-secondary">
                                                    Tidak Aktif
                                                </span>

                                            @endif

                                        </td>

                                        <td class="text-center pe-4">

                                            <a
                                                href="{{ route('produk.edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-primary"
                                            >
                                                Edit
                                            </a>


                                            @if ($item->status)

                                                <form
                                                    action="{{ route('produk.deactivate', $item->id) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                >
                                                    @csrf
                                                    @method('PUT')

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Yakin ingin menonaktifkan produk ini?')"
                                                    >
                                                        Nonaktifkan
                                                    </button>

                                                </form>

                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6">

                                            <div class="empty-state">

                                                <div class="fs-1 mb-3">
                                                    📦
                                                </div>

                                                <h5>
                                                    Belum ada produk
                                                </h5>

                                                <p class="mb-3">
                                                    Tambahkan produk hidroponik pertama kamu.
                                                </p>

                                                <a
                                                    href="{{ route('produk.create') }}"
                                                    class="btn btn-success"
                                                >
                                                    + Tambah Produk
                                                </a>

                                            </div>

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
</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>