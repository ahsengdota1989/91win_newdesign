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
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>


    <!-- datatable-->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
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

        .btn-newly-created {
            background-color: #17011F;
            width: 180px;
            font-size: 20px;
            cursor: pointer;
            border-color: #0d6efd;
        }

        .payment-input {
            background-color: transparent;
            color: white;
            border: 1px solid;
            border-image: linear-gradient(to right, #8447E9, #A547B4, #E94747);
            border-image-slice: 1;
        }

        .dataTables_filter {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">

            <!-- left sidebar -->
            @include('layouts.sidebar.left-sidebar-payment')

            <!-- content area -->
            <div class="col py-3 content-purple-bg">

                <!-- top header-->
                <div class="example-div" id="top-header">
                    <div class="row top-header">
                        <div class="col-4">
                            <span class="page-title">Referral</span>
                        </div>

                        @include('layouts.searchbar')
                    </div>

                </div>

                <div class="row video-section" style="padding-top:5%;padding-bottom:20px">

                    <div class="col-md-12">
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="window.location.href = '/payments';">Wallet <img src="public/images/payment/wallet-icon-active.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="window.location.href = '/deposit';">Deposit <img src="public/images/payment/deposit-icon.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="window.location.href = '/withdraw';">Withdraw <img src="public/images/payment/withdraw-icon.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="window.location.href = '/history';">History <img src="public/images/payment/history-icon.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="window.location.href = '/referral';">Referral <img src="public/images/payment/referral-icon.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                    </div>

                </div>
                
                <div class="row video-section" style="padding:30px;background-color:#17011f">
                    
                    <div class="col-md-4 ps-4" style="background-color:#17011f;padding:10px">

                        <div class="row">
                            <div class="col-sm-12 mb-4" style="background-color:#1d0824;height:100px;padding-top:12px;border-radius: 15px;">
                                <h3 style="color:white;font-size:15px">Total Referrals</h3>
                                <span style="color:white">Joined Members : {{$totalReferral}}</span>
                                <br>
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-md-6 ps-4" style="background-color:#17011f;padding:10px">

                        <div class="row">
                            <div class="col-sm-12 mb-4" style="background-color:#1d0824;padding-top:12px;height:100px;border-radius: 15px;">
                                
                                <div class="input-group group">
                                    <input type="text" class="form-control payment-input" value="https://91win88.com/register?ref={{Auth::User()->user_name}}" style="background-color:initial" readonly>
                                    <button class="btn btn-primary" type="button" style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;border:0">Copy Referral Link</button>
                                </div>
                                <br>
                                
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row video-section" style="background-color:#1d0824;padding-top:12px;border-radius: 15px;">

                    <div class="col-md-12">

                        <table id="example" class="table" style="color:white">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date Joined</th>
                                    <th>Fullname</th>
                                    <th>Username</th>
                                    <th>Phone Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($refArray as $key => $reff)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$reff['created_at']}}</td>
                                    <td>{{$reff['name']}}</td>
                                    <td>{{$reff['user_name']}}</td>
                                    <td>{{$reff['phone_number']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Date Joined</th>
                                    <th>Fullname</th>
                                    <th>Username</th>
                                    <th>Phone Number</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')

    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

</body>

</html>