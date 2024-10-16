<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehicle of - {{ $detail->merchant->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .modal-fullscreen {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        .modal-fullscreen .modal-content {
            height: 100%;
            border: 0;
        }

        .modal-fullscreen .modal-body {
            max-height: calc(100% - 120px);
            overflow-y: auto;
        }

        .modal-fullscreen .modal-body img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h2 class="h4">A Product of - {{ $detail->merchant->name }}</h2>
            </div>
            <div class="card-body">
                @foreach ($detail->gallery as $index => $each)
                    <div class="swiper-slide d-inline-block" style="width: 300px">
                        <img src="{{ $each->preview() }}" class="img-fluid rounded-3 object-fit-cover w-100 shadow"
                            loading="lazy" style="max-height: 300px; width: 100%;" />
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-3">
            <button id="downloadButton" class="btn btn-success">Download All</button>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="previewImage" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
        // Function to handle image click and display preview
        function displayImagePreview(imageUrl) {
            const previewImage = document.getElementById('previewImage');
            previewImage.src = imageUrl;

            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }

        // Function to trigger image download
        function downloadImage(url) {
            const filename = generateUniqueFilename();

            const anchor = document.createElement('a');
            anchor.href = url;
            anchor.download = filename;

            document.body.appendChild(anchor);
            anchor.click();
            document.body.removeChild(anchor);
        }

        // Function to generate a unique filename
        function generateUniqueFilename() {
            const timestamp = new Date().getTime(); // Current timestamp
            const randomString = Math.random().toString(36).substring(7); // Random string
            return `image_${timestamp}_${randomString}.jpg`; // Unique filename
        }

        // Function to handle download button click
        document.getElementById('downloadButton').addEventListener('click', function() {
            const imageElements = document.querySelectorAll('.card-body img');
            imageElements.forEach((img) => {
                const imageUrl = img.src;
                downloadImage(imageUrl);
            });
        });

        // Attach click event to each image for preview
        const imageElements = document.querySelectorAll('.card-body img');
        imageElements.forEach((img) => {
            img.addEventListener('click', function() {
                const imageUrl = img.src;
                displayImagePreview(imageUrl);
            });
        });
    </script>

</body>

</html>
