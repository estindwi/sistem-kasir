<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Sistem Kasir Hidroponik' }}</title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Iconify --}}
    <script
        src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js">
    </script>

    <style>

        body {
            background-color: #f5f7f6;
            margin: 0;
        }

        .content {
            padding: 30px;
            min-height: 100vh;
        }

        @media (max-width: 767px) {

            .content {
                padding: 20px;
            }

        }

    </style>

</head>

<body>

    <div class="container-fluid">

        <div class="row">

            {{-- SIDEBAR --}}
            <x-sidebar :active="$active ?? ''" />

            {{-- CONTENT --}}
            <main class="col-md-9 col-lg-10 content">

                {{ $slot }}

            </main>

        </div>

    </div>


    {{-- Bootstrap JS --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>