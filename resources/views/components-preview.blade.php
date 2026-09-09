<x-layout active="">

    {{-- ================================
         BREADCRUMB
    ================================= --}}

    <x-breadcrumb
        :items="[
            ['label' => 'Produk', 'url' => '#'],
            ['label' => 'Detail Produk']
        ]"
    />


    {{-- ================================
         PAGE HEADER
    ================================= --}}

    <x-page-header
        title="Component Showcase"
        description="Kumpulan seluruh component UI yang digunakan dalam sistem kasir hidroponik."
    >
        <x-button variant="success">
            <x-icon name="lucide:plus" />
            Tambah Data
        </x-button>
    </x-page-header>


    <div class="row g-4">


        {{-- ================================
             BUTTON
        ================================= --}}

        <div class="col-12">

            <x-card title="Button">

                <div class="mb-4">

                    <h6 class="fw-semibold">
                        Solid
                    </h6>

                    <div class="d-flex gap-2 flex-wrap">

                        <x-button variant="success">
                            <x-icon name="lucide:plus" />
                            Tambah
                        </x-button>

                        <x-button variant="primary">
                            <x-icon name="lucide:save" />
                            Simpan
                        </x-button>

                        <x-button variant="danger">
                            <x-icon name="lucide:trash-2" />
                            Hapus
                        </x-button>

                        <x-button variant="warning">
                            <x-icon name="lucide:triangle-alert" />
                            Peringatan
                        </x-button>

                    </div>

                </div>


                <div class="mb-4">

                    <h6 class="fw-semibold">
                        Outline
                    </h6>

                    <div class="d-flex gap-2 flex-wrap">

                        <x-button variant="outline-success">
                            <x-icon name="lucide:plus" />
                            Tambah
                        </x-button>

                        <x-button variant="outline-primary">
                            <x-icon name="lucide:eye" />
                            Lihat
                        </x-button>

                        <x-button variant="outline-danger">
                            <x-icon name="lucide:trash-2" />
                            Hapus
                        </x-button>

                        <x-button variant="outline-warning">
                            <x-icon name="lucide:triangle-alert" />
                            Peringatan
                        </x-button>

                        <x-button variant="outline-secondary">
                            <x-icon name="lucide:x" />
                            Batal
                        </x-button>

                    </div>

                </div>


                <div class="mb-4">

                    <h6 class="fw-semibold">
                        Soft / Transparent
                    </h6>

                    <div class="d-flex gap-2 flex-wrap">

                        <x-button variant="success-soft">
                            <x-icon name="lucide:plus" />
                            Tambah
                        </x-button>

                        <x-button variant="primary-soft">
                            <x-icon name="lucide:eye" />
                            Lihat
                        </x-button>

                        <x-button variant="danger-soft">
                            <x-icon name="lucide:trash-2" />
                            Hapus
                        </x-button>

                        <x-button variant="warning-soft">
                            <x-icon name="lucide:triangle-alert" />
                            Peringatan
                        </x-button>

                    </div>

                </div>


                <div class="mb-4">

                    <h6 class="fw-semibold">
                        Icon Only
                    </h6>

                    <div class="d-flex gap-2">

                        <x-button
                            variant="outline-success"
                            size="sm"
                        >
                            <x-icon name="lucide:plus" />
                        </x-button>

                        <x-button
                            variant="outline-primary"
                            size="sm"
                        >
                            <x-icon name="lucide:eye" />
                        </x-button>

                        <x-button
                            variant="outline-primary"
                            size="sm"
                        >
                            <x-icon name="lucide:pencil" />
                        </x-button>

                        <x-button
                            variant="outline-danger"
                            size="sm"
                        >
                            <x-icon name="lucide:trash-2" />
                        </x-button>

                        <x-button
                            variant="outline-secondary"
                            size="sm"
                        >
                            <x-icon name="lucide:more-horizontal" />
                        </x-button>

                    </div>

                </div>


                <div>

                    <h6 class="fw-semibold">
                        Ukuran
                    </h6>

                    <div class="d-flex gap-2 align-items-center">

                        <x-button
                            variant="success"
                            size="sm"
                        >
                            Small
                        </x-button>

                        <x-button variant="success">
                            Medium
                        </x-button>

                        <x-button
                            variant="success"
                            size="lg"
                        >
                            Large
                        </x-button>

                    </div>

                </div>

            </x-card>

        </div>


        {{-- ================================
             ALERT
        ================================= --}}

        <div class="col-12">

            <x-card title="Alert">

                <x-alert type="success">
                    Data berhasil disimpan.
                </x-alert>

                <x-alert type="info">
                    Ini adalah informasi untuk pengguna.
                </x-alert>

                <x-alert type="warning">
                    Stok produk hampir habis.
                </x-alert>

                <x-alert type="danger">
                    Data gagal disimpan.
                </x-alert>

            </x-card>

        </div>


        {{-- ================================
             BADGE
        ================================= --}}

        <div class="col-md-6">

            <x-card title="Badge">

                <div class="d-flex gap-2 flex-wrap">

                    <x-badge variant="success">
                        Aktif
                    </x-badge>

                    <x-badge variant="primary">
                        Proses
                    </x-badge>

                    <x-badge variant="warning">
                        Draft
                    </x-badge>

                    <x-badge variant="danger">
                        Tidak Aktif
                    </x-badge>

                    <x-badge variant="secondary">
                        Arsip
                    </x-badge>

                </div>

            </x-card>

        </div>


        {{-- ================================
             ICON
        ================================= --}}

        <div class="col-md-6">

            <x-card title="Iconify / Lucide">

                <div class="d-flex gap-4 align-items-center fs-3">

                    <x-icon name="lucide:layout-dashboard" />

                    <x-icon name="lucide:package" />

                    <x-icon name="lucide:shopping-cart" />

                    <x-icon name="lucide:wallet" />

                    <x-icon name="lucide:tags" />

                    <x-icon name="lucide:pencil" />

                    <x-icon name="lucide:trash-2" />

                    <x-icon name="lucide:user-round" />

                    <x-icon name="lucide:log-out" />

                </div>

            </x-card>

        </div>


        {{-- ================================
             CARD
        ================================= --}}

        <div class="col-md-6">

            <x-card title="Card dengan Title">

                <p class="text-muted mb-0">
                    Card ini menggunakan title dan slot content.
                </p>

            </x-card>

        </div>


        <div class="col-md-6">

            <x-card>

                <h5 class="fw-semibold mb-2">
                    Card Tanpa Title
                </h5>

                <p class="text-muted mb-0">
                    Card juga bisa digunakan tanpa title bawaan.
                </p>

            </x-card>

        </div>


        {{-- ================================
             TABLE
        ================================= --}}

        <div class="col-12">

            <x-card title="Table">

                <x-table>

                    <thead class="table-light">

                        <tr>

                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>


                    <tbody>

                        <tr>

                            <td>
                                1
                            </td>

                            <td>
                                Selada Hidroponik
                            </td>

                            <td>
                                Rp 15.000
                            </td>

                            <td>
                                20
                            </td>

                            <td>

                                <x-badge variant="success">
                                    Aktif
                                </x-badge>

                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    <x-button
                                        variant="outline-primary"
                                        size="sm"
                                    >
                                        <x-icon name="lucide:pencil" />
                                    </x-button>

                                    <x-button
                                        variant="outline-danger"
                                        size="sm"
                                    >
                                        <x-icon name="lucide:trash-2" />
                                    </x-button>

                                </div>

                            </td>

                        </tr>


                        <tr>

                            <td>
                                2
                            </td>

                            <td>
                                Pakcoy Hidroponik
                            </td>

                            <td>
                                Rp 12.000
                            </td>

                            <td>
                                8
                            </td>

                            <td>

                                <x-badge variant="warning">
                                    Stok Menipis
                                </x-badge>

                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    <x-button
                                        variant="outline-primary"
                                        size="sm"
                                    >
                                        <x-icon name="lucide:pencil" />
                                    </x-button>

                                    <x-button
                                        variant="outline-danger"
                                        size="sm"
                                    >
                                        <x-icon name="lucide:trash-2" />
                                    </x-button>

                                </div>

                            </td>

                        </tr>


                        <tr>

                            <td>
                                3
                            </td>

                            <td>
                                Kangkung Hidroponik
                            </td>

                            <td>
                                Rp 10.000
                            </td>

                            <td>
                                0
                            </td>

                            <td>

                                <x-badge variant="danger">
                                    Habis
                                </x-badge>

                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    <x-button
                                        variant="outline-secondary"
                                        size="sm"
                                    >
                                        <x-icon name="lucide:eye" />
                                    </x-button>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </x-table>

            </x-card>

        </div>


        {{-- ================================
             PAGE HEADER VARIATION
        ================================= --}}

        <div class="col-12">

            <x-card title="Page Header">

                <x-page-header
                    title="Produk"
                    description="Kelola data produk hidroponik."
                >

                    <x-button variant="success">

                        <x-icon name="lucide:plus" />

                        Tambah Produk

                    </x-button>

                </x-page-header>

            </x-card>

        </div>


        {{-- ================================
             BREADCRUMB VARIATION
        ================================= --}}

        <div class="col-12">

            <x-card title="Breadcrumb">

                <x-breadcrumb
                    :items="[
                        ['label' => 'Produk', 'url' => '#'],
                        ['label' => 'Edit Produk', 'url' => '#'],
                        ['label' => 'Detail']
                    ]"
                />

            </x-card>

        </div>

    </div>

</x-layout>