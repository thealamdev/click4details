<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Vehicle Name:' . $vehicle->translate }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            outline: 0;
            box-sizing: border-box;
        }

        a,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        ul,
        li {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 1170px;
            margin: 0 auto;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        .content-main {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .vehicle-image {
            width: 46%;
        }

        .vehicle-image img {
            width: 100%;
            border-radius: 10px;
        }

        .vehicle-details {
            width: 46%;
        }

        .detail-title {
            margin-bottom: 10px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .detail-title h4 {
            width: 25%;
        }

        .detail-title h5 {
            width: 10%;
        }

        .detail-title p {
            width: 65%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content-main">
            <div class="vehicle-image">
                <img src="{{ asset('storage/vehicles/' . $vehicle->image->name) }}" class="card-img-top rounded"
                    loading="lazy" alt="{{ asset('storage/vehicles/' . $vehicle->image->name) }}" />
            </div>

            <div class="vehicle-image">
                <img src="" class="card-img-top rounded" loading="lazy"
                    alt="{{ $vehicle?->image->preview() }}" />
            </div>

            <div class="vehicle-details">
                <div class="detail-title">
                    <h4>Vehicle Name: </h4>
                    <h5>:</h5>
                    <p>{{ toLocaleString($vehicle->translate) }}</p>
                </div>

                <div class="detail-title">
                    <h4>Vehicle Name: </h4>
                    <h5>:</h5>
                    <p>Toyota Car</p>
                </div>

                <div class="detail-title">
                    <h4>Vehicle Name: </h4>
                    <h5>:</h5>
                    <p>Toyota Car</p>
                </div>

                <div class="detail-title">
                    <h4>Vehicle Name: </h4>
                    <h5>:</h5>
                    <p>Toyota Car</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
