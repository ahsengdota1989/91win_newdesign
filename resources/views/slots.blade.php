<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>91Win | Online Casino Malaysia | Best Slots in Malaysia</title>
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
        
        .sports-iframe {
          width: 100%;
          height: 100vh;
          overflow: auto;
        }

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">

            <!-- left sidebar -->
            @include('layouts.sidebar.left-sidebar-slots')

            <!-- content area -->
            <div class="col py-3 content-purple-bg">

                <!-- top header-->
                <div class="example-div" id="top-header">
                    <div class="row top-header">
                        <div class="col-4">
                            <span class="page-title">Slots</span>
                        </div>

                        @include('layouts.searchbar')
                    </div>

                </div>

                <div class="row video-section" style="padding-top:5%;">

                    <div class="col-md-12">
                        <button class="btn btn-primary border-0" style="background-color:#4d1460;width:150px" onclick="changegame('jokerLobby')">Joker</button>
                        <button class="btn btn-primary border-0" style="background-color:#4d1460;width:150px;" onclick="changegame('microLobby')">Microgaming</button>
                        <button class="btn btn-primary border-0" style="background-color:#4d1460;width:150px" onclick="changegame('mg/sessionlivecasino')">Pussy888</button>
                        <button class="btn btn-primary border-0" style="background-color:#4d1460;width:150px" onclick="changegame('mg/sessionlivecasino')">Mega888</button>
                        <button class="btn btn-primary border-0" style="background-color:#4d1460;width:150px" onclick="changegame('mg/sessionlivecasino')">918Kiss</button>
                        <button class="btn btn-primary border-0" style="background-color:#4d1460;width:150px" onclick="changegame('pragmaticLobby')">Pragmatic</button>
                    </div>

                    <div class="col-md-12" style="padding-top:10px">
                        <button class="btn btn-primary border-0" style="background-color:#4d1460;width:150px" onclick="changegame('ptslots')">Playtech</button>
                        <button class="btn btn-primary border-0" style="background-color:#4d1460;width:150px" onclick="changegame('spadeGamingLobby')">Spadegaming</button>
                        <button class="btn btn-primary border-0" style="background-color:#4d1460;width:150px" onclick='window.open("{{url('/ag/launchSlotgame')}}", "asiagaming")'>Asia Gaming</button>
                    </div>

                </div>
                
                <div class="row video-section" style="padding:30px;background-color:#17011f;">
                    
                    <div class="col-md-12">
                        <hr>
                        <div id="slots-div"></div>
                    </div>
                    
                </div>

            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')

    </div>

    <script type="text/javascript">
        changegame('jokerLobby');
        
        function changegame(slotsgames) {
            $.ajax({
                type: "get",
                url: "/"+slotsgames,
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    // $("#loader-image").show();
                },
                success: function(data)
                {
                    $("#slots-div").html(data);
                }
            });
        }
    </script>
</body>

</html>