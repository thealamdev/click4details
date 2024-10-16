<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title') | {{ config('app.name', 'Pilot Bazar') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.17.0/tabler-icons.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/easymde/dist/easymde.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <link href="{{ asset('assets/dist/image/dropify.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/backend/app.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/backend/main.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <link rel= "stylesheet"
        href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/backend/toastr.min.css') }}">
    @yield('css')
</head>

<body>
    <div id="app" class="app">
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')
        <div id="content" class="app-content">
            @yield('content')
        </div>
        @include('layouts.partials.footer')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/perfect-scrollbar/1.5.5/perfect-scrollbar.min.js"></script>
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script defer src="{{ asset('assets/dist/image/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/backend/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/backend/main.js') }}"></script>
    <script src="{{ asset('assets/js/backend/toastr.min.js') }}"></script>
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"
        integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        <?php if (session('status')) : ?>
        toastNotification("<?php echo session('status'); ?>")
        <?php endif; ?>
    </script>
    @stack('script')
    <script src="{{ asset('assets/js/backend/custom.js') }}"></script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '#purchaseBox', function(e) {
                e.preventDefault();
                let dialog = '';
                let modalUrl = $(this).attr('href');
                let route = $(this).attr('action');
                let title = 'Confirm Identification';

                $.ajax({
                    type: "GET",
                    url: modalUrl,
                    success: function(response) {
                        dialog = bootbox.dialog({
                            title: title,
                            message: "<div class='modalContent'></div>",
                            size: 'small',
                        });
                        $('.modalContent').html(response);
                    }
                });

                $(document).ready(function() {
                    $(document).on('submit', '#storeModal', function(e) {
                        e.preventDefault();
                        let formUrl = $(this).attr('action');
                        let formData = new FormData(this);

                        $.ajax({
                            type: "POST",
                            url: formUrl,
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                console.log(response)
                                if (response.status === 200) {
                                    $('.modalContent').modal('hide');
                                    window.location.href = response
                                        .redirect_url;
                                } else {
                                    tosterNotificaton(response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                tosterNotificaton('An error occurred: ' +
                                    error);
                            }
                        });
                    });
                });

            });
        });
    </script>
</body>

</html>
