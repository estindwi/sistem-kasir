<x-layout active="produk">

    <x-breadcrumb
        :items="[
            ['label' => 'Produk', 'url' => route('produk.index')],
            ['label' => 'Edit Produk']
        ]"
    />

    <x-page-header
        title="Edit Produk"
        description="Perbarui informasi produk hidroponik."
    />

    <x-card title="Informasi Produk">

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
                        <span class="input-group-text">Rp</span>

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

                <x-button
                    variant="outline-secondary"
                    :href="route('produk.index')"
                >
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
        .form-control,
        .form-select,
        .input-group-text {
            border-radius: 10px;
        }

        .form-control,
        .form-select {
            min-height: 44px;
        }

        .input-group .input-group-text {
            background: #f5f7f6;
            font-weight: 600;
            color: #4b5563;
        }
    </style>

</x-layout>