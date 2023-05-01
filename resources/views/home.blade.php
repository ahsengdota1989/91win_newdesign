<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>91Win | Online Casino Malaysia | Live Casino Malaysia</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">

            <!-- left sidebar -->
            @include('layouts.sidebar.left-sidebar-home')

            <!-- content area -->
            <div class="col py-3 content-purple-bg">

                <!-- top header-->
                <!-- dynamic name , get from controller-->
                <div class="row top-header">
                    <div class="col-4">
                        <span class="page-title">Home</span>
                    </div>

                    @include('layouts.searchbar')
                </div>

                <!-- slider -->
                <div class="row homepage-sliders">
                    <div class="col-12">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner" style="border-radius: 35px;">
                                <!-- <div class="carousel-item active">
                                    <img src="images/banners/banner_3.png" class="d-block w-100" alt="trusted-online-casino-malaysia">
                                </div> -->
                                <div class="carousel-item active">
                                    <img src="public/images/banners/banner_1.jpg" class="d-block w-100" alt="trusted-online-casino-malaysia">
                                </div>
                                <div class="carousel-item">
                                    <img src="public/images/banners/banner_2.jpg" class="d-block w-100" alt="trusted-online-casino-malaysia">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row video-section" style="padding-top:20px;padding-bottom:20px">

                    <span class="page-title" style="padding-bottom:20px">Popular Games</span>

                    <div class="col-2">
                        <div class="image-container">
                            <img src="images/games/lc-evo-icon.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="image-container">
                            <img src="images/games/lc-ag-icon.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="image-container">
                            <img src="images/games/lc-ab-icon.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="image-container">
                            <img src="images/games/lc-pt-icon.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="image-container">
                            <img src="images/games/lc-pp-icon.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="image-container">
                            <img src="images/games/lc-sexy-icon.png" class="img-fluid" alt="">
                            <div class="overlay">
                                <a href="#" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row video-section">

                    <div class="col-8" style="background-color: #17011f;border-radius:35px">
                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/fOCncfbsruI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>

                    <div class="col-4 jackpot-section" style="background-color: #17011f;border-radius:35px">
                        <div class="row">
                            <center><img src="public/images/total-jackpot.png" class="img-fluid"></center>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')

    </div>
</body>

</html>