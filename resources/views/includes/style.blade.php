    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="{{ url('/style/main.css') }}" rel="stylesheet" />
    <style>
        /* Membuat carousel lebih responsif */
        .carousel-inner {
            max-height: 360px;
            max-width: 100%;
            border-radius: 20px;
        }

        /* Responsif untuk layar lebih kecil */
        @media (max-width: 768px) {
            .carousel-inner {
                max-height: 240px;
                border-radius: 15px;
            }
        }

        @media (max-width: 576px) {
            .carousel-inner {
                max-height: 180px;
                border-radius: 10px;
            }
        }

        button {
            padding: 12.5px 30px;
            border: 0;
            border-radius: 100px;
            background-color: #1ade79;
            color: #ffffff;
            font-weight: Bold;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
        }

        button:hover {
            background-color: #0ba25e;
            box-shadow: 0 0 20px #6fc5ff50;
            transform: scale(1.1);
        }

        button:active {
            background-color: #30dda9;
            transition: all 0.25s;
            -webkit-transition: all 0.25s;
            box-shadow: none;
            transform: scale(0.98);
        }
    </style>

