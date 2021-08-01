<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: black;
        }

        /* Float four columns side by side */
        .column {
            float: left;
            width: 90%;
            padding: 0 10px;
        }

        /* Remove extra left and right margins, due to padding */
        .row {
            margin: 0 -5px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive columns */
        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }

        /* Style the counter cards */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 16px;
            text-align: center;
            background-color: white;
        }

    </style>
</head>
<body>

    <div class="row">
        <div class="column">
            <div class="card">
                {{-- <img src="{{asset('storage/images/AAST-TRAINERY/AAST-TRAINERY-LOGO.png')}}" alt=""> --}}
                <h2>E-Commerce</h2>
                <h4>
                    To reset your password Please <a href="{{config('app.url')}}/student/reset/{{$token}}">Click here</a>
                </h4>
            </div>
        </div>
    </div>
</body>
</html>
