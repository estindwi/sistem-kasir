<x-layout active="kategori-pengeluaran">

    <x-breadcrumb
        :items="[
            [
                'label' => 'Kategori Pengeluaran',
                'url' => route('kategori-pengeluaran.index')
            ],
            [
                'label' => 'Edit Kategori'
            ]
        ]"
    />

    <x-page-header
        title="Edit Kategori Pengeluaran"
        description="Perbarui informasi kategori pengeluaran."
    />

    <x-card title="Informasi Kategori">

        <form
            action="{{ route('kategori-pengeluaran.update', $kategori->id) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="mb-4">

                <label
                    for="nama_kategori"
                    class="form-label fw-semibold"
                >
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    id="nama_kategori"
                    class="form-control"
                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                    placeholder="Contoh: Pupuk, Bibit, Listrik"
                    required
                    autofocus
                >

                <div class="form-text">
                    Perubahan nama tidak mengubah data pengeluaran
                    yang sudah tercatat.
                </div>

            </div>


            @if(isset($kategori->pengeluaran_count))

                <div class="category-usage">

                    <div class="usage-icon">
                        <x-icon name="lucide:receipt-text" />
                    </div>

                    <div class="usage-content">

                        <span class="usage-title">
                            Ringkasan penggunaan kategori
                        </span>

                        <div class="usage-data">

                            <div>
                                <small>
                                    Jumlah transaksi
                                </small>

                                <strong>
                                    {{ $kategori->pengeluaran_count }}
                                </strong>
                            </div>

                            @if(isset($kategori->pengeluaran_sum_jumlah))

                                <div>
                                    <small>
                                        Total pengeluaran
                                    </small>

                                    <strong>
                                        Rp {{ number_format($kategori->pengeluaran_sum_jumlah ?? 0, 0, ',', '.') }}
                                    </strong>
                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @endif


            <div class="form-actions">

                <x-button
                    variant="outline-secondary"
                    :href="route('kategori-pengeluaran.index')"
                >
                    <x-icon name="lucide:arrow-left" />
                    Batal
                </x-button>

                <x-button
                    variant="success"
                    type="submit"
                >
                    <x-icon name="lucide:save" />
                    Simpan Perubahan
                </x-button>

            </div>

        </form>

    </x-card>


    <style>

        .form-control {
            min-height: 44px;
            border-radius: 10px;
        }

        .form-text {
            margin-top: 7px;
            color: #9ca3af;
            font-size: 12px;
        }

        .category-usage {
            display: flex;
            align-items: flex-start;
            gap: 12px;

            padding: 15px 16px;

            border-radius: 10px;

            background: #f3f8f4;
        }

        .usage-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 10px;

            background: #e1f0e4;
            color: #2e7d32;
        }

        .usage-icon iconify-icon {
            font-size: 18px;
        }

        .usage-title {
            display: block;

            margin-bottom: 9px;

            color: #374151;

            font-size: 13px;
            font-weight: 700;
        }

        .usage-data {
            display: flex;
            gap: 36px;
        }

        .usage-data small {
            display: block;

            margin-bottom: 2px;

            color: #6b7280;

            font-size: 11px;
        }

        .usage-data strong {
            display: block;

            color: #2e7d32;

            font-size: 15px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;

            margin-top: 28px;
            padding-top: 20px;

            border-top: 1px solid #e5e7eb;
        }

        @media (max-width: 576px) {

            .usage-data {
                flex-direction: column;
                gap: 10px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .ui-button {
                width: 100%;
            }

        }

    </style>

</x-layout>