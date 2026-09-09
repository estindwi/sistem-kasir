@php
    $badgeClass = match ($variant) {

        // SOFT
        'success' => 'ui-badge-success',
        'primary' => 'ui-badge-primary',
        'warning' => 'ui-badge-warning',
        'danger' => 'ui-badge-danger',
        'secondary' => 'ui-badge-secondary',
        'info' => 'ui-badge-info',

        // OUTLINE
        'outline-success' => 'ui-badge-outline-success',
        'outline-primary' => 'ui-badge-outline-primary',
        'outline-warning' => 'ui-badge-outline-warning',
        'outline-danger' => 'ui-badge-outline-danger',
        'outline-secondary' => 'ui-badge-outline-secondary',
        'outline-info' => 'ui-badge-outline-info',

        // SOLID
        'solid-success' => 'ui-badge-solid-success',
        'solid-primary' => 'ui-badge-solid-primary',
        'solid-warning' => 'ui-badge-solid-warning',
        'solid-danger' => 'ui-badge-solid-danger',
        'solid-secondary' => 'ui-badge-solid-secondary',
        'solid-info' => 'ui-badge-solid-info',

        default => 'ui-badge-success',
    };
@endphp


<span class="ui-badge {{ $badgeClass }}">
    {{ $slot }}
</span>


<style>

    /* =================================
       BASE
    ================================= */

    .ui-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 26px;

        padding: 5px 10px;

        border-radius: 7px;

        font-size: 11px;
        font-weight: 600;

        line-height: 1;
        white-space: nowrap;

        border: 1px solid transparent;

        transition:
            background-color .2s ease,
            border-color .2s ease,
            color .2s ease;
    }


    /* =================================
       SOFT
    ================================= */

    .ui-badge-success {
        background: rgba(46, 125, 50, .10);
        border-color: rgba(46, 125, 50, .18);
        color: #2E7D32;
    }


    .ui-badge-primary {
        background: rgba(67, 160, 71, .10);
        border-color: rgba(67, 160, 71, .18);
        color: #388E3C;
    }


    .ui-badge-warning {
        background: rgba(200, 155, 60, .11);
        border-color: rgba(200, 155, 60, .20);
        color: #8F6D16;
    }


    .ui-badge-danger {
        background: rgba(217, 83, 79, .09);
        border-color: rgba(217, 83, 79, .18);
        color: #C9302C;
    }


    .ui-badge-secondary {
        background: rgba(107, 114, 128, .09);
        border-color: rgba(107, 114, 128, .17);
        color: #5F6670;
    }


    .ui-badge-info {
        background: rgba(76, 120, 110, .09);
        border-color: rgba(76, 120, 110, .18);
        color: #456F66;
    }


    /* =================================
       OUTLINE
    ================================= */

    .ui-badge-outline-success {
        background: transparent;
        border-color: #81C784;
        color: #2E7D32;
    }


    .ui-badge-outline-primary {
        background: transparent;
        border-color: #A5D6A7;
        color: #388E3C;
    }


    .ui-badge-outline-warning {
        background: transparent;
        border-color: #D8BE77;
        color: #8F6D16;
    }


    .ui-badge-outline-danger {
        background: transparent;
        border-color: #E8A7A4;
        color: #C9302C;
    }


    .ui-badge-outline-secondary {
        background: transparent;
        border-color: #C9CED4;
        color: #6B7280;
    }


    .ui-badge-outline-info {
        background: transparent;
        border-color: #A8C8C0;
        color: #456F66;
    }


    /* =================================
       SOLID
    ================================= */

    .ui-badge-solid-success {
        background: #2E7D32;
        border-color: #2E7D32;
        color: #ffffff;
    }


    .ui-badge-solid-primary {
        background: #43A047;
        border-color: #43A047;
        color: #ffffff;
    }


    .ui-badge-solid-warning {
        background: #B4872E;
        border-color: #B4872E;
        color: #ffffff;
    }


    .ui-badge-solid-danger {
        background: #D9534F;
        border-color: #D9534F;
        color: #ffffff;
    }


    .ui-badge-solid-secondary {
        background: #6B7280;
        border-color: #6B7280;
        color: #ffffff;
    }


    .ui-badge-solid-info {
        background: #456F66;
        border-color: #456F66;
        color: #ffffff;
    }


    /* =================================
       SIZE
    ================================= */

    .ui-badge-sm {
        min-height: 22px;
        padding: 4px 8px;
        font-size: 10px;
    }


    .ui-badge-lg {
        min-height: 30px;
        padding: 6px 12px;
        font-size: 12px;
    }

</style>