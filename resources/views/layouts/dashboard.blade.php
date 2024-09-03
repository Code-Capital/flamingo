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
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styling -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    @yield('styles')
    <style>
        /* CSS */
        label.required::after {
            content: " *";
            color: red;
        }

        .select2-container .select2-selection--multiple,
        .select2-container .select2-selection--single {
            width: 100% !important;
            min-height: 44px !important;
            border: 1px solid #ced4da !important;
            border-radius: 8px !important;
            line-height: 25px !important;
            font-size: 16px !important;
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

        <!-- Modal -->
        <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="#" method="POST" id="reportForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="reportModalLabel">Report reason</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <textarea name="reason" id="" cols="30" rows="5" class="form-control"
                                placeholder="Please provide proper reason" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.3.js') }} "></script>
    <script src="{{ asset('js/popper.min.js') }} "></script>
    <script src="{{ asset('js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('js/select2.min.js') }} "></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
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
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.1/echo.js"></script>

    <script>
        let message = '';
        document.addEventListener('DOMContentLoaded', function() {
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('9a5d76ef216853ed60cf', {
                cluster: 'us3',
            });

            userId = '{{ auth()->id() }}';

            var channel = pusher.subscribe('user.' + userId);
            channel.bind('post-created', function(data) {
                console.log(data);
                newNotificationSound();
                // Display the notification as an HTML message
                toastr.options = {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    timeOut: 3000, // Duration before the toast disappears
                    extendedTimeOut: 3000,
                    tapToDismiss: false,
                    escapeHtml: false,
                    allowHtml: true,
                    onclick: function() {
                        window.open(data.link);
                    }
                };
                toastr.success(data.message);
            });
            // var postUrl = '{{ route('post.edit', ':uuid') }}';
            // var eventUrl = '{{ route('events.show', ':slug') }}';

            // in notification function
            // var message = 'New post created by ' + data.full_name;

            // // Replace ':uuid' in the URL with the actual post UUID
            // postUrl = postUrl.replace(':uuid', data.post.uuid);
            // const postLink = `<a href="${postUrl}">Click here</a> to view the post.`;
            // Display the notification with the link to the new post
            // toastr.success(message + ' ' + postLink);
            // location.reload(); // Uncomment if you want to reload the page

            // var channel = pusher.subscribe('event.user.' + userId);
            // channel.bind('event-created', function(data) {
            //     console.log(data);
            //     newNotificationSound();
            //     var message = 'New event created by ' + data.full_name;

            //     // Replace ':uuid' in the URL with the actual post UUID
            //     eventUrl = eventUrl.replace(':slug', data.event.slug);

            //     const eventLink = `<a href="${eventUrl}">Click here</a> to view the event.`;

            //     // Display the notification with the link to the new post
            //     toastr.success(message + ' ' + eventLink);
            //     // location.reload(); // Uncomment if you want to reload the page
            // });

        });
    </script>
    @yield('scripts')
</body>

</html>
