<nav aria-label="breadcrumb" class="ui-breadcrumb">
    <ol class="ui-breadcrumb-list">

        <li class="ui-breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="ui-breadcrumb-link">
                <x-icon name="lucide:house" />
                <span>Dashboard</span>
            </a>
        </li>

        @foreach ($items as $item)

            <li class="ui-breadcrumb-separator">
                <x-icon name="lucide:chevron-right" />
            </li>

            <li
                class="ui-breadcrumb-item
                {{ empty($item['url']) ? 'ui-breadcrumb-current' : '' }}"
            >

                @if (!empty($item['url']))
                    <a href="{{ $item['url'] }}" class="ui-breadcrumb-link">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span>{{ $item['label'] }}</span>
                @endif

            </li>

        @endforeach

    </ol>
</nav>

<style>
    .ui-breadcrumb {
        margin-bottom: 22px;
    }

    .ui-breadcrumb-list {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .ui-breadcrumb-item {
        display: flex;
        align-items: center;
        font-size: 14px;
        color: #6b7280;
    }

    .ui-breadcrumb-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #6b7280;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .ui-breadcrumb-link:hover {
        color: #2e7d32;
    }

    .ui-breadcrumb-link iconify-icon {
        font-size: 16px;
    }

    .ui-breadcrumb-separator {
        display: flex;
        align-items: center;
        color: #b0b7b3;
    }

    .ui-breadcrumb-separator iconify-icon {
        font-size: 14px;
    }

    .ui-breadcrumb-current {
        color: #374151;
        font-weight: 600;
    }
</style>