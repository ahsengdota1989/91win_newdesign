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
            @include('layouts.sidebar.left-sidebar-fourdee')

            <!-- content area -->
            <div class="col py-3 content-purple-bg">

                <!-- top header-->
                <div class="example-div" id="top-header">
                    <div class="row top-header">
                        <div class="col-4">
                            <span class="page-title">4D</span>
                        </div>

                        @include('layouts.searchbar')
                    </div>

                </div>

                <div class="row video-section" style="padding-top:5%;padding-bottom:20px">

                    <div class="col-md-12">
                        <button class="btn btn-primary border-0" style="background-color:#4d1460;width:150px" onclick="showbetnow()">Bet Now</button>
                        <button class="btn btn-primary border-0" style="background-color:#4d1460;width:150px" onclick="showpayout()">Payout Table</button>
                    </div>

                    <!--<div class="col-md-12">-->
                    <!--    <div id="results-content">results here</div>-->
                    <!--</div>-->

                </div>
                
                <div class="row video-section" style="padding:30px;background-color:#17011f;display:block" id="bet-div">
                    
                    <div class="col-md-12 d-flex justify-content-center">
                        <hr>
                        
                        <div class="row">
                            <img src="public/images/games/fourdee-graphic.png" class="img-fluid" style="padding-bottom:15px">
                            <button style="background-image: linear-gradient(to right, #ff6a00, #ee0979);color: #fff;border-radius: 15px;height:50px" onclick="window.location.href = '/launch4D';">Play Now</button>
                        </div>
                         
                    </div>
                    
                </div>
                
                <div class="row video-section" style="padding:30px;background-color:#17011f;display:none" id="payout-div">
                    
                    <div class="col-md-6">
                        <hr>
                        
                        <div class="row">
                            <h4 style="color:white">Prize money for Big Forecast</h4>
                            <center>
                            <img style="width:45px" src="public/images/magnum.png" alt="4d online betting">
                            <img style="width:45px" src="public/images/damacai.png" alt="4d online betting">
                            <img style="width:45px" src="public/images/toto.png" alt="4d online betting">
                            <img style="width:45px" src="public/images/singapore.png" alt="4d online betting">
                            <img style="width:45px" src="public/images/88.png" alt="4d online betting">
                            <img style="width:45px" src="public/images/stc.png" alt="4d online betting">
                            <img style="width:45px" src="public/images/cash.png" alt="4d online betting">
                            </center>
                            
                            <br>
        
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td align="center" style="color:#FFFFFF">BIG FORECAST</td>
                                        <td align="center" style="color:#FFFFFF">PRIZE AMOUNT</td>
                                    </tr>
                                    <tr>
                                        <td align="center" bgcolor="#FFFFFF">1st Prize</td>
                                        <td align="center" bgcolor="#FFFFFF">MYR 3,500.00</td>
                                    </tr>
                                    <tr>
                                        <td align="center" bgcolor="#FFFFFF">2nd Prize</td>
                                        <td align="center" bgcolor="#FFFFFF">MYR 1,200.00</td>
                                    </tr>
                                    <tr>
                                        <td align="center" bgcolor="#FFFFFF">3rd Prize</td>
                                        <td align="center" bgcolor="#FFFFFF">MYR 600.00</td>
                                    </tr>
                                    <t>
                                        <td align="center" bgcolor="#FFFFFF">SPECIAL</td>
                                        <td align="center" bgcolor="#FFFFFF">MYR 250.00</td>
                                    </tr>
                                    <tr>
                                        <td align="center" bgcolor="#FFFFFF">CONSOLATION</td>
                                        <td align="center" bgcolor="#FFFFFF">MYR 80.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <h4 style="color:white">Prize money for Small Forecast</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td align="center" style="color:#FFFFFF">SMALL FORECAST</td>
                                        <td align="center" style="color:#FFFFFF">PRIZE AMOUNT</td>
                                    </tr>
                                    <tr>
                                        <td align="center" bgcolor="#FFFFFF">1st Prize</td>
                                        <td align="center" bgcolor="#FFFFFF">MYR 5,000.00</td>
                                    </tr>
                                    <tr>
                                        <td align="center" bgcolor="#FFFFFF">2nd Prize</td>
                                        <td align="center" bgcolor="#FFFFFF">MYR 2,400.00</td>
                                    </tr>
                                    <tr>
                                        <td align="center" bgcolor="#FFFFFF">3rd Prize</td>
                                        <td align="center" bgcolor="#FFFFFF">MYR 1,200.00</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                         
                    </div>
                    
                    <div class="col-md-6">
                                                        
                        <h4 style="color:white">Prize money for Big Forecast (GD Lotto)</h4>
                        <center>
                        <img style="width:45px" src="public/images/gdlotto.png" alt="4d online betting">
                        <img style="width:45px" src="https://9lotto.com/favicon.png">
                        </center>
                        
                        <br>
    
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td align="center" style="color:#FFFFFF">BIG FORECAST</td>
                                    <td align="center" style="color:#FFFFFF">PRIZE AMOUNT</td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#FFFFFF">1st Prize</td>
                                    <td align="center" bgcolor="#FFFFFF">MYR 2,625.00</td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#FFFFFF">2nd Prize</td>
                                    <td align="center" bgcolor="#FFFFFF">MYR 1,050.00</td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#FFFFFF">3rd Prize</td>
                                    <td align="center" bgcolor="#FFFFFF">MYR 525.00</td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#FFFFFF">SPECIAL</td>
                                    <td align="center" bgcolor="#FFFFFF">MYR 210.00</td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#FFFFFF">CONSOLATION</td>
                                    <td align="center" bgcolor="#FFFFFF">MYR 63.00</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <h4 style="color:white">Prize money for Small Forecast (GD Lotto)</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td align="center" style="color:#FFFFFF">SMALL FORECAST</td>
                                    <td align="center" style="color:#FFFFFF">PRIZE AMOUNT</td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#FFFFFF">1st Prize</td>
                                    <td align="center" bgcolor="#FFFFFF">MYR 3,675.00</td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#FFFFFF">2nd Prize</td>
                                    <td align="center" bgcolor="#FFFFFF">MYR 2,100.00</td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#FFFFFF">3rd Prize</td>
                                    <td align="center" bgcolor="#FFFFFF">MYR 1,050.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>

            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')

    </div>
    
    <script type="text/javascript">
        function showbetnow() {
            $("#bet-div").show();
            $("#payout-div").hide();
        }
        
        function showpayout() {
            $("#bet-div").hide();
            $("#payout-div").show();
        }
    </script>

</body>

</html>