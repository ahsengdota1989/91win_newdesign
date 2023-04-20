<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>91WIN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Bootstrap Icons CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css" integrity="sha384-Pu3j6JoCIBeFW9M2gAKsa/ScMwJM8/yojNRALvlGggI1DpEVNhnCAzHG/t27Y5Ot" crossorigin="anonymous"> -->

    <style>
        .white-font {
            color: white;
        }

        .purple-bg {
            background-color: #17011f;
            width: 310px;
        }

        .module-border-wrap-active {
            width: 263px;
            padding: 1rem;
            position: relative;
            background: linear-gradient(to right, #8447E9, #A547B4, #E94747);
            padding: 1px;
            border-radius: 7px;
        }

        .module-border-wrap-inactive {
            padding-left: 17px;
        }

        .module-inside {
            background: #17011f;
            color: white;
            padding: 1rem;
            border-radius: 7px;
            height: 60px;
        }

        .sidebar-position {
            top: 10px;
            position: absolute;
        }

        .nav-item {
            padding-bottom: 32px;
        }

        .content-purple-bg {
            background-color: #1d0824;
        }

        .page-title {
            color: white;
            font-size: 27px;
        }

        .top-header {
            padding-left: 30px;
            padding-top: 15px;
        }

        .homepage-sliders {
            padding: 30px;
        }

        .top-header-name {
            width: 230px;
            padding: 1rem;
            position: relative;
            background: linear-gradient(to right, #8447E9, #A547B4, #E94747);
            padding: 1px;
            border-radius: 7px;
        }

        .top-header-name-content {
            background: #17011f;
            color: white;
            padding: 1rem;
            border-radius: 7px;
            height: 45px;
        }

        .video-section {
            padding-left: 30px;
            padding-right: 30px;
        }

        .game-icon-logo {
            width: 100%;
        }

        .top-wallet-balance {}

        .module-border-wrap-inactive:hover {
            width: 263px;
            padding: 1rem;
            position: relative;
            background: linear-gradient(to right, #8447E9, #A547B4, #E94747);
            cursor: pointer;
            border-radius: 7px;
            text-decoration: none;
        }

        .search-bar-css {
            border: 1px solid linear-gradient(to right, #8447E9, #A547B4, #E94747);
        }

        .search-bar-css-input {
            background: #17011f;
        }

        .image-container {
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .overlay:hover {
            opacity: 1;
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 3rem;
            transition: transform 0.3s ease;
        }

        .play-button:hover {
            transform: translate(-50%, -50%) scale(1.2);
        }

        .example-div {
            background-image: url(https://91win88.com/new_design/images/microgaming.png);
            background-size: cover;
            /* adjust the size of the image to fit the div */
            height: 500px;  
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">

            <!-- left sidebar -->
            @include('layouts.sidebar.left-sidebar-livecasino')

            <!-- content area -->
            <div class="col py-3 content-purple-bg">

                <!-- top header-->
                <div class="example-div" id="top-header">
                    <div class="row top-header">
                        <div class="col-4">
                            <span class="page-title">Live Casino</span>
                        </div>

                        @include('layouts.searchbar')
                    </div>

                </div>


                <div class="row video-section" style="padding-top:5%;border: 2px solid purple;border-radius:30px">

                
                    <div class="col-2">
                        <div class="image-container" onmouseover="changeBackground('images/icons/home-2.png')">
                            <img src="https://91win88.com/new_design/images/microgaming.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><img src="https://p1.hiclipart.com/preview/419/35/642/circular-icon-set-youtube-play-icon-png-clipart-thumbnail.jpg"></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="image-container" onmouseover="changeBackground('images/icons/home-2.png')">
                            <img src="https://91win88.com/new_design/images/microgaming.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="image-container" onmouseover="changeBackground('images/icons/home-2.png')">
                            <img src="https://91win88.com/new_design/images/microgaming.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="image-container" onmouseover="changeBackground('images/icons/home-2.png')">
                            <img src="https://91win88.com/new_design/images/microgaming.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="image-container" onmouseover="changeBackground('images/icons/home-2.png')">
                            <img src="https://91win88.com/new_design/images/microgaming.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="image-container" onmouseover="changeBackground('images/icons/home-2.png')">
                            <img src="https://91win88.com/new_design/images/microgaming.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')

    </div>

    <script type="text/javascript">
        function changeBackground(backimage) {
            const div = document.getElementById("top-header");
            div.style.backgroundImage = "url('"+backimage+"')";
        }
    </script>
</body>

</html>