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
                            <span class="page-title">Withdraw</span>
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

                        <!--<div class="row gx-4" style="background-color:#1d0824;height:120px;padding-top:12px;border-radius: 15px;">-->
                        <!--    <div class="col-6 ps-4">-->
                        <!--        <h3 style="color:white;font-size:15px">Withdraw Limit</h3>-->
                        <!--        <br>-->
                        <!--        Per Day : <br>-->
                        <!--        <span style="color:white">MYR 120.00</span>-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <div class="row gx-4" style="background-color:#1d0824;padding-top:12px;border-radius: 15px;">
                            <div class="col-12 ps-4">
                                <h3 style="color:white;font-size:15px">Add New Bank</h3>
                                
                                <div class="group">
                                    <label for="email" class="form-label" style="color:white">Bank *</label>
                                    <select class="form-control" id="new-bank-name">
                                        <option value="Maybank">Maybank</option>
                                        <option value="Public Bank Berhad">Public Bank Berhad</option>
                                        <option value="Hong Leong Bank">Hong Leong Bank</option>
                                        <option value="CIMB Bank">CIMB Bank</option>
                                        <option value="RHB Bank">RHB Bank</option>
                                        <option value="Affin Bank Berhad">Affin Bank Berhad</option>
                                        <option value="Alliance Bank Malaysia Berhad">Alliance Bank Malaysia Berhad</option>
                                        <option value="Bank Simpanan Nasional">Bank Simpanan Nasional</option>
                                        <option value="HSBC Malaysia">HSBC Malaysia</option>
                                        <option value="AmBank">AmBank</option>
                                        <option value="United Overseas Bank">United Overseas Bank</option>
                                        <option value="Bank Islam Malaysia">Bank Islam Malaysia</option>
                                        <option value="Agrobank">Agrobank</option>
                                        <option value="Bank Rakyat">Bank Rakyat</option>
                                        <option value="OCBC Bank">OCBC Bank</option>
                                        <option value="Citibank">Citibank</option>
                                        <option value="Bank of China (Malaysia)">Bank of China (Malaysia)</option>
                                    </select>
                                </div>
                                
                                <div class="group">
                                    <label for="email" class="form-label" style="color:white">Account Number *</label>
                                    <input type="number" id="new-bank-accNo" class="form-control"/>
                                </div>
                                
                                <div class="group">
                                    <br>
                                    <button type="button" 
                                            class="btn btn-primary w-100" 
                                            style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;" 
                                            onclick="addNewBank()" 
                                            id="add-new-bank-button">Save</button>
                                    <br>
                                    <br>
                                </div>

                            </div>
                        </div>
 
                    </div>

                    <!-- balance sections -->
                    <!-- ajax -->
                    <div class="col-md-5 ps-4" style="background-color:#17011f;padding:10px">
                        <div class="row" style="padding-top:12px">
                            
                            <div class="col-md-12" style="padding-top:10px">
                                <div class="group">
                                    <label for="inputName" class="form-label" style="color:white">Bank</label>
                                    <select class="form-control" id="with-bank">
                                        <!--<option value="0">{{ __('fund.selectbank') }}</option>-->
                                        @foreach($userBankArray as $userBnk)
                                        <option value="{{$userBnk['bank_name']}} - {{$userBnk['account_number']}}">{{$userBnk['bank_name']}} - {{$userBnk['account_number']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="group">
                                    <label for="inputName" class="form-label" style="color:white">Amount</label>
                                    <input type="text" class="form-control payment-input">
                                </div>
                                <div class="group">
                                    <br>
                                    <button class="btn btn-primary w-100" 
                                            style="background-image: linear-gradient(to right, #C147E9, #E94747);color: #fff;" onclick="withdrawal();" id="withdrawal-button">Submit <span style="display:none;" id="loader-image2">Loading...</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row video-section" style="padding-top:5%;">

                    <div class="col-md-12">
                        <div class="notice-box" bis_skin_checked="1">
                            <span class="item-title" style="color:white">IMPORTANT NOTICE</span>
                            <ul>
                                <li>
                                    <p style="color:white">Withdrawal bank name must match to registered full name. Member unable to withdrawal to 3rd party bank
                                        account.</p>
                                </li>
                                <li>
                                    <p style="color:white">Please make sure already achieve the 1x turnover of deposit amount before submit the withdrawal
                                        transaction.</p>
                                </li>
                                <li>
                                    <p style="color:white">Please make sure the bank account name &amp; bank account number is correct before submitted the
                                        withdrawal transaction.</p>
                                </li>
                                <li>
                                    <p style="color:white">Some game provider requires up to 30 minutes of report sync time, kindly submit the withdrawal
                                        transaction after that, to avoid system auto reject.</p>
                                </li>
                            </ul>
                            <div class="display-info" bis_skin_checked="1" style="color:white">Once you have successfully submitted your withdrawal transaction, just leave it to our
                                team to process your transactions as speedy as possible. If more than 10 minutes, let us know by contacting our
                                Customer Service support. They will assist you 24/7 anytime.</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')
        
        @include('layouts.modals')

    </div>
    
    
    <script type="text/javascript">

        function addNewBank() {
            document.getElementById("add-new-bank-button").disabled = true;
            $.ajax({
                type: "post",
                url: "{{url('addNewBank')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:
                {
                    bank_name : $("#new-bank-name").val(),
                    account_number : $("#new-bank-accNo").val(),
                },
                beforeSend: function()
                {
                    //$("#loader-image2").show();
                },
                success: function(data)
                {
                    result = JSON.parse(data);
                    status = result['status'];

                    if(status == 0)
                    {
                        $("#success-text").html(result['message']);
                        $('#successModal').fadeIn();
                        location.reload();
                        return false;
                    }
                    else
                    {
                        $("#error-text").html(result['message']);
                        $('#errorModal').fadeIn();
                        document.getElementById("add-new-bank-button").disabled = false;
                    }
                }
            });
        }

        function withdrawal() {
            document.getElementById("withdrawal-button").disabled = true;
            $.ajax({
                type: "post",
                url: "{{url('withdrawalProcess')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:
                {
                    with_bank : $("#with-bank").val(),
                    with_amount : $("#with-amount").val(),
                },
                beforeSend: function()
                {
                    $("#loader-image2").show();
                },
                success: function(data)
                {
                    result = JSON.parse(data);
                    status = result['status'];

                    if(status == 0)
                    {
                        $("#success-text").html(result['message']);
                        $('#successModal').fadeIn();
                        $("#loader-image2").hide();
                        window.location.replace('{{url('historypage')}}');
                        //location.reload();
                        return false;
                    }
                    else
                    {
                        $("#error-text").html(result['message']);
                        $('#errorModal').fadeIn();
                        $("#loader-image2").hide();
                        document.getElementById("withdrawal-button").disabled = false;
                    }
                }
            });
        }
    </script>

</body>

</html>