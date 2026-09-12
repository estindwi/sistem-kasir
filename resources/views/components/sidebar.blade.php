<aside class="app-sidebar">

    {{-- BRAND --}}
    <div class="sidebar-brand">

        <div class="brand-icon">
            <x-icon name="lucide:leaf" />
        </div>

        <div class="brand-text">
            <strong>Hidroponik</strong>
            <span>Kasir System</span>
        </div>

    </div>


    {{-- MENU --}}
    <div class="sidebar-menu">

        <div class="menu-label">
            MENU UTAMA
        </div>


        <a
            href="{{ route('dashboard') }}"
            class="sidebar-link {{ $active === 'dashboard' ? 'active' : '' }}"
        >
            <x-icon name="lucide:layout-dashboard" />
            <span>Dashboard</span>
        </a>


        <a
            href="{{ route('produk.index') }}"
            class="sidebar-link {{ $active === 'produk' ? 'active' : '' }}"
        >
            <x-icon name="lucide:package" />
            <span>Produk</span>
        </a>


        <a
            href="{{ route('transaksi.index') }}"
            class="sidebar-link {{ $active === 'transaksi' ? 'active' : '' }}"
        >
            <x-icon name="lucide:shopping-cart" />
            <span>Transaksi Penjualan</span>
        </a>


        <a
            href="{{ route('kategori-pengeluaran.index') }}"
            class="sidebar-link {{ $active === 'kategori-pengeluaran' ? 'active' : '' }}"
        >
            <x-icon name="lucide:tags" />
            <span>Kategori Pengeluaran</span>
        </a>


        <a
            href="{{ route('pengeluaran.index') }}"
            class="sidebar-link {{ $active === 'pengeluaran' ? 'active' : '' }}"
        >
            <x-icon name="lucide:wallet" />
            <span>Pengeluaran</span>
        </a>


        <a
            href="{{ route('laporan-keuangan.index') }}"
            class="sidebar-link {{ $active === 'laporan-keuangan' ? 'active' : '' }}"
        >
            <x-icon name="lucide:chart-no-axes-combined" />
            <span>Laporan Keuangan</span>
        </a>

    </div>


    {{-- USER AREA --}}
    <div class="sidebar-footer">

        <div class="user-box">

            <div class="user-avatar">
                <x-icon name="lucide:user-round" />
            </div>

            <div class="user-info">

                <strong>
                    {{ auth()->user()->nama }}
                </strong>

                <span>
                    Owner Hidroponik
                </span>

            </div>

        </div>


        <form
            action="{{ route('logout') }}"
            method="POST"
            class="logout-form"
        >
            @csrf

            <button
                type="submit"
                class="sidebar-logout"
            >
                <x-icon name="lucide:log-out" />
                <span>Keluar</span>
            </button>

        </form>

    </div>

</aside>


<style>

    .app-sidebar {
        position: fixed;
        top: 0;
        left: 0;

        width: 250px;
        height: 100vh;

        display: flex;
        flex-direction: column;

        background: #ffffff;
        border-right: 1px solid #e5e7eb;

        z-index: 1000;
    }


    /* BRAND */

    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 11px;

        height: 76px;

        padding: 16px 18px;

        flex-shrink: 0;

        border-bottom: 1px solid #f0f1f1;
    }


    .brand-icon {
        width: 39px;
        height: 39px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 11px;

        background: #2e7d32;
        color: white;
    }


    .brand-icon iconify-icon {
        font-size: 20px;
    }


    .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }


    .brand-text strong {
        color: #1f2937;
        font-size: 15px;
    }


    .brand-text span {
        margin-top: 2px;

        color: #9ca3af;
        font-size: 11px;
    }


    /* MENU */

    .sidebar-menu {
        flex: 1;

        min-height: 0;

        padding: 20px 14px;

        overflow-y: auto;
        overflow-x: hidden;
    }


    .sidebar-menu::-webkit-scrollbar {
        width: 5px;
    }


    .sidebar-menu::-webkit-scrollbar-thumb {
        background: #d8dfda;
        border-radius: 10px;
    }


    .menu-label {
        padding: 0 11px;
        margin-bottom: 9px;

        color: #9ca3af;

        font-size: 10px;
        font-weight: 700;

        letter-spacing: 0.08em;
    }


    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 11px;

        min-height: 44px;

        padding: 10px 12px;

        margin-bottom: 4px;

        border-radius: 10px;

        color: #6b7280;

        text-decoration: none;

        font-size: 13px;
        font-weight: 500;

        transition:
            background 0.2s ease,
            color 0.2s ease;
    }


    .sidebar-link iconify-icon {
        width: 19px;

        flex-shrink: 0;

        font-size: 18px;
    }


    .sidebar-link:hover {
        background: #f3f8f4;
        color: #2e7d32;
    }


    .sidebar-link.active {
        background: #eaf5ec;
        color: #2e7d32;

        font-weight: 600;
    }


    /* FOOTER */

    .sidebar-footer {
        flex-shrink: 0;

        padding: 14px;

        border-top: 1px solid #f0f1f1;

        background: #ffffff;
    }


    .user-box {
        display: flex;
        align-items: center;
        gap: 10px;

        padding: 10px;

        margin-bottom: 9px;

        border-radius: 11px;

        background: #f7f9f8;
    }


    .user-avatar {
        width: 36px;
        height: 36px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 50%;

        background: #e1f0e4;
        color: #2e7d32;
    }


    .user-avatar iconify-icon {
        font-size: 17px;
    }


    .user-info {
        min-width: 0;

        display: flex;
        flex-direction: column;
    }


    .user-info strong {
        overflow: hidden;

        color: #374151;

        font-size: 12px;
        font-weight: 700;

        text-overflow: ellipsis;
        white-space: nowrap;
    }


    .user-info span {
        margin-top: 2px;

        color: #9ca3af;

        font-size: 10px;
    }


    .logout-form {
        margin: 0;
    }


    .sidebar-logout {
        width: 100%;

        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        min-height: 40px;

        border: 1px solid #e5e7eb;
        border-radius: 9px;

        background: #ffffff;

        color: #6b7280;

        font-size: 12px;
        font-weight: 600;

        cursor: pointer;

        transition: all 0.2s ease;
    }


    .sidebar-logout:hover {
        border-color: #fecaca;

        background: #fff5f5;

        color: #dc2626;
    }


    .sidebar-logout iconify-icon {
        font-size: 16px;
    }


    @media (max-width: 768px) {

        .app-sidebar {
            width: 220px;
        }

    }

</style>