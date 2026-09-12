@php
    $sizeClass = match ($size) {
        'sm' => 'ui-button-sm',
        'lg' => 'ui-button-lg',
        default => '',
    };

    $variantClass = match ($variant) {
        'success' => 'ui-button-green',
        'primary' => 'ui-button-primary',
        'danger' => 'ui-button-danger',
        'warning' => 'ui-button-warning',
        'secondary' => 'ui-button-secondary',

        'outline-success' => 'ui-button-outline-green',
        'outline-primary' => 'ui-button-outline-primary',
        'outline-danger' => 'ui-button-outline-danger',
        'outline-warning' => 'ui-button-outline-warning',
        'outline-secondary' => 'ui-button-outline-secondary',

        'success-soft' => 'ui-button-soft-green',
        'primary-soft' => 'ui-button-soft-primary',
        'danger-soft' => 'ui-button-soft-danger',
        'warning-soft' => 'ui-button-soft-warning',

        default => 'ui-button-green',
    };
@endphp

@if($href)

    <a
        href="{{ $href }}"
        {{ $attributes->merge([
            'class' => "ui-button {$variantClass} {$sizeClass}"
        ]) }}
    >
        {{ $slot }}
    </a>

@else

    <button
        type="{{ $type }}"
        {{ $attributes->merge([
            'class' => "ui-button {$variantClass} {$sizeClass}"
        ]) }}
    >
        {{ $slot }}
    </button>

@endif


<style>

    .ui-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        min-height: 40px;
        padding: 9px 16px;

        border-radius: 11px;
        border: 1px solid transparent;

        font-size: 13px;
        font-weight: 600;

        line-height: 1;
        text-decoration: none;
        white-space: nowrap;

        cursor: pointer;

        transition:
            background .2s ease,
            border-color .2s ease,
            color .2s ease,
            box-shadow .2s ease,
            transform .2s ease;
    }

    .ui-button:hover {
        transform: translateY(-1px);
    }

    .ui-button:active {
        transform: translateY(0);
    }


    /* =========================
       SIZE
    ========================= */

    .ui-button-sm {
        min-height: 34px;
        padding: 7px 11px;
        border-radius: 9px;
        font-size: 12px;
    }

    .ui-button-lg {
        min-height: 46px;
        padding: 11px 19px;
        border-radius: 12px;
        font-size: 14px;
    }


    /* =========================
       SOLID
    ========================= */

    .ui-button-green {
        background: #2E7D32;
        color: #ffffff;
    }

    .ui-button-green:hover {
        background: #1B5E20;
        color: #ffffff;
        box-shadow: 0 6px 18px rgba(46, 125, 50, .18);
    }


    .ui-button-primary {
        background: #43A047;
        color: #ffffff;
    }

    .ui-button-primary:hover {
        background: #388E3C;
        color: #ffffff;
        box-shadow: 0 6px 18px rgba(67, 160, 71, .18);
    }


    .ui-button-danger {
        background: #D9534F;
        color: #ffffff;
    }

    .ui-button-danger:hover {
        background: #C9302C;
        color: #ffffff;
    }


    .ui-button-warning {
        background: #C89B3C;
        color: #ffffff;
    }

    .ui-button-warning:hover {
        background: #B4872E;
        color: #ffffff;
    }


    .ui-button-secondary {
        background: #6B7280;
        color: #ffffff;
    }

    .ui-button-secondary:hover {
        background: #4B5563;
        color: #ffffff;
    }


    /* =========================
       OUTLINE
    ========================= */

    .ui-button-outline-green {
        background: transparent;
        color: #2E7D32;
        border-color: #81C784;
    }

    .ui-button-outline-green:hover {
        background: rgba(46, 125, 50, .06);
        border-color: #2E7D32;
        color: #1B5E20;
    }


    .ui-button-outline-primary {
        background: transparent;
        color: #43A047;
        border-color: #A5D6A7;
    }

    .ui-button-outline-primary:hover {
        background: rgba(67, 160, 71, .06);
        border-color: #43A047;
        color: #2E7D32;
    }


    .ui-button-outline-danger {
        background: transparent;
        color: #D9534F;
        border-color: #E8A7A4;
    }

    .ui-button-outline-danger:hover {
        background: rgba(217, 83, 79, .06);
        border-color: #D9534F;
        color: #C9302C;
    }


    .ui-button-outline-warning {
        background: transparent;
        color: #A97A16;
        border-color: #D8BE77;
    }

    .ui-button-outline-warning:hover {
        background: rgba(200, 155, 60, .07);
        border-color: #C89B3C;
        color: #8F6D16;
    }


    .ui-button-outline-secondary {
        background: transparent;
        color: #6B7280;
        border-color: #C9CED4;
    }

    .ui-button-outline-secondary:hover {
        background: rgba(107, 114, 128, .06);
        border-color: #6B7280;
        color: #4B5563;
    }


    /* =========================
       SOFT / TRANSPARENT
    ========================= */

    .ui-button-soft-green {
        background: rgba(46, 125, 50, .10);
        color: #2E7D32;
        border-color: rgba(46, 125, 50, .22);
    }

    .ui-button-soft-green:hover {
        background: rgba(46, 125, 50, .16);
        border-color: rgba(46, 125, 50, .35);
        color: #1B5E20;
    }


    .ui-button-soft-primary {
        background: rgba(67, 160, 71, .10);
        color: #388E3C;
        border-color: rgba(67, 160, 71, .22);
    }

    .ui-button-soft-primary:hover {
        background: rgba(67, 160, 71, .16);
        border-color: rgba(67, 160, 71, .35);
        color: #2E7D32;
    }


    .ui-button-soft-danger {
        background: rgba(217, 83, 79, .08);
        color: #C9302C;
        border-color: rgba(217, 83, 79, .20);
    }

    .ui-button-soft-danger:hover {
        background: rgba(217, 83, 79, .14);
        border-color: rgba(217, 83, 79, .32);
        color: #B52A27;
    }


    .ui-button-soft-warning {
        background: rgba(200, 155, 60, .10);
        color: #8F6D16;
        border-color: rgba(200, 155, 60, .22);
    }

    .ui-button-soft-warning:hover {
        background: rgba(200, 155, 60, .16);
        border-color: rgba(200, 155, 60, .34);
        color: #7A5D10;
    }


    /* =========================
       ICONIFY
    ========================= */

    .ui-button iconify-icon {
        font-size: 17px;
        line-height: 1;
    }

    .ui-button-sm iconify-icon {
        font-size: 15px;
    }

    .ui-button-lg iconify-icon {
        font-size: 18px;
    }

</style>