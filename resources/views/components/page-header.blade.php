<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            {{ $title }}
        </h2>

        @if($description)
            <p class="text-muted mb-0">
                {{ $description }}
            </p>
        @endif
    </div>

    @if($slot->isNotEmpty())
        <div>
            {{ $slot }}
        </div>
    @endif

</div>