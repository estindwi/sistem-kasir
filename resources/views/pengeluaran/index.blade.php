<x-layout active="pengeluaran">

    <x-breadcrumb
        :items="[
            ['label' => 'Pengeluaran']
        ]"
    />

    <x-page-header
        title="Pengeluaran"
        description="Catat dan pantau seluruh pengeluaran operasional hidroponik."
    >
        <x-button
            variant="success"
            :href="route('pengeluaran.create')"
        >
            <x-icon name="lucide:plus" />
            Tambah Pengeluaran
        </x-button>
    </x-page-header>


    {{-- RINGKASAN --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6">

            <x-card>

                <div class="summary-card">

                    <div class="summary-icon">
                        <x-icon name="lucide:wallet" />
                    </div>

                    <div>
                        <span class="summary-label">
                            Total Pengeluaran
                        </span>

                        <strong>
                            Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}
                        </strong>
                    </div>

                </div>

            </x-card>

        </div>


        <div class="col-md-6">

            <x-card>

                <div class="summary-card">

                    <div class="summary-icon">
                        <x-icon name="lucide:receipt-text" />
                    </div>

                    <div>
                        <span class="summary-label">
                            Jumlah Transaksi
                        </span>

                        <strong>
                            {{ $pengeluaran->count() }}
                        </strong>
                    </div>

                </div>

            </x-card>

        </div>

    </div>


    {{-- TABEL PENGELUARAN --}}
    <x-card>

        <x-table>

            <thead>

                <tr>
                    <th width="70">No</th>
                    <th width="150">Tanggal</th>
                    <th width="180">Kategori</th>
                    <th>Keterangan</th>
                    <th width="190">Nominal</th>
                    <th width="130">Aksi</th>
                </tr>

            </thead>


            <tbody>

                @forelse ($pengeluaran as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>


                        <td>

                            <div class="date-info">

                                <x-icon name="lucide:calendar-days" />

                                <span>
                                    {{ $item->tanggal_pengeluaran->format('d/m/Y') }}
                                </span>

                            </div>

                        </td>


                        <td>

                            <div class="category-name">

                                <span class="category-icon">
                                    <x-icon name="lucide:tag" />
                                </span>

                                <strong>
                                    {{ $item->kategori->nama_kategori ?? '-' }}
                                </strong>

                            </div>

                        </td>


                        <td>

                            @if ($item->keterangan)

                                <span class="description">
                                    {{ $item->keterangan }}
                                </span>

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>


                        <td>

                            <strong class="expense-total">
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </strong>

                        </td>


                        <td>

                            <div class="action-buttons">

                                <x-button
                                    variant="outline-primary"
                                    size="sm"
                                    :href="route('pengeluaran.edit', $item->id)"
                                    title="Edit pengeluaran"
                                >
                                    <x-icon name="lucide:pencil" />
                                </x-button>


                                <form
                                    action="{{ route('pengeluaran.destroy', $item->id) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <x-button
                                        variant="outline-danger"
                                        size="sm"
                                        type="submit"
                                        title="Hapus pengeluaran"
                                        data-confirm
                                        data-confirm-title="Hapus pengeluaran?"
                                        data-confirm="Data pengeluaran ini akan dihapus dan tidak dapat dikembalikan."
                                        data-confirm-button="Ya, hapus"
                                        data-cancel-button="Batal"
                                    >
                                        <x-icon name="lucide:trash-2" />
                                    </x-button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    <x-icon name="lucide:wallet" />
                                </div>

                                <div class="empty-title">
                                    Belum ada pengeluaran
                                </div>

                                <div class="empty-description">
                                    Belum ada transaksi pengeluaran yang tercatat.
                                    Tambahkan pengeluaran untuk mulai mencatat
                                    arus kas keluar.
                                </div>

                                <x-button
                                    variant="success"
                                    :href="route('pengeluaran.create')"
                                >
                                    <x-icon name="lucide:plus" />
                                    Tambah Pengeluaran
                                </x-button>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </x-table>

    </x-card>


    <style>

        .summary-card {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .summary-icon {
            width: 46px;
            height: 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 12px;

            background: #eaf5ec;
            color: #2e7d32;
        }

        .summary-icon iconify-icon {
            font-size: 21px;
        }

        .summary-label {
            display: block;
            margin-bottom: 3px;

            color: #6b7280;
            font-size: 12px;
        }

        .summary-card strong {
            display: block;

            color: #374151;
            font-size: 20px;
        }

        .date-info {
            display: flex;
            align-items: center;
            gap: 7px;

            color: #6b7280;
        }

        .date-info iconify-icon {
            color: #2e7d32;
            font-size: 16px;
        }

        .category-name {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .category-icon {
            width: 32px;
            height: 32px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 9px;

            background: #eaf5ec;
            color: #2e7d32;
        }

        .category-icon iconify-icon {
            font-size: 16px;
        }

        .description {
            color: #4b5563;
        }

        .expense-total {
            color: #2e7d32;
            font-weight: 700;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 55px 20px;

            text-align: center;
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

            color: #374151;

            font-size: 16px;
            font-weight: 700;
        }

        .empty-description {
            max-width: 500px;

            margin-bottom: 18px;

            color: #6b7280;

            font-size: 14px;
        }

    </style>

</x-layout>