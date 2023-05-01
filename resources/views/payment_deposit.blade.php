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
                            <span class="page-title">Deposit</span>
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

                    <div class="col-md-12">
                        <!--<div class="d-flex justify-content-center">-->
                        <!--<img src="public/images/payment/wallet-icon-active.png" style="padding-left: 14px;padding-bottom: 10px;">-->
                            <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="showfpx()">FPX </button>
                            <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="showlocalbank()">Local Bank </button>
                            <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="showewallet()">E-Wallet </button>
                            <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="showtelco()">Telco </button>
                            <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" onclick="showcrypto()">Crypto </button>
                        <!--</div>-->
                    </div>
                    
                    <div class="col-md-4" style="padding-left:20px;padding-right:20px;background-color:##1d0824;display:block" id="div-fpx">
                        <br><br><br>

                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" style="width:140px !important;font-size:13px !important;" onclick="showfpxfpay()">F-Pay <img src="public/images/fpay-logo.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" style="width:140px !important;font-size:13px !important;" onclick="showsurepay()">Surepay <img src="public/images/surepay-logo.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        
                        <div id="pg-fpay-div" style="display:block">
                            <div class="group" style="padding-top:10px">
                                <label for="inputName" class="form-label" style="color:white">Fpay Amount</label>
                                <input type="number" id="dep-fpay-amount" class="form-control payment-input">
                            </div>
                            <div class="group">
                                <br>
                                <button class="btn btn-primary w-100" 
                                        style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;" 
                                        id="deposit-fpay-button" 
                                        onclick="submitFPAY()">Submit <span style="display:none;" id="loader-image-fpay">Loading...</span>
                                </button>
                            </div>
                        </div>
                        
                        <div id="pg-surepay-div" style="display:none">
                            <form method="get" action="/testsurepay" id="submit-surepay">
                                <div class="group" style="padding-top:10px">
                                    <label for="inputName" class="form-label" style="color:white">Surepay Amount</label>
                                    <input type="number" id="dep-pg-amount" name="amount" class="form-control payment-input">
                                </div>
                            </form>
                            <div class="group">
                                <br>
                                <button class="btn btn-primary w-100" 
                                        style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;" 
                                        id="deposit-pg-button" 
                                        onclick="submitPG()">Submit <span style="display:none;" id="loader-image-pg">Loading...</span>
                                </button>
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-md-4" style="padding-left:20px;padding-right:20px;background-color:##1d0824;display:none" id="div-localbank">
                        <br><br><br>

                        <form method="post" id="upload_form" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="group">
                            <label for="email" class="form-label" style="color:white">Bank</label>
                            <select class="form-control" name="dep_bank" id="bank-selected">
                                @foreach($banksArray as $b)
                                <option value="{{ $b['id'] }}">{{ $b['bank_name'] }} ({{ $b['account_holder_name'] }} - {{ $b['account_number'] }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="group" style="padding-top:10px">
                            <label for="inputName" class="form-label" style="color:white">Amount</label>
                            <input type="number" id="dep-amount" name="dep_amount" class="form-control payment-input">
                        </div>
                        
                        <div class="group" style="padding-top:10px">
                            <label for="inputName" class="form-label" style="color:white">Upload Receipt</label>
                            <input type="file" id="dep-receipt" name="dep_receipt" class="form-control payment-input">
                            <span style="color:red">*png/jpeg/jpg only</span>
                        </div>
                        
                        <div class="group">
                            <br>
                            <button class="btn btn-primary w-100" 
                                    style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;" 
                                    id="deposit-button">Submit <span style="display:none;" id="submit-loader-image">Loading...</span>
                            </button>
                        </div>

                    </form>
                        
                        
                        
                    </div>
                    
                    <div class="col-md-6" style="padding-left:20px;padding-right:20px;background-color:##1d0824;display:none" id="div-ewallet">
                        <br><br><br>

                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" style="width:140px !important;font-size:13px !important;" onclick="showtngnew()">TNG <img src="public/images/surepay-logo.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" style="width:140px !important;font-size:10px !important;" onclick="showduitnownew()">DuitNow <img src="public/images/fpay-logo.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        <button class="btn btn-primary btn-newly-created bg-gradient border-0 border-gradient-primary text-white" style="width:140px !important;font-size:13px !important;" onclick="showewalletnew()">E-Wallet <img src="public/images/fpay-logo.png" style="padding-left: 14px;padding-bottom: 10px;"></button>
                        
                        <div id="show-tng-new">
                            <form method="get" action="/tng" id="submit-tng">
                                
                                <div class="group" style="padding-top:10px">
                                    <label for="inputName" class="form-label" style="color:white">TNG Amount</label>
                                    <input type="number" id="dep-tng-amount" name="amount" class="form-control payment-input">
                                </div>
                                
                            </form>

                            <div class="group">
                                <br>
                                <button class="btn btn-primary w-100" 
                                        style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;" 
                                        id="deposit-tng-button" 
                                        onclick="submitTNG()">Submit <span style="display:none;" id="loader-image-tng">Loading...</span>
                                </button>
                            </div>
                        </div>
                            
                        <div id="show-duitnow-new" style="display:none">
                            
                            
                            <form method="get" action="/duitnow" id="submit-fpayduitnow">
                                
                                <div class="group" style="padding-top:10px">
                                    <label for="inputName" class="form-label" style="color:white">DuitNow Amount</label>
                                    <input type="number" id="dep-fpayduitnow-amount" name="amount" class="form-control payment-input">
                                </div>
                                
                            </form>

                            <div class="group">
                                <br>
                                <button class="btn btn-primary w-100" 
                                        style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;" 
                                        id="deposit-fpayduitnow-button" 
                                        onclick="submitFpayDuitNow()">Submit <span style="display:none;" id="loader-image-fpayduitnow">Loading...</span>
                                </button>
                            </div>


                        </div>
                            
                        <div id="show-ewallet-new" style="display:none">
                            
                            <div class="group" style="padding-top:10px">
                                <label for="inputName" class="form-label" style="color:white">E-Wallet Amount</label>
                                <input type="number" id="dep-fpayewallet-amount" name="amount" class="form-control payment-input">
                            </div>

                            <div class="group">
                                <br>
                                <button class="btn btn-primary w-100" 
                                        style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;" 
                                        id="deposit-fpayewallet-button" 
                                        onclick="submitFpayEwallet()">Submit <span style="display:none;" id="loader-image-fpayewallet">Loading...</span>
                                </button>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="col-md-4" style="padding-left:20px;padding-right:20px;background-color:##1d0824;display:none" id="div-telco">
                        <br><br><br>
                        
                        <div class="group">
                            <label for="email" class="form-label" style="color:white">Telco Provider</label>
                            <select class="form-control" id="dep-telco-provider">
                                <option value="DIGI">DIGI</option>
                                <option value="HOTLINK">HOTLINK</option>
                                <option value="CELCOM">CELCOM</option>
                                <option value="UMOBILE">UMOBILE</option>
                            </select>
                        </div>
                        
                        <div class="group" style="padding-top:10px">
                            <label for="inputName" class="form-label" style="color:white">Telco Pin Number</label>
                            <input type="number" id="dep-telco-pin_number" class="form-control payment-input">
                            <span style="color:red">*25% amount will be deducted from withdraw</span>
                        </div>
                        
                        <div class="group">
                            <br>
                            <button class="btn btn-primary w-100" 
                                    style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;" 
                                    id="deposit-telco-button" 
                                    onclick="submitTelco()">Submit <span style="display:none;" id="loader-image-telco">Loading...</span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="col-md-4" style="padding-left:20px;padding-right:20px;background-color:##1d0824;display:none" id="div-crypto">
                        <br><br><br>
                        <div class="group" style="padding-top:10px">
                            <label for="inputName" class="form-label" style="color:white">Amount</label>
                            <input type="number" id="dep-usdt-amount" class="form-control payment-input">
                            <span style="color:red">*USDT TRC 20</span>
                        </div>
                        <div class="group">
                            <br>
                            <button class="btn btn-primary w-100" 
                                    style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;" 
                                    id="deposit-usdt-button" 
                                    onclick="submitFpayUSDT()">Submit <span style="display:none;" id="loader-image-usdt">Loading...</span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')

    </div>
    
    <script type="text/javascript">
        function showfpx() {
            $("#div-fpx").show();
            $("#div-localbank").hide();
            $("#div-ewallet").hide();
            $("#div-telco").hide();
            $("#div-crypto").hide();
        }
        
        function showlocalbank() {
            $("#div-fpx").hide();
            $("#div-localbank").show();
            $("#div-ewallet").hide();
            $("#div-telco").hide();
            $("#div-crypto").hide();
        }
        
        function showewallet() {
            $("#div-fpx").hide();
            $("#div-localbank").hide();
            $("#div-ewallet").show();
            $("#div-telco").hide();
            $("#div-crypto").hide();
        }
        
        function showtelco() {
            $("#div-fpx").hide();
            $("#div-localbank").hide();
            $("#div-ewallet").hide();
            $("#div-telco").show();
            $("#div-crypto").hide();
        }
        
        function showcrypto() {
            $("#div-fpx").hide();
            $("#div-localbank").hide();
            $("#div-ewallet").hide();
            $("#div-telco").hide();
            $("#div-crypto").show();
        }
        
        function showewalletnew() {
            $("#show-tng-new").hide();
            $("#show-duitnow-new").hide();
            $("#show-ewallet-new").show();
            
        }
    
        function showtngnew() {
            $("#show-tng-new").show();
            $("#show-duitnow-new").hide();
            $("#show-ewallet-new").hide();
            $("#showCrypto").hide();
        }
        
        function showduitnownew() {
            $("#show-tng-new").hide();
            $("#show-duitnow-new").show();
            $("#show-ewallet-new").hide();
        }
        
        function showfpxfpay() {
            $("#pg-fpay-div").show();
            $("#pg-surepay-div").hide();
        }
        
        function showsurepay() {
            $("#pg-fpay-div").hide();
            $("#pg-surepay-div").show();
        }
        
        //local transfer
        $(document).ready(function () {

            $('#upload_form').on('submit', function (event) {
                document.getElementById("deposit-button").disabled = true;
                event.preventDefault();

                var formData = new FormData(this);
                // console.log($('#bank-selected').children("div.active").attr('id'));
                // var dep_bank = $('#bank-selected').children("div.active").attr('id');
                // formData.append("dep_bank", dep_bank);

                $.ajax({
                    type: "post",
                    url: "{{ url('depositProcess') }}",
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: formData,
                    beforeSend: function () {
                        $("#submit-loader-image").show();
                    },
                    success: function (data) {
                        console.log(data.message)
                        if (data.status == 0) {
                            alert(data.message);
                            $("#submit-loader-image").hide();
                            window.location.reload();
                            return false;
                        } else {
                            alert(data.message);
                            $("#submit-loader-image").hide();
                            document.getElementById("deposit-button").disabled = false;
                        }
                    }
                });
            });
        });
        
        //fpx payment 
        function submitFPAY() {
            document.getElementById("deposit-fpay-button").disabled = true;
            $.ajax({
                type: "post",
                url: "{{ url('submitFpay') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    amount: $("#dep-fpay-amount").val(),
                },
                beforeSend: function() {
                    $("#loader-image-fpay").show();
                },
                success: function(data) {
                    result = JSON.parse(data);
                    status = result['status'];
                   
                    if (status == 0) {
                        // alert(result['message']);
                        var p_url = result['url'];
                        window.location.replace(p_url);
                        
                    } else {
                        alert(result['message']);
                        $("#loader-image-fpay").hide();
                        document.getElementById("deposit-fpay-button").disabled = false;
                    }
                    
                }
            });
        }
        
        function submitPG() {
            document.getElementById("deposit-pg-button").disabled = true;
            $.ajax({
                type: "post",
                url: "{{ url('pgdeposit') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    amount: $("#dep-pg-amount").val(),
                    promo: $("#dep-pg-promo").val(),
                    bank_id: $("#dep-pg-bank").val(),
                },
                beforeSend: function () {
                    $("#loader-image-pg").show();
                },
                success: function (data) {
                    result = JSON.parse(data);
                    status = result['status'];

                    if (status == 0) {
                        document.getElementById("submit-surepay").submit();
                    } else {
                        alert(result['message']);
                        $("#loader-image-pg").hide();
                        document.getElementById("deposit-pg-button").disabled = false;
                    }

                }
            });
        }
        
        function submitFpayDuitNow() {
            document.getElementById("deposit-fpayduitnow-button").disabled = true;
            $.ajax({
                type: "post",
                url: "{{ url('pgdeposit') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    amount: $("#dep-fpayduitnow-amount").val(),
                    promo: $("#dep-fpayduitnow-promo").val(),
                    bank_id: $("#dep-fpayduitnow-bank").val(),
                },
                beforeSend: function () {
                    $("#fpayduitnow-loader").show();
                },
                success: function (data) {
                    result = JSON.parse(data);
                    status = result['status'];

                    if (status == 0) {
                        document.getElementById("submit-fpayduitnow").submit();
                    } else {
                        alert(result['message']);
                        $("#fpayduitnow-loader").hide();
                        document.getElementById("deposit-fpayduitnow-button").disabled = false;
                    }

                }
            });
        }
        
        function submitFpayUSDT() {
            document.getElementById("deposit-usdt-button").disabled = true;
            $.ajax({
                type: "post",
                url: "{{ url('submitFpayUSDT') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    amount: $("#dep-usdt-amount").val(),
                },
                beforeSend: function() {
                    $("#loader-image-usdt").show();
                },
                success: function(data) {
                    result = JSON.parse(data);
                    status = result['status'];
                   
                    if (status == 0) {
                        // alert(result['message']);
                        var p_url = result['url'];
                        window.location.replace(p_url);
                        
                    } else {
                        alert(result['message']);
                        $("#loader-image-usdt").hide();
                        document.getElementById("deposit-usdt-button").disabled = false;
                    }
                }
            });
        }
        
        function submitFpayEwallet() {
            document.getElementById("deposit-fpayewallet-button").disabled = true;
            $.ajax({
                type: "post",
                url: "{{ url('submitFpayEwallet') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    amount: $("#dep-fpayewallet-amount").val(),
                },
                beforeSend: function() {
                    $("#loader-image-fpayewallet").show();
                },
                success: function(data) {
                    result = JSON.parse(data);
                    status = result['status'];
                   
                    if (status == 0) {
                        // alert(result['message']);
                        var p_url = result['url'];
                        window.location.replace(p_url);
                        
                    } else {
                        alert(result['message']);
                        $("#loader-image-fpayewallet").hide();
                        document.getElementById("deposit-fpayewallet-button").disabled = false;
                    }
                }
            });
        }

        function submitTNG() {
            //alert('test');
            document.getElementById("deposit-tng-button").disabled = true;
            $.ajax({
                type: "post",
                url: "{{ url('pgdeposit') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    amount: $("#dep-tng-amount").val(),
                    promo: $("#dep-tng-promo").val(),
                    bank_id: $("#dep-tng-bank").val(),
                },
                beforeSend: function () {
                    $("#tng-loader").show();
                },
                success: function (data) {
                    result = JSON.parse(data);
                    status = result['status'];

                    if (status == 0) {
                        document.getElementById("submit-tng").submit();
                    } else {
                        alert(result['message']);
                        $("#tng-loader").hide();
                        document.getElementById("deposit-tng-button").disabled = false;
                    }

                }
            });
        }
        
        function submitTelco() {
            document.getElementById("deposit-telco-button").disabled = true;
            $.ajax({
                type: "post",
                url: "{{ url('telcoDeposit') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    amount: $("#dep-telco-amount").val(),
                    pin_number: $("#dep-telco-pin_number").val(),
                    provider: $("#dep-telco-provider").val(),
                },
                beforeSend: function() {
                    $("#loader-image-telco").show();
                },
                success: function(data) {
                    result = JSON.parse(data);
                    status = result['Code'];
                    console.log(data);
                   
                    if (status == '00000') {
                        alert(result['Message']);
                        location.reload();
                        // var p_url = result['url'];
                        // window.location.replace(p_url);
                        
                    } else {
                        alert(result['Message']);
                        $("#loader-image-telco").hide();
                        document.getElementById("deposit-telco-button").disabled = false;
                    }
                    
                }
            });
        }
        
    </script>

</body>

</html>