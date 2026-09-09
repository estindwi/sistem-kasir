<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-4">

        <li class="breadcrumb-item">
            <a
                href="{{ route('dashboard') }}"
                class="text-decoration-none"
            >
                🏠 Dashboard
            </a>
        </li>

        @foreach($items as $item)

            @if(isset($item['url']))

                <li class="breadcrumb-item">
                    <a
                        href="{{ $item['url'] }}"
                        class="text-decoration-none"
                    >
                        {{ $item['label'] }}
                    </a>
                </li>

            @else

                <li
                    class="breadcrumb-item active"
                    aria-current="page"
                >
                    {{ $item['label'] }}
                </li>

            @endif

        @endforeach

    </ol>
</nav>