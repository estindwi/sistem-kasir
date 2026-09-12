<x-layout active="kategori-pengeluaran">

    <x-breadcrumb
        :items="[
            [
                'label' => 'Kategori Pengeluaran',
                'url' => route('kategori-pengeluaran.index')
            ],
            [
                'label' => 'Tambah Kategori'
            ]
        ]"
    />

    <x-page-header
        title="Tambah Kategori Pengeluaran"
        description="Tambahkan kategori baru untuk mengelompokkan pengeluaran."
    />

    <x-card title="Informasi Kategori">

        <form
            action="{{ route('kategori-pengeluaran.store') }}"
            method="POST"
        >
            @csrf

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
                    value="{{ old('nama_kategori') }}"
                    placeholder="Contoh: Pupuk, Bibit, Listrik"
                    required
                    autofocus
                >

                <div class="form-text">
                    Gunakan nama yang singkat dan mudah dikenali saat
                    mencatat pengeluaran.
                </div>

            </div>


            <div class="category-guide">

                <div class="guide-icon">
                    <x-icon name="lucide:lightbulb" />
                </div>

                <div>
                    <span class="guide-title">
                        Contoh kategori
                    </span>

                    <p>
                        Pupuk, Bibit, Nutrisi, Listrik, Air,
                        Peralatan, dan Operasional.
                    </p>
                </div>

            </div>


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
                    Simpan Kategori
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

        .category-guide {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 14px 16px;

            border-radius: 10px;

            background: #f3f8f4;
        }

        .guide-icon {
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

        .guide-icon iconify-icon {
            font-size: 18px;
        }

        .guide-title {
            display: block;
            margin-bottom: 2px;

            color: #374151;
            font-size: 13px;
            font-weight: 700;
        }

        .category-guide p {
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