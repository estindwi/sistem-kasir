<x-layout active="produk">

    {{-- BREADCRUMB --}}
    <x-breadcrumb
        :items="[
            [
                'label' => 'Produk',
                'url' => route('produk.index')
            ],
            [
                'label' => 'Tambah Produk'
            ]
        ]"
    />


    {{-- PAGE HEADER --}}
    <x-page-header
        title="Tambah Produk"
        description="Tambahkan produk hidroponik baru ke dalam sistem."
    />


    {{-- VALIDATION ERROR --}}
    @if($errors->any())

        <x-alert type="danger">

            <div>
                <div class="fw-semibold mb-1">
                    Periksa kembali input
                </div>

                <ul class="mb-0 ps-3">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>
            </div>

        </x-alert>

    @endif


    {{-- FORM --}}
    <x-card title="Informasi Produk">

        <form
            action="{{ route('produk.store') }}"
            method="POST"
        >

            @csrf


            {{-- NAMA PRODUK --}}
            <div class="mb-4">

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
                    value="{{ old('nama_produk') }}"
                    placeholder="Contoh: Selada Hidroponik"
                    required
                >

                <div class="form-text">
                    Masukkan nama produk hidroponik yang akan dijual.
                </div>

            </div>


            {{-- HARGA & STOK --}}
            <div class="row">

                {{-- HARGA --}}
                <div class="col-md-6 mb-4">

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
                            value="{{ old('harga') }}"
                            placeholder="15000"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>

                    <div class="form-text">
                        Harga jual produk dalam rupiah.
                    </div>

                </div>


                {{-- STOK --}}
                <div class="col-md-6 mb-4">

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
                        value="{{ old('stok') }}"
                        placeholder="20"
                        min="0"
                        required
                    >

                    <div class="form-text">
                        Jumlah stok awal produk.
                    </div>

                </div>

            </div>


            {{-- ACTION --}}
            <div class="d-flex justify-content-end gap-2 pt-3 border-top">

                <x-button
                    variant="outline-secondary"
                    :href="route('produk.index')"
                >
                    <x-icon name="lucide:x" />
                    Batal
                </x-button>


                <x-button
                    variant="success"
                    type="submit"
                >
                    <x-icon name="lucide:save" />
                    Simpan Produk
                </x-button>

            </div>

        </form>

    </x-card>


    <style>

        .form-label {
            color: #344238;
            font-size: 13px;
        }

        .form-control,
        .input-group-text {
            min-height: 42px;

            border-color: #dfe5e0;

            font-size: 13px;
        }

        .form-control {
            border-radius: 9px;
        }

        .input-group-text {
            background: #f7faf7;
            color: #667168;
        }

        .form-control:focus {
            border-color: #81C784;
            box-shadow: 0 0 0 .2rem rgba(46, 125, 50, .08);
        }

        .form-text {
            margin-top: 6px;

            font-size: 11px;
            color: #98a19b;
        }

    </style>

</x-layout>