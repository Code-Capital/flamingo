<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Flamingo')) - {{ config('app.name', 'Flamingo') }}</title>
    <link rel="apple-touch-icon" sizes="512x512" href="{{ asset('assets/favicon/android-chrome-512x512.png') }}">
    <link rel="apple-touch-icon" sizes="192x192" href=" {{ asset('assets/favicon/android-chrome-192x192.png') }} ">
    <link rel="apple-touch-icon" sizes="180x180" href=" {{ asset('assets/favicon/apple-touch-icon.png') }} ">
    <link rel="apple-touch-icon" sizes="150x150" href=" {{ asset('assets/favicon/mstile-150x150.png') }} ">
    <link rel="icon" type="image/png" sizes="32x32" href=" {{ asset('assets/favicon/favicon-32x32.png') }} ">
    <link rel="icon" type="image/png" sizes="16x16" href=" {{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href=" {{ asset('assets/favicon/site.webmanifest') }} ">
    <meta name="{{ config('app.name', 'Flamingo') }}" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styling -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    @yield('styles')
    <style>
        /* CSS */
        label.required::after {
            content: " *";
            color: red;
        }
    </style>
</head>

<body>
    <main>
        <div id="wrapper" class="dashboardWrapper d-flex align-items-stretch">
            @include('layouts.dashboard.sidebar')
            <div id="content-wrapper" class="contentWrapper h-100">
                @include('layouts.dashboard.navbar')
                @include('layouts.partial.show-error')
                @yield('content')
            </div>
        </div>
        <div class="modal fade" id="joinCommunity" tabindex="-1" aria-labelledby="joinCommunityLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-3 p-md-3 p-lg-5">
                        <div class="text-center px-0 px-md-0 px-lg-5">
                            <img src=" {{ asset('assets/icon8.svg') }}">
                            <h1 class="my-4">Join Our Community</h1>
                            <p>Ready to dive in? Join our community today to start connecting, sharing, and discovering
                                with
                                individuals who share your interests and passions. Subscribe now to become part of our
                                growing community!</p>
                            <a href="friends-feed" type="button" class="btn btn-primary mt-5 px-4">Subscribe Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=" {{ asset('js/jquery-3.6.3.js') }} "></script>
    <script src=" {{ asset('js/popper.min.js') }} "></script>
    <script src=" {{ asset('js/bootstrap.min.js') }} "></script>
    <script src=" {{ asset('js/select2.min.js') }} "></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @include('layouts.common-scripts')

    <script>
        $("#imageUpload").change(function() {
            const fileName = this.files[0]?.name; // Get the first selected file's name
            const $fileNameSpan = $("#fileNameSpan");

            if (fileName) {
                $fileNameSpan.text(fileName); // Show the file name
            } else {
                $fileNameSpan.text(""); // If no file, ensure it's empty
            }
        });
    </script>
    <script>
        const $button = document.querySelector('#sidebar-toggle');
        const $wrapper = document.querySelector('#wrapper');

        $button.addEventListener('click', (e) => {
            e.preventDefault();
            $wrapper.classList.toggle('toggled');
        });
    </script>
    <script>
        $(".chatBtn").click(function() {
            $(".chatSidebar").toggleClass("chatSidebarshow");
        });
    </script>
    @yield('scripts')
</body>

</html>
