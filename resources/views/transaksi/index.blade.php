<x-layout active="transaksi">

    <x-breadcrumb
        :items="[
            ['label' => 'Transaksi']
        ]"
    />

    <x-page-header
        title="Transaksi Penjualan"
        description="Riwayat transaksi penjualan hidroponik."
    >
        <x-button
            variant="success"
            :href="route('transaksi.create')"
        >
            <x-icon name="lucide:plus" />
            Buat Transaksi
        </x-button>
    </x-page-header>

    <x-card>

        <x-table>

            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Nomor Transaksi</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Total</th>
                    <th width="110">Status</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($transaksi as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <div class="transaction-number">
                                <x-icon name="lucide:receipt-text" />
                                <strong>
                                    {{ $item->nomor_transaksi }}
                                </strong>
                            </div>
                        </td>

                        <td>
                            <span class="text-muted">
                                {{ $item->tanggal_transaksi->format('d-m-Y H:i') }}
                            </span>
                        </td>

                        <td>
                            <div class="cashier-name">
                                <span class="cashier-icon">
                                    <x-icon name="lucide:user-round" />
                                </span>

                                {{ $item->user->nama ?? '-' }}
                            </div>
                        </td>

                        <td>
                            <strong>
                                Rp {{ number_format($item->total, 0, ',', '.') }}
                            </strong>
                        </td>

                        <td>
                            @if ($item->status === 'completed')
                                <x-badge variant="success">
                                    Selesai
                                </x-badge>
                            @else
                                <x-badge variant="warning">
                                    Draft
                                </x-badge>
                            @endif
                        </td>

                        <td>

                            <x-button
                                variant="outline-success"
                                size="sm"
                                :href="route('transaksi.show', $item->id)"
                                title="Lihat detail"
                            >
                                <x-icon name="lucide:eye" />
                            </x-button>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7">
                            <div class="empty-state">

                                <div class="empty-icon">
                                    <x-icon name="lucide:receipt-text" />
                                </div>

                                <div class="empty-title">
                                    Belum ada transaksi
                                </div>

                                <div class="empty-description">
                                    Belum ada transaksi penjualan yang tercatat.
                                </div>

                                <x-button
                                    variant="success"
                                    :href="route('transaksi.create')"
                                >
                                    <x-icon name="lucide:plus" />
                                    Buat Transaksi
                                </x-button>

                            </div>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </x-table>

    </x-card>


    <style>
        .transaction-number {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .transaction-number iconify-icon {
            color: #2e7d32;
            font-size: 18px;
        }

        .cashier-name {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cashier-icon {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #eaf5ec;
            color: #2e7d32;
        }

        .cashier-icon iconify-icon {
            font-size: 15px;
        }

        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 55px 20px;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            border-radius: 16px;
            background: #eaf5ec;
            color: #2e7d32;
        }

        .empty-icon iconify-icon {
            font-size: 30px;
        }

        .empty-title {
            margin-bottom: 6px;
            font-size: 16px;
            font-weight: 700;
            color: #374151;
        }

        .empty-description {
            margin-bottom: 18px;
            color: #6b7280;
            font-size: 14px;
        }
    </style>

</x-layout>