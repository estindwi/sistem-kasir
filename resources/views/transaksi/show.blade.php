<x-layout active="transaksi">

    <x-breadcrumb
        :items="[
            ['label' => 'Transaksi', 'url' => route('transaksi.index')],
            ['label' => 'Detail Transaksi']
        ]"
    />

    {{-- HEADER --}}
    <div class="transaction-header">

        <div>
            <div class="d-flex align-items-center gap-2 mb-2">

                <h3 class="mb-0">
                    Detail Transaksi
                </h3>

                @if ($transaksi->status === 'completed')
                    <x-badge variant="success">
                        Selesai
                    </x-badge>
                @else
                    <x-badge variant="warning">
                        Draft
                    </x-badge>
                @endif

            </div>

            <p class="text-muted mb-0">
                {{ $transaksi->nomor_transaksi }}
            </p>
        </div>

        <x-button
            variant="outline-secondary"
            :href="route('transaksi.index')"
        >
            <x-icon name="lucide:arrow-left" />
            Kembali
        </x-button>

    </div>


    {{-- INFORMASI TRANSAKSI --}}
    <x-card class="mb-4">

        <div class="transaction-info">

            <div class="info-item">
                <span class="info-label">
                    Nomor Transaksi
                </span>

                <strong>
                    {{ $transaksi->nomor_transaksi }}
                </strong>
            </div>


            <div class="info-item">
                <span class="info-label">
                    Tanggal
                </span>

                <strong>
                    {{ $transaksi->tanggal_transaksi->format('d/m/Y H:i') }}
                </strong>
            </div>


            <div class="info-item">
                <span class="info-label">
                    Kasir
                </span>

                <strong>
                    {{ $transaksi->user->nama ?? '-' }}
                </strong>
            </div>


            <div class="info-item">
                <span class="info-label">
                    Status
                </span>

                @if ($transaksi->status === 'completed')
                    <x-badge variant="success">
                        Selesai
                    </x-badge>
                @else
                    <x-badge variant="warning">
                        Draft
                    </x-badge>
                @endif
            </div>

        </div>

    </x-card>


    {{-- ========================================= --}}
    {{-- DRAFT --}}
    {{-- ========================================= --}}

    @if ($transaksi->status !== 'completed')

        {{-- STEP 1 --}}
        <x-card class="mb-4">

            <div class="section-heading">

                <div class="step-number">
                    1
                </div>

                <div>
                    <h5 class="mb-1">
                        Tambah Produk
                    </h5>

                    <p class="text-muted mb-0">
                        Pilih produk dan masukkan jumlah yang dibeli.
                    </p>
                </div>

            </div>


            <form
                action="{{ route('transaksi.addDetail', $transaksi->id) }}"
                method="POST"
                class="mt-4"
            >
                @csrf

                <div class="row align-items-end">

                    <div class="col-md-7 mb-3">

                        <label
                            for="produk_id"
                            class="form-label fw-semibold"
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

                            @foreach ($produk as $item)

                                <option value="{{ $item->id }}">

                                    {{ $item->nama_produk }}
                                    —
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    (Stok: {{ $item->stok }})

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-3 mb-3">

                        <label
                            for="jumlah"
                            class="form-label fw-semibold"
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


                    <div class="col-md-2 mb-3">

                        <x-button
                            variant="success"
                            type="submit"
                            class="w-100"
                        >
                            <x-icon name="lucide:plus" />
                            Tambah
                        </x-button>

                    </div>

                </div>

            </form>


            <div class="transaction-note mt-2">

                <x-icon name="lucide:info" />

                <span>
                    Produk yang ditambahkan akan langsung mengurangi stok.
                </span>

            </div>

        </x-card>


        {{-- STEP 2 --}}
        <x-card class="mb-4">

            <div class="section-heading">

                <div class="step-number">
                    2
                </div>

                <div>
                    <h5 class="mb-1">
                        Produk dalam Transaksi
                    </h5>

                    <p class="text-muted mb-0">
                        Periksa produk dan jumlah sebelum menyelesaikan transaksi.
                    </p>
                </div>

            </div>


            <div class="mt-4">

                <x-table>

                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($transaksi->details as $index => $detail)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $detail->produk->nama_produk }}
                                    </strong>
                                </td>

                                <td>
                                    Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $detail->jumlah }}
                                </td>

                                <td>
                                    <strong>
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </strong>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5">

                                    <div class="empty-state">

                                        <div class="empty-icon">
                                            <x-icon name="lucide:shopping-cart" />
                                        </div>

                                        <div class="empty-title">
                                            Belum ada produk
                                        </div>

                                        <div class="empty-description">
                                            Tambahkan produk untuk mulai membuat transaksi.
                                        </div>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </x-table>

            </div>

        </x-card>


        {{-- TOTAL + SELESAIKAN --}}
        <x-card>

            <div class="checkout-section">

                <div>
                    <span class="total-label">
                        Total Transaksi
                    </span>

                    <div class="total-value">
                        Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                    </div>
                </div>


                @if ($transaksi->details->count() > 0)

                    <div class="checkout-action">

                        <form
                            action="{{ route('transaksi.complete', $transaksi->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PUT')

                            <x-button
                                variant="success"
                                type="submit"
                                size="lg"
                                data-confirm
                                data-confirm-title="Selesaikan transaksi?"
                                data-confirm="Setelah transaksi diselesaikan, transaksi akan dicatat sebagai pemasukan."
                                data-confirm-button="Ya, selesaikan"
                                data-cancel-button="Batal"
                            >
                                <x-icon name="lucide:check" />
                                Selesaikan Transaksi
                            </x-button>

                        </form>

                        <small class="text-muted">
                            Pastikan semua produk dan jumlah sudah benar.
                        </small>

                    </div>

                @else

                    <div class="checkout-action">

                        <x-button
                            variant="success-soft"
                            disabled
                        >
                            <x-icon name="lucide:check" />
                            Selesaikan Transaksi
                        </x-button>

                        <small class="text-muted">
                            Tambahkan minimal satu produk terlebih dahulu.
                        </small>

                    </div>

                @endif

            </div>

        </x-card>


    @else

        {{-- ========================================= --}}
        {{-- TRANSAKSI SELESAI --}}
        {{-- ========================================= --}}

        <x-card class="mb-4">

            <div class="completed-banner">

                <div class="completed-icon">
                    <x-icon name="lucide:circle-check" />
                </div>

                <div>
                    <h5 class="mb-1">
                        Transaksi sudah selesai
                    </h5>

                    <p class="text-muted mb-0">
                        Transaksi ini sudah dicatat sebagai pemasukan.
                    </p>
                </div>

            </div>

        </x-card>


        <x-card>

            <div class="section-heading">

                <div class="step-number completed-step">
                    ✓
                </div>

                <div>
                    <h5 class="mb-1">
                        Detail Produk
                    </h5>

                    <p class="text-muted mb-0">
                        Produk yang tercatat pada transaksi ini.
                    </p>
                </div>

            </div>


            <div class="mt-4">

                <x-table>

                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($transaksi->details as $index => $detail)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $detail->produk->nama_produk }}
                                    </strong>
                                </td>

                                <td>
                                    Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $detail->jumlah }}
                                </td>

                                <td>
                                    <strong>
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </strong>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </x-table>

            </div>


            <div class="completed-total">

                <span>
                    Total Transaksi
                </span>

                <strong>
                    Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                </strong>

            </div>

        </x-card>

    @endif


    <style>

        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
        }


        .transaction-info {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }


        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }


        .info-label {
            color: #6b7280;
            font-size: 13px;
        }


        .section-heading {
            display: flex;
            align-items: center;
            gap: 14px;
        }


        .step-number {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 50%;

            background: #eaf5ec;
            color: #2e7d32;

            font-weight: 700;
        }


        .completed-step {
            background: #2e7d32;
            color: white;
        }


        .transaction-note {
            display: flex;
            align-items: center;
            gap: 8px;

            padding: 10px 12px;

            border-radius: 9px;

            background: #f3f8f4;
            color: #55705a;

            font-size: 13px;
        }


        .transaction-note iconify-icon {
            color: #2e7d32;
            font-size: 17px;
        }


        .checkout-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
        }


        .total-label {
            display: block;

            margin-bottom: 3px;

            color: #6b7280;
            font-size: 14px;
        }


        .total-value {
            font-size: 30px;
            font-weight: 800;
            color: #2e7d32;
        }


        .checkout-action {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 6px;

            text-align: right;
        }


        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 45px 20px;

            text-align: center;
        }


        .empty-icon {
            width: 58px;
            height: 58px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 14px;

            border-radius: 15px;

            background: #eaf5ec;
            color: #2e7d32;
        }


        .empty-icon iconify-icon {
            font-size: 28px;
        }


        .empty-title {
            margin-bottom: 5px;

            color: #374151;

            font-size: 15px;
            font-weight: 700;
        }


        .empty-description {
            color: #6b7280;
            font-size: 13px;
        }


        .completed-banner {
            display: flex;
            align-items: center;
            gap: 14px;

            padding: 8px 0;
        }


        .completed-icon {
            width: 46px;
            height: 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #eaf5ec;
            color: #2e7d32;
        }


        .completed-icon iconify-icon {
            font-size: 24px;
        }


        .completed-total {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-top: 22px;
            padding-top: 20px;

            border-top: 1px solid #e5e7eb;
        }


        .completed-total span {
            color: #6b7280;
        }


        .completed-total strong {
            color: #2e7d32;
            font-size: 24px;
        }


        @media (max-width: 768px) {

            .transaction-header {
                align-items: flex-start;
                flex-direction: column;
            }


            .transaction-info {
                grid-template-columns: 1fr 1fr;
            }


            .checkout-section {
                flex-direction: column;
                align-items: stretch;
            }


            .checkout-action {
                align-items: stretch;
                text-align: left;
            }

        }


        @media (max-width: 576px) {

            .transaction-info {
                grid-template-columns: 1fr;
            }

        }

    </style>

</x-layout>