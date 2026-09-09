@php
    $alertClass = match ($type) {
        'success' => 'ui-alert-success',
        'info' => 'ui-alert-info',
        'warning' => 'ui-alert-warning',
        'danger' => 'ui-alert-danger',

        'outline-success' => 'ui-alert-outline-success',
        'outline-info' => 'ui-alert-outline-info',
        'outline-warning' => 'ui-alert-outline-warning',
        'outline-danger' => 'ui-alert-outline-danger',

        'solid-success' => 'ui-alert-solid-success',
        'solid-info' => 'ui-alert-solid-info',
        'solid-warning' => 'ui-alert-solid-warning',
        'solid-danger' => 'ui-alert-solid-danger',

        default => 'ui-alert-success',
    };

    $icon = match ($type) {
        'success',
        'outline-success',
        'solid-success'
            => 'lucide:circle-check',

        'info',
        'outline-info',
        'solid-info'
            => 'lucide:info',

        'warning',
        'outline-warning',
        'solid-warning'
            => 'lucide:triangle-alert',

        'danger',
        'outline-danger',
        'solid-danger'
            => 'lucide:circle-x',

        default => 'lucide:info',
    };
@endphp


<div
    class="ui-alert {{ $alertClass }} {{ $dismissible ? 'ui-alert-dismissible' : '' }}"
    role="alert"
>

    <div class="ui-alert-content">

        <span class="ui-alert-icon">
            <x-icon name="{{ $icon }}" />
        </span>

        <div class="ui-alert-message">
            {{ $slot }}
        </div>

    </div>


    @if($dismissible)

        <button
            type="button"
            class="ui-alert-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        >
            <x-icon name="lucide:x" />
        </button>

    @endif

</div>


<style>

    /* =====================================
       BASE
    ===================================== */

    .ui-alert {
        position: relative;

        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        width: 100%;

        padding: 13px 15px;

        margin-bottom: 12px;

        border: 1px solid transparent;
        border-radius: 11px;

        font-size: 13px;
        line-height: 1.5;

        transition:
            background-color .2s ease,
            border-color .2s ease,
            box-shadow .2s ease;
    }


    .ui-alert-content {
        display: flex;
        align-items: flex-start;
        gap: 10px;

        min-width: 0;
    }


    .ui-alert-icon {
        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        margin-top: 1px;

        font-size: 18px;
    }


    .ui-alert-message {
        flex: 1;

        font-weight: 500;
    }


    .ui-alert-close {
        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        width: 28px;
        height: 28px;

        margin-left: 12px;
        margin-top: -2px;

        padding: 0;

        border: none;
        border-radius: 7px;

        background: transparent;

        opacity: .6;

        cursor: pointer;

        transition:
            background-color .2s ease,
            opacity .2s ease;
    }


    .ui-alert-close:hover {
        opacity: 1;
    }


    .ui-alert-close iconify-icon {
        font-size: 15px;
    }


    /* =====================================
       SOFT / DEFAULT
    ===================================== */

    .ui-alert-success {
        background: rgba(46, 125, 50, .08);
        border-color: rgba(46, 125, 50, .18);
        color: #245f28;
    }

    .ui-alert-success .ui-alert-icon {
        color: #2E7D32;
    }

    .ui-alert-success .ui-alert-close:hover {
        background: rgba(46, 125, 50, .10);
    }


    .ui-alert-info {
        background: rgba(67, 160, 71, .07);
        border-color: rgba(67, 160, 71, .17);
        color: #2F6733;
    }

    .ui-alert-info .ui-alert-icon {
        color: #43A047;
    }

    .ui-alert-info .ui-alert-close:hover {
        background: rgba(67, 160, 71, .10);
    }


    .ui-alert-warning {
        background: rgba(200, 155, 60, .09);
        border-color: rgba(200, 155, 60, .20);
        color: #7A5F1A;
    }

    .ui-alert-warning .ui-alert-icon {
        color: #B4872E;
    }

    .ui-alert-warning .ui-alert-close:hover {
        background: rgba(200, 155, 60, .11);
    }


    .ui-alert-danger {
        background: rgba(217, 83, 79, .07);
        border-color: rgba(217, 83, 79, .18);
        color: #9F3431;
    }

    .ui-alert-danger .ui-alert-icon {
        color: #D9534F;
    }

    .ui-alert-danger .ui-alert-close:hover {
        background: rgba(217, 83, 79, .10);
    }


    /* =====================================
       OUTLINE
    ===================================== */

    .ui-alert-outline-success {
        background: transparent;
        border-color: #81C784;
        color: #2E7D32;
    }

    .ui-alert-outline-success .ui-alert-icon {
        color: #2E7D32;
    }


    .ui-alert-outline-info {
        background: transparent;
        border-color: #A5D6A7;
        color: #388E3C;
    }

    .ui-alert-outline-info .ui-alert-icon {
        color: #43A047;
    }


    .ui-alert-outline-warning {
        background: transparent;
        border-color: #D8BE77;
        color: #8F6D16;
    }

    .ui-alert-outline-warning .ui-alert-icon {
        color: #B4872E;
    }


    .ui-alert-outline-danger {
        background: transparent;
        border-color: #E8A7A4;
        color: #C9302C;
    }

    .ui-alert-outline-danger .ui-alert-icon {
        color: #D9534F;
    }


    /* =====================================
       SOLID
    ===================================== */

    .ui-alert-solid-success {
        background: #2E7D32;
        border-color: #2E7D32;
        color: #ffffff;
    }

    .ui-alert-solid-success .ui-alert-icon {
        color: #ffffff;
    }

    .ui-alert-solid-success .ui-alert-close:hover {
        background: rgba(255,255,255,.12);
    }


    .ui-alert-solid-info {
        background: #43A047;
        border-color: #43A047;
        color: #ffffff;
    }

    .ui-alert-solid-info .ui-alert-icon {
        color: #ffffff;
    }

    .ui-alert-solid-info .ui-alert-close:hover {
        background: rgba(255,255,255,.12);
    }


    .ui-alert-solid-warning {
        background: #B4872E;
        border-color: #B4872E;
        color: #ffffff;
    }

    .ui-alert-solid-warning .ui-alert-icon {
        color: #ffffff;
    }

    .ui-alert-solid-warning .ui-alert-close:hover {
        background: rgba(255,255,255,.12);
    }


    .ui-alert-solid-danger {
        background: #D9534F;
        border-color: #D9534F;
        color: #ffffff;
    }

    .ui-alert-solid-danger .ui-alert-icon {
        color: #ffffff;
    }

    .ui-alert-solid-danger .ui-alert-close:hover {
        background: rgba(255,255,255,.12);
    }


    /* =====================================
       HOVER
    ===================================== */

    .ui-alert:hover {
        box-shadow: 0 4px 14px rgba(30, 60, 35, .05);
    }


    /* =====================================
       RESPONSIVE
    ===================================== */

    @media (max-width: 576px) {

        .ui-alert {
            padding: 12px;
        }

        .ui-alert-message {
            font-size: 12px;
        }

    }

</style>