<x-layout active="pengeluaran">

    <x-breadcrumb
        :items="[
            [
                'label' => 'Pengeluaran',
                'url' => route('pengeluaran.index')
            ],
            [
                'label' => 'Tambah Pengeluaran'
            ]
        ]"
    />

    <x-page-header
        title="Tambah Pengeluaran"
        description="Catat pengeluaran operasional hidroponik."
    />

    <x-card title="Informasi Pengeluaran">

        <form
            action="{{ route('pengeluaran.store') }}"
            method="POST"
        >
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label
                        for="tanggal_pengeluaran"
                        class="form-label fw-semibold"
                    >
                        Tanggal Pengeluaran
                    </label>

                    <input
                        type="date"
                        name="tanggal_pengeluaran"
                        id="tanggal_pengeluaran"
                        class="form-control"
                        value="{{ old('tanggal_pengeluaran', now()->format('Y-m-d')) }}"
                        required
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label
                        for="kategori_id"
                        class="form-label fw-semibold"
                    >
                        Kategori Pengeluaran
                    </label>

                    <select
                        name="kategori_id"
                        id="kategori_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach ($kategori as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ old('kategori_id') == $item->id ? 'selected' : '' }}
                            >
                                {{ $item->nama_kategori }}
                            </option>

                        @endforeach

                    </select>

                    <div class="form-text">
                        Pilih kategori sesuai jenis pengeluaran.
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <label
                        for="jumlah"
                        class="form-label fw-semibold"
                    >
                        Nominal Pengeluaran
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="jumlah"
                            id="jumlah"
                            class="form-control"
                            value="{{ old('jumlah') }}"
                            min="1"
                            step="0.01"
                            placeholder="Contoh: 150000"
                            required
                        >

                    </div>

                    <div class="form-text">
                        Masukkan nominal pengeluaran.
                    </div>

                </div>


                <div class="col-md-12 mb-3">

                    <label
                        for="keterangan"
                        class="form-label fw-semibold"
                    >
                        Keterangan
                    </label>

                    <textarea
                        name="keterangan"
                        id="keterangan"
                        class="form-control"
                        rows="4"
                        maxlength="1000"
                        placeholder="Contoh: Pembelian token listrik bulan September"
                    >{{ old('keterangan') }}</textarea>

                    <div class="form-text">
                        Tambahkan keterangan agar pengeluaran mudah ditelusuri.
                    </div>

                </div>

            </div>


            <div class="expense-note">

                <div class="note-icon">
                    <x-icon name="lucide:info" />
                </div>

                <div>
                    <strong>
                        Catatan
                    </strong>

                    <p>
                        Data yang disimpan akan masuk ke catatan pengeluaran
                        dan memengaruhi laporan keuangan.
                    </p>
                </div>

            </div>


            <div class="form-actions">

                <x-button
                    variant="outline-secondary"
                    :href="route('pengeluaran.index')"
                >
                    <x-icon name="lucide:arrow-left" />
                    Batal
                </x-button>

                <x-button
                    variant="success"
                    type="submit"
                >
                    <x-icon name="lucide:save" />
                    Simpan Pengeluaran
                </x-button>

            </div>

        </form>

    </x-card>


    <style>

        .form-control,
        .form-select {
            min-height: 44px;
            border-radius: 10px;
        }

        textarea.form-control {
            min-height: 110px;
        }

        .input-group-text {
            background: #f5f7f6;
            color: #4b5563;
            font-weight: 600;
        }

        .form-text {
            margin-top: 7px;
            color: #9ca3af;
            font-size: 12px;
        }

        .expense-note {
            display: flex;
            align-items: flex-start;
            gap: 12px;

            margin-top: 10px;
            padding: 14px 16px;

            border-radius: 10px;

            background: #f3f8f4;
        }

        .note-icon {
            width: 36px;
            height: 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 9px;

            background: #e1f0e4;
            color: #2e7d32;
        }

        .note-icon iconify-icon {
            font-size: 17px;
        }

        .expense-note strong {
            display: block;
            margin-bottom: 2px;

            color: #374151;
            font-size: 13px;
        }

        .expense-note p {
            margin: 0;

            color: #6b7280;
            font-size: 12px;
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

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .ui-button {
                width: 100%;
            }

        }

    </style>

</x-layout>