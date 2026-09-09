<div class="col-md-3 col-lg-2 sidebar p-0">

    <div class="sidebar-wrapper">

        {{-- BRAND --}}
        <div class="brand-section">
            <div class="brand-icon">
                <x-icon name="lucide:leaf" />
            </div>

            <div>
                <div class="brand-title">
                    Hidroponik
                </div>

                <div class="brand-subtitle">
                    Kasir System
                </div>
            </div>
        </div>


        {{-- MENU --}}
        <div class="menu-section">

            <div class="menu-label">
                MENU UTAMA
            </div>


            {{-- Dashboard --}}
            <a
                href="{{ route('dashboard') }}"
                class="menu-item {{ $active === 'dashboard' ? 'active' : '' }}"
            >

                <span class="menu-icon">
                    <x-icon name="lucide:layout-dashboard" />
                </span>

                <span class="menu-text">
                    Dashboard
                </span>

            </a>


            {{-- Produk --}}
            <a
                href="{{ route('produk.index') }}"
                class="menu-item {{ $active === 'produk' ? 'active' : '' }}"
            >

                <span class="menu-icon">
                    <x-icon name="lucide:package" />
                </span>

                <span class="menu-text">
                    Produk
                </span>

            </a>


            {{-- Transaksi --}}
            <a
                href="{{ route('transaksi.index') }}"
                class="menu-item {{ $active === 'transaksi' ? 'active' : '' }}"
            >

                <span class="menu-icon">
                    <x-icon name="lucide:shopping-cart" />
                </span>

                <span class="menu-text">
                    Transaksi Penjualan
                </span>

            </a>


            {{-- Kategori Pengeluaran --}}
            <a
                href="{{ route('kategori-pengeluaran.index') }}"
                class="menu-item {{ $active === 'kategori' ? 'active' : '' }}"
            >

                <span class="menu-icon">
                    <x-icon name="lucide:tags" />
                </span>

                <span class="menu-text">
                    Kategori Pengeluaran
                </span>

            </a>


            {{-- Pengeluaran --}}
            <a
                href="#"
                class="menu-item"
            >

                <span class="menu-icon">
                    <x-icon name="lucide:wallet" />
                </span>

                <span class="menu-text">
                    Pengeluaran
                </span>

            </a>


            {{-- Laporan --}}
            <a
                href="#"
                class="menu-item"
            >

                <span class="menu-icon">
                    <x-icon name="lucide:chart-no-axes-combined" />
                </span>

                <span class="menu-text">
                    Laporan Keuangan
                </span>

            </a>

        </div>


        {{-- BOTTOM --}}
        <div class="sidebar-bottom">

            <div class="user-box">

                <div class="user-avatar">
                    <x-icon name="lucide:user-round" />
                </div>

                <div class="user-info">

                    <div class="user-name">
                        {{ auth()->user()->nama ?? 'User' }}
                    </div>

                    <div class="user-role">
                        Kasir
                    </div>

                </div>

            </div>


            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >

                    <x-icon name="lucide:log-out" />

                    <span>
                        Keluar
                    </span>

                </button>

            </form>

        </div>

    </div>

</div>


<style>

    .sidebar {
        min-height: 100vh;
        background: #ffffff;
        border-right: 1px solid #e9ecef;
    }


    .sidebar-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        padding: 24px 16px;
    }


    /* BRAND */

    .brand-section {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 4px 8px 30px;
    }


    .brand-icon {
        width: 42px;
        height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #198754;
        color: white;

        border-radius: 12px;

        font-size: 21px;
    }


    .brand-title {
        font-size: 17px;
        font-weight: 700;
        color: #212529;
        line-height: 1.2;
    }


    .brand-subtitle {
        font-size: 12px;
        color: #8a8f98;
        margin-top: 2px;
    }


    /* MENU */

    .menu-section {
        flex: 1;
    }


    .menu-label {
        padding: 0 12px;
        margin-bottom: 10px;

        font-size: 10px;
        font-weight: 700;
        letter-spacing: .08em;

        color: #9aa0a6;
    }


    .menu-item {
        display: flex;
        align-items: center;

        gap: 12px;

        width: 100%;

        padding: 11px 12px;
        margin-bottom: 4px;

        border-radius: 10px;

        text-decoration: none;

        color: #6c757d;

        font-size: 14px;
        font-weight: 500;

        transition:
            background-color .2s ease,
            color .2s ease,
            transform .2s ease;
    }


    .menu-item:hover {
        background: #f3f7f5;
        color: #198754;
    }


    .menu-item.active {
        background: #eaf6ef;
        color: #198754;
        font-weight: 600;
    }


    .menu-icon {
        width: 20px;
        height: 20px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 19px;

        flex-shrink: 0;
    }


    .menu-text {
        white-space: nowrap;
    }


    /* BOTTOM */

    .sidebar-bottom {
        border-top: 1px solid #eeeeee;
        padding-top: 18px;
        margin-top: 20px;
    }


    .user-box {
        display: flex;
        align-items: center;
        gap: 10px;

        padding: 10px 8px 14px;
    }


    .user-avatar {
        width: 36px;
        height: 36px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #f0f2f4;
        color: #6c757d;

        font-size: 17px;
    }


    .user-info {
        min-width: 0;
    }


    .user-name {
        font-size: 13px;
        font-weight: 600;

        color: #212529;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    .user-role {
        font-size: 11px;
        color: #9aa0a6;
        margin-top: 2px;
    }


    .logout-button {
        width: 100%;

        display: flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        padding: 10px 12px;

        border: 1px solid #e4e6e8;
        border-radius: 9px;

        background: #ffffff;
        color: #6c757d;

        font-size: 13px;
        font-weight: 500;

        transition: all .2s ease;
    }


    .logout-button:hover {
        background: #fff5f5;
        border-color: #f1caca;
        color: #dc3545;
    }


    /* MOBILE */

    @media (max-width: 767px) {

        .sidebar {
            min-height: auto;
            border-right: none;
            border-bottom: 1px solid #e9ecef;
        }


        .sidebar-wrapper {
            min-height: auto;
        }

    }

</style>