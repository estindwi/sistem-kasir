<x-layout active="transaksi">

    <x-breadcrumb
        :items="[
            ['label' => 'Transaksi', 'url' => route('transaksi.index')],
            ['label' => 'Buat Transaksi']
        ]"
    />

    <x-page-header
        title="Buat Transaksi Penjualan"
        description="Buat transaksi baru dan tambahkan produk yang dibeli."
    >
        <x-button
            variant="outline-secondary"
            :href="route('transaksi.index')"
        >
            <x-icon name="lucide:arrow-left" />
            Kembali
        </x-button>
    </x-page-header>


    <x-card>

        <div class="create-content">

            <div class="create-info">

                <div class="create-info-icon">
                    <x-icon name="lucide:shopping-cart" />
                </div>

                <div>
                    <h5 class="mb-1">
                        Transaksi Baru
                    </h5>

                    <p class="text-muted mb-0">
                        Klik tombol di bawah untuk membuat transaksi.
                        Produk dan jumlahnya akan ditambahkan pada langkah berikutnya.
                    </p>
                </div>

            </div>


            <div class="transaction-time">

                <div class="time-icon">
                    <x-icon name="lucide:calendar-clock" />
                </div>

                <div>
                    <span class="time-label">
                        Tanggal & Waktu Transaksi
                    </span>

                    <strong id="transaction-time">
                        {{ now()->format('d/m/Y H:i') }}
                    </strong>

                    <small>
                        Waktu transaksi diambil otomatis saat transaksi dibuat.
                    </small>
                </div>

            </div>


            <div class="transaction-flow">

                <div class="flow-item active">

                    <span class="flow-number">
                        1
                    </span>

                    <div>
                        <strong>Buat transaksi</strong>
                        <small>Mulai transaksi baru</small>
                    </div>

                </div>


                <div class="flow-line"></div>


                <div class="flow-item">

                    <span class="flow-number">
                        2
                    </span>

                    <div>
                        <strong>Tambah produk</strong>
                        <small>Pilih produk dan jumlah</small>
                    </div>

                </div>


                <div class="flow-line"></div>


                <div class="flow-item">

                    <span class="flow-number">
                        3
                    </span>

                    <div>
                        <strong>Selesaikan</strong>
                        <small>Konfirmasi transaksi</small>
                    </div>

                </div>

            </div>


            <div class="form-actions">

                <x-button
                    variant="outline-secondary"
                    :href="route('transaksi.index')"
                >
                    Batal
                </x-button>

                <form
                    action="{{ route('transaksi.store') }}"
                    method="POST"
                >
                    @csrf

                    <x-button
                        variant="success"
                        type="submit"
                    >
                        <x-icon name="lucide:plus" />
                        Buat Transaksi
                    </x-button>
                </form>

            </div>

        </div>

    </x-card>


    <style>

        .create-content {
            width: 100%;
        }


        .create-info {
            display: flex;
            align-items: center;
            gap: 14px;

            padding: 16px 18px;

            border-radius: 12px;
            background: #f3f8f4;
        }


        .create-info-icon {
            width: 46px;
            height: 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 12px;

            background: #e1f0e4;
            color: #2e7d32;
        }


        .create-info-icon iconify-icon {
            font-size: 23px;
        }


        .transaction-time {
            display: flex;
            align-items: center;
            gap: 14px;

            margin-top: 20px;
            padding: 18px;

            border: 1px solid #e5e7eb;
            border-radius: 12px;

            background: #ffffff;
        }


        .time-icon {
            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 10px;

            background: #f1f8f2;
            color: #2e7d32;
        }


        .time-icon iconify-icon {
            font-size: 20px;
        }


        .time-label {
            display: block;

            margin-bottom: 3px;

            color: #6b7280;

            font-size: 13px;
        }


        .transaction-time strong {
            display: block;

            color: #374151;

            font-size: 18px;
        }


        .transaction-time small {
            display: block;

            margin-top: 3px;

            color: #9ca3af;

            font-size: 12px;
        }


        .transaction-flow {
            display: flex;
            align-items: center;

            margin-top: 28px;
            padding: 20px;

            border-radius: 12px;

            background: #fafafa;
        }


        .flow-item {
            display: flex;
            align-items: center;
            gap: 10px;

            flex: 1;
        }


        .flow-number {
            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 50%;

            background: #ecefee;
            color: #9ca3af;

            font-size: 13px;
            font-weight: 700;
        }


        .flow-item.active .flow-number {
            background: #2e7d32;
            color: #ffffff;
        }


        .flow-item strong {
            display: block;

            color: #374151;

            font-size: 13px;
        }


        .flow-item small {
            display: block;

            margin-top: 2px;

            color: #9ca3af;

            font-size: 11px;
        }


        .flow-line {
            width: 45px;
            height: 1px;

            flex-shrink: 0;

            margin: 0 14px;

            background: #dfe3e0;
        }


        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;

            margin-top: 28px;
            padding-top: 20px;

            border-top: 1px solid #e5e7eb;
        }


        @media (max-width: 768px) {

            .transaction-flow {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }


            .flow-line {
                width: 1px;
                height: 22px;

                margin: 0 0 0 16px;
            }


            .form-actions {
                flex-direction: column-reverse;
            }


            .form-actions > *,
            .form-actions form,
            .form-actions form .ui-button {
                width: 100%;
            }

        }

    </style>

</x-layout>