<div class="card shadow-sm {{ $class }}">

    @if($title)
        <div class="card-header bg-white">
            <h5 class="mb-0">
                {{ $title }}
            </h5>
        </div>
    @endif

    <div class="card-body">
        {{ $slot }}
    </div>

</div>