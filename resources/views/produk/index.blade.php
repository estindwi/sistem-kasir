<x-layout active="produk">

    {{-- BREADCRUMB --}}
    <x-breadcrumb
        :items="[
            ['label' => 'Produk']
        ]"
    />


    {{-- PAGE HEADER --}}
    <x-page-header
        title="Produk"
        description="Kelola produk hidroponik dan pantau stok yang tersedia."
    >

        <x-button
            variant="success"
            :href="route('produk.create')"
        >
            <x-icon name="lucide:plus" />
            Tambah Produk
        </x-button>

    </x-page-header>


    {{-- PRODUCT TABLE --}}
    <x-card>

        <x-table>

            <thead>

                <tr>

                    <th class="ps-3">
                        No
                    </th>

                    <th>
                        Produk
                    </th>

                    <th>
                        Harga
                    </th>

                    <th>
                        Stok
                    </th>

                    <th>
                        Status
                    </th>

                    <th class="text-end pe-3">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($produk as $item)

                    <tr>

                        {{-- NOMOR --}}
                        <td class="ps-3">
                            {{ $loop->iteration }}
                        </td>


                        {{-- PRODUK --}}
                        <td>

                            <div class="d-flex align-items-center gap-2">

                                <div class="product-icon">

                                    <x-icon name="lucide:leaf" />

                                </div>

                                <div>

                                    <div class="product-name">
                                        {{ $item->nama_produk }}
                                    </div>

                                    <div class="product-subtitle">
                                        Produk hidroponik
                                    </div>

                                </div>

                            </div>

                        </td>


                        {{-- HARGA --}}
                        <td>

                            <span class="fw-semibold">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>

                        </td>


                        {{-- STOK --}}
                        <td>

                            @if($item->status)

                                @if($item->stok <= 0)

                                    <x-badge variant="danger">
                                        Habis
                                    </x-badge>

                                @elseif($item->stok <= 10)

                                    <x-badge variant="warning">
                                        {{ $item->stok }} stok
                                    </x-badge>

                                @else

                                    <span class="fw-semibold">
                                        {{ $item->stok }}
                                    </span>

                                @endif

                            @else

                                <span class="text-muted">
                                    {{ $item->stok }}
                                </span>

                            @endif

                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if($item->status)

                                <x-badge variant="success">
                                    Aktif
                                </x-badge>

                            @else

                                <x-badge variant="secondary">
                                    Tidak Aktif
                                </x-badge>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td class="text-end pe-3">

                            <div class="d-flex justify-content-end gap-1">

                                {{-- EDIT --}}
                                <x-button
                                    variant="outline-primary"
                                    size="sm"
                                    :href="route('produk.edit', $item->id)"
                                >
                                    <x-icon name="lucide:pencil" />
                                </x-button>


                                {{-- NONAKTIFKAN --}}
                                @if($item->status)

                                   <form
                                        action="{{ route('produk.deactivate', $item->id) }}"
                                        method="POST"
                                        class="d-inline"
                                    >
                                        @csrf
                                        @method('PUT')

                                        <x-button
                                            variant="outline-danger"
                                            size="sm"
                                            type="submit"
                                            data-confirm-title="Nonaktifkan produk?"
                                            data-confirm="Produk ini tidak akan dapat digunakan dalam transaksi baru. Apakah kamu yakin ingin melanjutkan?"
                                            data-confirm-button="Ya, nonaktifkan"
                                            data-cancel-button="Batal"
                                        >
                                            <x-icon name="lucide:ban" />
                                        </x-button>
                                    </form>
                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6">

                            <div class="empty-state">

                                <div class="empty-icon">

                                    <x-icon name="lucide:package-open" />

                                </div>

                                <h5>
                                    Belum ada produk
                                </h5>

                                <p>
                                    Tambahkan produk hidroponik pertama kamu.
                                </p>

                                <x-button
                                    variant="success"
                                    :href="route('produk.create')"
                                >
                                    <x-icon name="lucide:plus" />
                                    Tambah Produk
                                </x-button>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </x-table>

    </x-card>


    <style>

        /* =========================
           PRODUCT
        ========================= */

        .product-icon {
            width: 36px;
            height: 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 10px;

            background: rgba(46, 125, 50, .09);
            color: #2E7D32;

            font-size: 17px;
        }


        .product-name {
            font-size: 13px;
            font-weight: 600;
            color: #26352a;
        }


        .product-subtitle {
            margin-top: 2px;

            font-size: 11px;
            color: #98a19b;
        }


        /* =========================
           EMPTY STATE
        ========================= */

        .empty-state {
            display: flex;
            flex-direction: column;

            align-items: center;
            justify-content: center;

            padding: 55px 20px;

            text-align: center;
        }


        .empty-icon {
            width: 54px;
            height: 54px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 14px;

            border-radius: 14px;

            background: rgba(46, 125, 50, .08);
            color: #2E7D32;

            font-size: 25px;
        }


        .empty-state h5 {
            margin-bottom: 6px;

            font-size: 15px;
            font-weight: 700;

            color: #344238;
        }


        .empty-state p {
            margin-bottom: 18px;

            font-size: 12px;
            color: #98a19b;
        }


        /* =========================
           TABLE
        ========================= */

        .table thead th {
            padding-top: 13px;
            padding-bottom: 13px;

            font-size: 11px;
            font-weight: 700;

            color: #87908a;

            text-transform: uppercase;
            letter-spacing: .03em;

            border-bottom: 1px solid #e8ede9;
        }


        .table tbody td {
            padding-top: 15px;
            padding-bottom: 15px;

            font-size: 13px;

            color: #4e5a51;

            border-bottom: 1px solid #f0f2f0;
        }


        .table tbody tr:last-child td {
            border-bottom: none;
        }


        .table tbody tr {
            transition: background .15s ease;
        }


        .table tbody tr:hover {
            background: #fafcfb;
        }

    </style>

</x-layout>