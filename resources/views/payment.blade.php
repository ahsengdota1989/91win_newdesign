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
        
        .modal {
            --mdb-modal-top-left-top: 10px;
            --mdb-modal-top-left-left: 10px;
            --mdb-modal-top-right-top: 10px;
            --mdb-modal-top-right-right: 10px;
            --mdb-modal-bottom-left-bottom: 10px;
            --mdb-modal-bottom-left-left: 10px;
            --mdb-modal-bottom-right-bottom: 10px;
            --mdb-modal-bottom-right-right: 10px;
            --mdb-modal-fade-top-transform: translate3d(0,-25%,0);
            --mdb-modal-fade-right-transform: translate3d(25%,0,0);
            --mdb-modal-fade-bottom-transform: translate3d(0,25%,0);
            --mdb-modal-fade-left-transform: translate3d(-25%,0,0);
            --mdb-modal-side-right: 10px;
            --mdb-modal-side-bottom: 10px;
            --mdb-modal-non-invasive-box-shadow: 0 2px 6px -1px rgba(0,0,0,0.07),0 6px 18px -1px rgba(0,0,0,0.04);
            --mdb-modal-non-invasive-box-shadow-top: 0 -10px 20px 0 rgba(0,0,0,0.05);
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
                            <span class="page-title">Payment</span>
                        </div>

                        @include('layouts.searchbar')
                    </div>

                </div>

                <div class="row video-section" style="padding-top:5%;">

                    <div class="col-md-12">
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="window.location.href = '/payments';">Wallet <img src="public/images/payment/wallet-icon-active.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="window.location.href = '/deposit';">Deposit <img src="public/images/payment/deposit-icon.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="window.location.href = '/withdraw';">Withdraw <img src="public/images/payment/withdraw-icon.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="window.location.href = '/history';">History <img src="public/images/payment/history-icon.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="window.location.href = '/referral';">Referral <img src="public/images/payment/referral-icon.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                    </div>

                </div>

                <div class="row video-section" style="padding-top:5%;">

                    <div class="col-md-4 ps-4" style="background-color:#17011f;padding:10px">

                        <div class="row">
                            <div class="col-sm-6 mb-4" style="background-color:#1d0824;height:100px;padding-top:12px;border-radius: 15px;">
                                <h3 style="color:white;font-size:15px">Main Wallet</h3>
                                <span style="color:white">Balance :</span><br>
                                <span style="color:white">MYR {{$mainBalance}}</span>
                            </div>
                            <div class="col-sm-6 mb-4" style="background-color:#1d0824;height:100px;padding-top:12px;border-radius: 15px;">
                                <h3 style="color:white;font-size:15px">Reward Wallet</h3>
                                <span style="color:white">Balance :</span><br>
                                <span style="color:white">MYR {{$rewardBalance}}</span>
                            </div>
                        </div>

                        <div class="row gx-4" style="background-color:#1d0824;height:120px;padding-top:12px;border-radius: 15px;">
                            <div class="col-6 ps-4">
                                <h3 style="color:white;font-size:15px">Withdraw Limit</h3>
                                <br>
                                Per Day : <br>
                                <span style="color:white">MYR 120.00</span>
                            </div>
                        </div>

                        <div class="row" style="padding-top:12px">
                            <div class="col-md-6">
                                <div class="group">
                                    <label for="inputName" class="form-label" style="color:white;">Transfer From</label>
                                    <select class="form-control payment-input" id="game-transfer-from">
                                        <option value="1">Main Wallet</option>
                                        <option value="99">Reward Wallet</option>
                                        <option value="5">Evolution Casino</option>
                                        <option value="8">Playtech Live & Slots</option>
                                        <option value="6">Joker</option>
                                        <option value="10">4D</option>
                                        <option value="7">Mega888</option>
                                        <option value="4">Sexy Casino</option>
                                        <option value="11">Asia Gaming</option>
                                        <option value="12">Pussy888</option>
                                        <option value="13">918Kiss</option>
                                        <option value="9">Pragmatic</option>
                                        <option value="14">Allbet</option>
                                        <option value="2">M8 Sports</option> <!-- seamless-->
                                        <option value="3">Spade Gaming</option>
                                        <option value="16">Micro Gaming</option>
                                        <option value="17">IBC Maxbet</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group">
                                    <label for="inputName" class="form-label" style="color:white">Transfer To</label>
                                    <select class="form-control payment-input" id="game-transfer-to">
                                        <option style="display:none">Select</option>
                                        <option value="1">Main Wallet</option>
                                        <option value="5">Evolution Casino</option>
                                        <option value="8">Playtech Live & Slots</option>
                                        <option value="6">Joker</option>
                                        <option value="10">4D</option>
                                        <option value="7">Mega888</option>
                                        <option value="4">Sexy Casino</option>
                                        <option value="11">Asia Gaming</option>
                                        <option value="12">Pussy888</option>
                                        <option value="13">918Kiss</option>
                                        <option value="9">Pragmatic</option>
                                        <option value="14">Allbet</option>
                                        <option value="2">M8 Sports</option> <!-- seamless-->
                                        <option value="3">Spade Gaming</option>
                                        <option value="16">Micro Gaming</option>
                                        <option value="17">Maxbet</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12" style="padding-top:10px">
                                <div class="group">
                                    <label for="inputName" class="form-label" style="color:white">Promotion</label>
                                    <select class="form-control" id="dep-promo">
                                        <option value="0">No Bonus</option>
                                        @foreach ($promoArr as $promo)
                                            <option value="{{ $promo['id'] }}">
                                                {{ $promo['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="group">
                                    <label for="inputName" class="form-label" style="color:white">Amount</label>
                                    <input type="number" id="dep-pg-amount" class="form-control payment-input">
                                </div>
                                <div class="group">
                                    <br>
                                    <button class="btn btn-primary w-100" 
                                            style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;"
                                            id="transfer-game-button" 
                                            onclick="transferGame()">Submit <span style="display:none;" id="transfer-loader">Loading...</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- balance sections -->
                    <!-- ajax -->
                    <div class="col-md-4 ps-4" style="background-color:#17011f;padding:10px">
                        <h4 style="color:purple;padding-bottom:10px">Sports</h4>

                        <table width="100%">
                            <tr>
                                <td style="color:whitesmoke">M8Sports</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="m8Sports2-balance">Loading...</span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">IBC Maxbet</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="ibc-balance-div"></span></td>
                            </tr>
                        </table>

                        <h4 style="color:purple;padding-bottom:10px;padding-top:10px">Casino / Slots / Fishing</h4>

                        <table width="100%">
                            <tr>
                                <td style="color:whitesmoke">Pragmatic</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="pragmatic-balance"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">Playtech</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="playtech-balance-div"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">Asia Gaming</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="ag-balance-div"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">Sexy Baccarat</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="sexy-balance-div"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">Evolution Casino</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="evo-balance-div"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">Spade Gaming</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="spadegaming-balance"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">Joker</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="joker-balance-div"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">918Kiss</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="918-balance"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">Pussy888</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="pussy-balance"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">Mega888</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="mega-balance-div"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">Microgaming</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="micro-balance"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">Allbet</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="allbet2-balance"></span></td>
                            </tr>
                            <tr>
                                <td style="color:whitesmoke">4D</td>
                                <td style="color:whitesmoke;text-align:right;padding-right:10px"><span id="fourdee-balance-div"></span></td>
                            </tr>
                        </table>
                    </div>

                </div>

            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')
        
        @include('layouts.modals')

    </div>
    

</body>

</html>