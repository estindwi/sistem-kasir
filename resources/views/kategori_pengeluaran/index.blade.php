<x-layout active="kategori-pengeluaran">

    <x-breadcrumb
        :items="[
            ['label' => 'Kategori Pengeluaran']
        ]"
    />

    <x-page-header
        title="Kategori Pengeluaran"
        description="Kelola kategori yang digunakan untuk mencatat pengeluaran."
    >
        <x-button
            variant="success"
            :href="route('kategori-pengeluaran.create')"
        >
            <x-icon name="lucide:plus" />
            Tambah Kategori
        </x-button>
    </x-page-header>


    <x-card>

        <x-table>

            <thead>
                <tr>
                    <th width="70">No</th>
                    <th>Nama Kategori</th>
                    <th width="130">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($kategori as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <div class="category-name">

                                <span class="category-icon">
                                    <x-icon name="lucide:tag" />
                                </span>

                                <strong>
                                    {{ $item->nama_kategori }}
                                </strong>

                            </div>
                        </td>

                        <td>

                            <div class="action-buttons">

                                <x-button
                                    variant="outline-primary"
                                    size="sm"
                                    :href="route('kategori-pengeluaran.edit', $item->id)"
                                    title="Edit kategori"
                                >
                                    <x-icon name="lucide:pencil" />
                                </x-button>


                                <form
                                    action="{{ route('kategori-pengeluaran.destroy', $item->id) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <x-button
                                        variant="outline-danger"
                                        size="sm"
                                        type="submit"
                                        title="Hapus kategori"
                                        data-confirm
                                        data-confirm-title="Hapus kategori?"
                                        data-confirm="Kategori ini akan dihapus. Pastikan kategori belum digunakan pada data pengeluaran."
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

                        <td colspan="3">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    <x-icon name="lucide:tags" />
                                </div>

                                <div class="empty-title">
                                    Belum ada kategori pengeluaran
                                </div>

                                <div class="empty-description">
                                    Tambahkan kategori seperti pupuk, bibit,
                                    listrik, air, atau operasional.
                                </div>

                                <x-button
                                    variant="success"
                                    :href="route('kategori-pengeluaran.create')"
                                >
                                    <x-icon name="lucide:plus" />
                                    Tambah Kategori
                                </x-button>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </x-table>

    </x-card>


    <style>

        .category-name {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .category-icon {
            width: 34px;
            height: 34px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 10px;

            background: #eaf5ec;
            color: #2e7d32;
        }

        .category-icon iconify-icon {
            font-size: 17px;
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
            max-width: 480px;

            margin-bottom: 18px;

            color: #6b7280;

            font-size: 14px;
        }

    </style>

</x-layout>