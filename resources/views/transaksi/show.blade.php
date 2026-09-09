<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Transaksi - Sistem Kasir Hidroponik</title>

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

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h3 class="mb-1">
                        Detail Transaksi
                    </h3>

                    <p class="text-muted mb-0">
                        {{ $transaksi->nomor_transaksi }}
                    </p>
                </div>

                <a
                    href="{{ route('transaksi.index') }}"
                    class="btn btn-secondary"
                >
                    ← Kembali
                </a>

            </div>


            <!-- Pesan sukses -->
            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif


            <!-- Error -->
            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- Informasi Transaksi -->
            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <div class="row">

                        <!-- Nomor Transaksi -->
                        <div class="col-md-3">

                            <small class="text-muted">
                                Nomor Transaksi
                            </small>

                            <h6>
                                {{ $transaksi->nomor_transaksi }}
                            </h6>

                        </div>


                        <!-- Tanggal -->
                        <div class="col-md-3">

                            <small class="text-muted">
                                Tanggal
                            </small>

                            <h6>
                                {{ $transaksi->tanggal_transaksi->format('d/m/Y H:i') }}
                            </h6>

                        </div>


                        <!-- Kasir -->
                        <div class="col-md-3">

                            <small class="text-muted">
                                Kasir
                            </small>

                            <h6>
                                {{ $transaksi->user->nama ?? '-' }}
                            </h6>

                        </div>


                        <!-- Status -->
                        <div class="col-md-3">

                            <small class="text-muted">
                                Status
                            </small>

                            <h6>

                                @if($transaksi->status === 'completed')

                                    <span class="badge bg-success">
                                        Selesai
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        Draft
                                    </span>

                                @endif

                            </h6>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ===================================== -->
            <!-- TAMBAH PRODUK -->
            <!-- Hanya muncul jika transaksi belum selesai -->
            <!-- ===================================== -->

            @if($transaksi->status !== 'completed')

                <div class="card shadow-sm mb-4">

                    <div class="card-header bg-white">

                        <h5 class="mb-0">
                            Tambah Produk
                        </h5>

                    </div>


                    <div class="card-body">

                        <form
                            action="{{ route('transaksi.addDetail', $transaksi->id) }}"
                            method="POST"
                        >

                            @csrf


                            <div class="row align-items-end">

                                <!-- Produk -->
                                <div class="col-md-7 mb-3">

                                    <label
                                        for="produk_id"
                                        class="form-label"
                                    >
                                        Produk
                                    </label>


                                    <select
                                        name="produk_id"
                                        id="produk_id"
                                        class="form-select"
                                        required
                                    >

                                        <option value="">
                                            -- Pilih Produk --
                                        </option>


                                        @foreach($produk as $item)

                                            <option value="{{ $item->id }}">

                                                {{ $item->nama_produk }}

                                                -
                                                Rp
                                                {{ number_format($item->harga, 0, ',', '.') }}

                                                (Stok:
                                                {{ $item->stok }})

                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                <!-- Jumlah -->
                                <div class="col-md-3 mb-3">

                                    <label
                                        for="jumlah"
                                        class="form-label"
                                    >
                                        Jumlah
                                    </label>


                                    <input
                                        type="number"
                                        name="jumlah"
                                        id="jumlah"
                                        class="form-control"
                                        min="1"
                                        value="1"
                                        required
                                    >

                                </div>


                                <!-- Tombol Tambah -->
                                <div class="col-md-2 mb-3">

                                    <button
                                        type="submit"
                                        class="btn btn-success w-100"
                                    >
                                        + Tambah
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            @endif


            <!-- ===================================== -->
            <!-- DETAIL PRODUK -->
            <!-- ===================================== -->

            <div class="card shadow-sm mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Detail Produk
                    </h5>

                </div>


                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>
                                        No
                                    </th>

                                    <th>
                                        Produk
                                    </th>

                                    <th>
                                        Harga Satuan
                                    </th>

                                    <th>
                                        Jumlah
                                    </th>

                                    <th>
                                        Subtotal
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($transaksi->details as $index => $detail)

                                    <tr>

                                        <td>
                                            {{ $index + 1 }}
                                        </td>


                                        <td>
                                            {{ $detail->produk->nama_produk }}
                                        </td>


                                        <td>

                                            Rp
                                            {{ number_format($detail->harga_satuan, 0, ',', '.') }}

                                        </td>


                                        <td>
                                            {{ $detail->jumlah }}
                                        </td>


                                        <td>

                                            Rp
                                            {{ number_format($detail->subtotal, 0, ',', '.') }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="5"
                                            class="text-center text-muted py-4"
                                        >
                                            Belum ada produk dalam transaksi.
                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            <!-- ===================================== -->
            <!-- TOTAL -->
            <!-- ===================================== -->

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <h4 class="mb-0">
                            Total
                        </h4>


                        <h3 class="mb-0 text-success">

                            Rp
                            {{ number_format($transaksi->total, 0, ',', '.') }}

                        </h3>

                    </div>


                    <!-- Tombol Selesaikan Transaksi -->
                    <!-- Hanya muncul jika belum selesai dan sudah ada produk -->

                    @if($transaksi->status !== 'completed' && $transaksi->details->count() > 0)

                        <div class="text-end mt-4">

                            <form
                                action="{{ route('transaksi.complete', $transaksi->id) }}"
                                method="POST"
                            >

                                @csrf

                                @method('PUT')


                                <button
                                    type="submit"
                                    class="btn btn-success"
                                >
                                    ✓ Selesaikan Transaksi
                                </button>

                            </form>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>