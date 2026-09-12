<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $title ?? 'Sistem Kasir Hidroponik' }}
    </title>


    {{-- =========================
        BOOTSTRAP
    ========================== --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- =========================
        ICONIFY
    ========================== --}}

    <script
        src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"
    ></script>


    {{-- =========================
        STYLE
    ========================== --}}

    <style>

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }


        body {
            background-color: #f5f7f6;
            overflow-x: hidden;
        }


        /* =================================
           MAIN CONTENT
        ================================= */

        .app-content {
            width: calc(100% - 250px);

            min-height: 100vh;

            margin-left: 250px;

            background-color: #f5f7f6;
        }


        .content-inner {
            width: 100%;

            min-height: 100vh;

            padding: 30px;
        }


        /* =================================
           SWEETALERT CONFIRMATION
        ================================= */

        .hydroponic-swal {
            border-radius: 18px !important;
            padding: 28px !important;
        }


        .hydroponic-swal .swal2-title {
            color: #26352a;
            font-size: 20px;
            font-weight: 700;
        }


        .hydroponic-swal .swal2-html-container {
            color: #7d8780;
            font-size: 13px;
            line-height: 1.6;
        }


        .swal-confirm-button,
        .swal-cancel-button {
            min-width: 110px;

            padding: 10px 16px;

            border-radius: 10px;

            font-size: 13px;
            font-weight: 600;

            cursor: pointer;

            transition:
                background .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }


        .swal-confirm-button:hover,
        .swal-cancel-button:hover {
            transform: translateY(-1px);
        }


        .swal-confirm-button {
            margin-left: 8px;

            background: #2E7D32;
            color: #ffffff;

            border: 1px solid #2E7D32;
        }


        .swal-confirm-button:hover {
            background: #1B5E20;
            border-color: #1B5E20;
        }


        .swal-cancel-button {
            background: rgba(107, 114, 128, .08);
            color: #6B7280;

            border: 1px solid rgba(107, 114, 128, .18);
        }


        .swal-cancel-button:hover {
            background: rgba(107, 114, 128, .14);
        }


        /* =================================
           SWEETALERT TOAST
        ================================= */

        .hydroponic-toast {
            margin-top: 16px !important;

            border-radius: 14px !important;

            padding: 13px 16px !important;

            box-shadow:
                0 10px 30px rgba(30, 60, 35, .10) !important;

            font-size: 13px !important;
        }


        .hydroponic-toast .swal2-title {
            font-size: 13px !important;
            font-weight: 600 !important;

            color: #344238 !important;
        }


        .hydroponic-toast .swal2-timer-progress-bar {
            background: #2E7D32 !important;
        }


        /* =================================
           RESPONSIVE
        ================================= */

        @media (max-width: 768px) {

            .app-content {
                width: calc(100% - 220px);

                margin-left: 220px;
            }


            .content-inner {
                padding: 20px;
            }

        }

    </style>

</head>


<body>


    {{-- =========================
        SIDEBAR
    ========================== --}}

    <x-sidebar
        :active="$active ?? ''"
    />


    {{-- =========================
        CONTENT
    ========================== --}}

    <main class="app-content">

        <div class="content-inner">

            {{ $slot }}

        </div>

    </main>


    {{-- =========================
        BOOTSTRAP JS
    ========================== --}}

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>


    {{-- =========================
        SWEETALERT2
    ========================== --}}

    <script
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11"
    ></script>


    {{-- =========================
        GLOBAL CONFIRMATION
    ========================== --}}

    <script>

        document.addEventListener('click', function (event) {

            const button = event.target.closest('[data-confirm]');


            if (!button) {
                return;
            }


            event.preventDefault();


            const form = button.closest('form');


            if (!form) {
                return;
            }


            const title =
                button.dataset.confirmTitle ||
                'Konfirmasi tindakan';


            const message =
                button.dataset.confirm ||
                'Apakah kamu yakin ingin melanjutkan?';


            const confirmText =
                button.dataset.confirmButton ||
                'Ya, lanjutkan';


            const cancelText =
                button.dataset.cancelButton ||
                'Batal';


            Swal.fire({

                title: title,

                text: message,

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: confirmText,

                cancelButtonText: cancelText,

                reverseButtons: true,

                focusCancel: true,

                buttonsStyling: false,

                customClass: {

                    popup: 'hydroponic-swal',

                    confirmButton: 'swal-confirm-button',

                    cancelButton: 'swal-cancel-button'

                }

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    </script>


    {{-- =========================
        SUCCESS TOAST
    ========================== --}}

    @if(session('success'))

        <script>

            Swal.fire({

                toast: true,

                position: 'top-end',

                icon: 'success',

                title: @js(session('success')),

                showConfirmButton: false,

                showCloseButton: true,

                timer: 3000,

                timerProgressBar: true,

                customClass: {

                    popup: 'hydroponic-toast'

                }

            });

        </script>

    @endif


    {{-- =========================
        ERROR TOAST
    ========================== --}}

    @if(session('error'))

        <script>

            Swal.fire({

                toast: true,

                position: 'top-end',

                icon: 'error',

                title: @js(session('error')),

                showConfirmButton: false,

                showCloseButton: true,

                timer: 3500,

                timerProgressBar: true,

                customClass: {

                    popup: 'hydroponic-toast'

                }

            });

        </script>

    @endif


    {{-- =========================
        VALIDATION ERROR TOAST
    ========================== --}}

    @if($errors->any())

        <script>

            Swal.fire({

                toast: true,

                position: 'top-end',

                icon: 'error',

                title: 'Periksa kembali input kamu.',

                showConfirmButton: false,

                showCloseButton: true,

                timer: 3500,

                timerProgressBar: true,

                customClass: {

                    popup: 'hydroponic-toast'

                }

            });

        </script>

    @endif


</body>

</html>