<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <title>Home | @yield('title') </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link href="{{ asset('assets/css/frontend/main.css?v-', rand(1, 9)) }}" rel="stylesheet" />

    @stack('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="{{ asset('assets/css/frontend/toastr.min.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    @livewireStyles()
</head>

<body>

    @yield('content')
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-body-secondary">Copyright © {{ date('Y') }} {{ config('app.name') }}
                    .Com | Beta Version 1.0</span>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/frontend/color.js') }}"></script>
    <script src="{{ asset('assets/js/frontend/toastr.min.js') }}"></script>
    <script type="text/javascript">
        var swiper;
        var swiper2;

        document.addEventListener('DOMContentLoaded', function() {
            swiper = new Swiper(".mySwiper", {
                spaceBetween: 10,
                slidesPerView: 7,
                freeMode: true,
                watchSlidesProgress: true,
            });

            swiper2 = new Swiper(".mySwiper2", {
                spaceBetween: 10,
                centeredSlides: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: swiper,
                },
            });

            swiper2.on('click', function() {
                var activeSlideIndex = swiper2.clickedIndex;
                openModal(activeSlideIndex);
            });
        });

        function pauseAutoplay() {
            swiper2.autoplay.stop();
        }

        function resumeAutoplay() {
            swiper2.autoplay.start();
        }

        function openModal(slideIndex) {
            var modal = document.getElementById('imageModal');
            var modalImage = document.getElementById('modalImage');
            modalImage.src = swiper2.slides[slideIndex].querySelector('img').src;
            modal.style.display = "block";
        }

        function closeModal() {
            var modal = document.getElementById('imageModal');
            modal.style.display = "none";
        }
    </script>
    @stack('js')
    @livewireScripts()
</body>

</html>
