<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Login - Sistem Kasir Hidroponik
    </title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <script
        src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"
    ></script>


    <style>

        * {
            box-sizing: border-box;
        }


        body {
            min-height: 100vh;
            margin: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #f5f7f6;
        }


        .login-page {
            width: 100%;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px;
        }


        .login-wrapper {
            width: 100%;
            max-width: 430px;
        }


        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;

            margin-bottom: 24px;

            text-align: center;
        }


        .brand-icon {
            width: 58px;
            height: 58px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 12px;

            border-radius: 16px;

            background: #2e7d32;
            color: #ffffff;

            box-shadow:
                0 8px 20px rgba(46, 125, 50, .18);
        }


        .brand-icon iconify-icon {
            font-size: 28px;
        }


        .brand h1 {
            margin: 0;

            color: #26352a;

            font-size: 22px;
            font-weight: 700;
        }


        .brand p {
            margin: 5px 0 0;

            color: #8a948d;

            font-size: 13px;
        }


        .login-card {
            padding: 30px;

            border: 1px solid #e6ebe7;

            border-radius: 18px;

            background: #ffffff;

            box-shadow:
                0 12px 35px rgba(30, 60, 35, .08);
        }


        .login-title {
            margin-bottom: 5px;

            color: #374151;

            font-size: 18px;
            font-weight: 700;
        }


        .login-description {
            margin-bottom: 24px;

            color: #8a948d;

            font-size: 13px;
        }


        .form-label {
            margin-bottom: 7px;

            color: #374151;

            font-size: 13px;
            font-weight: 600;
        }


        .form-control {
            min-height: 45px;

            padding: 10px 12px;

            border-radius: 10px;

            border-color: #dfe5e1;

            font-size: 13px;
        }


        .form-control:focus {
            border-color: #81b586;

            box-shadow:
                0 0 0 3px rgba(46, 125, 50, .08);
        }


        .input-wrapper {
            position: relative;
        }


        .input-icon {
            position: absolute;

            top: 50%;
            left: 13px;

            transform: translateY(-50%);

            color: #9ca3af;

            font-size: 17px;

            pointer-events: none;
        }


        .input-wrapper .form-control {
            padding-left: 40px;
        }


        .login-button {
            width: 100%;

            min-height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            margin-top: 8px;

            border: none;
            border-radius: 10px;

            background: #2e7d32;
            color: #ffffff;

            font-size: 13px;
            font-weight: 600;

            transition:
                background .2s ease,
                transform .2s ease;
        }


        .login-button:hover {
            background: #1b5e20;

            transform: translateY(-1px);
        }


        .login-footer {
            margin-top: 20px;

            text-align: center;

            color: #9ca3af;

            font-size: 11px;
        }


        .error-box {
            margin-bottom: 20px;

            padding: 12px 14px;

            border-radius: 10px;

            background: #fff1f1;

            color: #b91c1c;

            font-size: 12px;
        }


        .error-box ul {
            margin: 0;
            padding-left: 17px;
        }


        @media (max-width: 576px) {

            .login-page {
                padding: 20px;
            }


            .login-card {
                padding: 24px 20px;
            }

        }

    </style>

</head>


<body>

    <main class="login-page">

        <div class="login-wrapper">


            {{-- BRAND --}}
            <div class="brand">

                <div class="brand-icon">
                    <iconify-icon icon="lucide:leaf"></iconify-icon>
                </div>

                <h1>
                    Hidroponik
                </h1>

                <p>
                    Kasir System
                </p>

            </div>


            {{-- LOGIN CARD --}}
            <div class="login-card">

                <h2 class="login-title">
                    Selamat datang
                </h2>

                <p class="login-description">
                    Masuk untuk mengelola sistem kasir hidroponik.
                </p>


                @if ($errors->any())

                    <div class="error-box">

                        <strong>
                            Login gagal
                        </strong>

                        <ul class="mt-2">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    action="{{ route('login.authenticate') }}"
                    method="POST"
                >
                    @csrf


                    {{-- USERNAME --}}
                    <div class="mb-3">

                        <label
                            for="username"
                            class="form-label"
                        >
                            Username
                        </label>

                        <div class="input-wrapper">

                            <iconify-icon
                                icon="lucide:user-round"
                                class="input-icon"
                            ></iconify-icon>

                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control"
                                value="{{ old('username') }}"
                                placeholder="Masukkan username"
                                autocomplete="username"
                                required
                                autofocus
                            >

                        </div>

                    </div>


                    {{-- PASSWORD --}}
                    <div class="mb-4">

                        <label
                            for="password"
                            class="form-label"
                        >
                            Password
                        </label>

                        <div class="input-wrapper">

                            <iconify-icon
                                icon="lucide:lock-keyhole"
                                class="input-icon"
                            ></iconify-icon>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                autocomplete="current-password"
                                required
                            >

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="login-button"
                    >

                        <iconify-icon
                            icon="lucide:log-in"
                        ></iconify-icon>

                        Masuk

                    </button>

                </form>

            </div>


            <div class="login-footer">
                Sistem Kasir Hidroponik
            </div>

        </div>

    </main>

</body>

</html>