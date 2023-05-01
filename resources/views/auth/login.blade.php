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
        .video-section {
            padding-left: 30px;
            padding-right: 30px;
        }

        .btn-outline-light:hover {
            background-color: purple;
            color: white;
        }

        .btn-outline-light {
            border-color: purple;
            color: white;
        }

        .btn-outline-light:hover {
            background-color: purple;
            color: white;
            border-color: purple;
        }

        .login-box {
            width: 100%;
            margin: auto;
            max-width: 525px;
            min-height: 670px;
            position: relative;
            background: url(https://images.unsplash.com/photo-1507208773393-40d9fc670acf?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1268&q=80) no-repeat center;
            box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19);
        }

        .login-snip {
            width: 100%;
            height: 100%;
            position: absolute;
            padding: 90px 70px 50px 70px;
            background: #17011f;
        }

        .login-snip .login,
        .login-snip .sign-up-form {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            position: absolute;
            transform: rotateY(180deg);
            backface-visibility: hidden;
            transition: all .4s linear;
        }

        .login-snip .sign-in,
        .login-snip .sign-up,
        .login-space .group .check {
            display: none;
        }

        .login-snip .tab,
        .login-space .group .label,
        .login-space .group .button {
            text-transform: uppercase;
        }

        .login-snip .tab {
            font-size: 22px;
            margin-right: 15px;
            padding-bottom: 5px;
            margin: 0 15px 10px 0;
            display: inline-block;
            border-bottom: 2px solid transparent;
        }

        .login-snip .sign-in:checked+.tab,
        .login-snip .sign-up:checked+.tab {
            color: #fff;
            border-color: #1161ee;
        }

        .login-space {
            min-height: 345px;
            position: relative;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        .login-space .group {
            margin-bottom: 15px;
        }

        .login-space .group .label,
        .login-space .group .input,
        .login-space .group .button {
            width: 100%;
            color: #fff;
            display: block;
        }

        .login-space .group .input,
        .login-space .group .button {
            border: none;
            padding: 15px 20px;
            border-radius: 25px;
            background: rgba(255, 255, 255, .1);
        }

        .login-space .group input[data-type="password"] {
            text-security: circle;
            -webkit-text-security: circle;
        }

        .login-space .group .label {
            color: #aaa;
            font-size: 12px;
        }

        .login-space .group .button {
            background: #1161ee;
        }

        .login-space .group label .icon {
            width: 15px;
            height: 15px;
            border-radius: 2px;
            position: relative;
            display: inline-block;
            background: rgba(255, 255, 255, .1);
        }

        .login-space .group label .icon:before,
        .login-space .group label .icon:after {
            content: '';
            width: 10px;
            height: 2px;
            background: #fff;
            position: absolute;
            transition: all .2s ease-in-out 0s;
        }

        .login-space .group label .icon:before {
            left: 3px;
            width: 5px;
            bottom: 6px;
            transform: scale(0) rotate(0);
        }

        .login-space .group label .icon:after {
            top: 6px;
            right: 0;
            transform: scale(0) rotate(0);
        }

        .login-space .group .check:checked+label {
            color: #fff;
        }

        .login-space .group .check:checked+label .icon {
            background: #1161ee;
        }

        .login-space .group .check:checked+label .icon:before {
            transform: scale(1) rotate(45deg);
        }

        .login-space .group .check:checked+label .icon:after {
            transform: scale(1) rotate(-45deg);
        }

        .login-snip .sign-in:checked+.tab+.sign-up+.tab+.login-space .login {
            transform: rotate(0);
        }

        .login-snip .sign-up:checked+.tab+.login-space .sign-up-form {
            transform: rotate(0);
        }

        *,
        :after,
        :before {
            box-sizing: border-box
        }

        .clearfix:after,
        .clearfix:before {
            content: '';
            display: table
        }

        .clearfix:after {
            clear: both;
            display: block
        }

        a {
            color: inherit;
            text-decoration: none
        }


        .hr {
            height: 2px;
            margin: 60px 0 50px 0;
            background: rgba(255, 255, 255, .2);
        }

        .foot {
            text-align: center;
        }

        .card {
            width: 500px;
            left: 100px;
        }

        ::placeholder {
            color: #b3b3b3;
        }

        .img-fade-all:hover {
            opacity: 0.5;
        }

        .btn-rounded {
            border-radius: 25px;
        }
    </style>
</head>

<body style="background-color:#17011F;">
    <div class="container" style="background-color:#17011F;">

        <div class="row video-section" style="padding-top:5%;">

            <div class="col-md-6 my-div d-flex justify-content-center">
                <img src="public/images/login-instructions.png" style="height: 400px;width: 500px;">
            </div>

            <div class="col-md-6 my-div d-flex justify-content-center">

                <div class="login-box border border-primary border-2 rounded" style="border: 1px solid transparent !important;border-image: linear-gradient(to right, #ff6a00, #ee0979) 1 !important;">
                    <div class="login-snip">
                        <center><img src="public/images/new_logo.png" width="200px"></center>
                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
                        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
                        <div class="login-space">
                            <div class="login">
                                <!--<form id="login-form" class="form" action="{{ route('login') }}" method="post" autocomplete="off">-->
                                <!--@csrf-->
                                    <div class="group">
                                        <label for="user" class="label">Username</label>
                                        <input id="user_name" type="text" name="user_name" class="input" placeholder="Enter your username">
                                    </div>
                                    <div class="group">
                                        <label for="pass" class="label">Password</label>
                                        <input id="password" type="password" name="password" class="input" data-type="password" placeholder="Enter your password">
                                    </div>
                                    <div class="group">
                                        <input id="check" type="checkbox" class="check" checked>
                                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                                    </div>
                                    <div class="group">
                                        <input type="submit" class="button" value="Sign In" id="submit-login-button" onKeyPress="checkSubmit(event)" onclick="checkLoginSubmit()" 
                                            style="background-image: linear-gradient(to right, #ff6a00, #ee0979);color: #fff;">
                                    </div>
                                    <div class="hr"></div>
                                    <div class="foot">
                                        <a href="#" style="color:white">Forgot Password?</a>
                                    </div>
                                <!--</form>-->
                            </div>
                            
                            <!-- register form -->
                            <div class="sign-up-form">
                                
                                <div id="register-form" style="display:block">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="group">
                                                <label for="user" class="label">Full Name</label>
                                                <input type="text" id="full-name" maxlength="100" class="input" oninput="checknameregister()">
                                                <span style="color:red" id="name-error"></span>
                                            </div>
                                            <div class="group">
                                                <label for="user" class="label">Username</label>
                                                <input type="text" id="reg-user-name" maxlength="10" class="input" oninput="checkusernameregister()">
                                                <span style="color:red" id="username-error"></span>
                                            </div>
                                            <div class="group">
                                                <label for="user" class="label">Phone Number</label>
                                                <input type="number" id="phone-number" maxlength="11" class="input" oninput="checkphoneregister()">
                                                <span style="color:red" id="phone-error"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="group">
                                                <label for="pass" class="label">Email Address</label>
                                                <input id="email-address" type="text" class="input" oninput="checkemailregister()">
                                                <span style="color:red" id="email-error"></span>
                                            </div>
                                            <div class="group">
                                                <label for="pass" class="label">Password</label>
                                                <input type="password" id="reg-password" maxlength="15" class="input" data-type="password">
                                            </div>
                                            <div class="group">
                                                <label for="pass" class="label">Confirm Password</label>
                                                <input type="password" id="password-confirm" maxlength="15" class="input" data-type="password" oninput="checkpasswordregister()">
                                                <span style="color:red" id="password-error"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="group" id="button-submit-register">
                                                <input type="button" id="submit-register-button" onclick="hideregisterform()" class="button" value="Sign Up"  style="background-image: linear-gradient(to right, #ff6a00, #ee0979);color: #fff;">
                                                <center><span style="color:white;display:none" id="hideregister-loader">Loading...</span></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="verify-form" style="display:none">
                                    
                                    <br><br><br>
                                    <h1 style="font-size:17px;color:white">OTP Code has been sent to your phone number.</h1>
            
                                    <div class="login-space">
                                        <div class="row group  d-flex justify-content-center">
                                            <input type="text" maxlength="1" class="input" style="width:53px" id="otp-1" tabindex="1">
                                            <input type="text" maxlength="1" class="input" style="width:53px" id="otp-2" tabindex="2">
                                            <input type="text" maxlength="1" class="input" style="width:53px" id="otp-3" tabindex="3">
                                            <input type="text" maxlength="1" class="input" style="width:53px" id="otp-4" tabindex="4">
                                            <input type="text" maxlength="1" class="input" style="width:53px" id="otp-5" tabindex="5">
                                            <input type="text" maxlength="1" class="input" style="width:53px" id="otp-6" tabindex="6">
                                        </div>
                                        
                                        <div class="group">
                                            <input type="submit" onclick="submit_register()" id="submit-otp" class="button" value="Verify OTP" style="background-image: linear-gradient(to right, #ff6a00, #ee0979);color: #fff;">
                                            <center><span style="color:white;display:none" id="otp-loader">Loading...</span></center>
                                        </div>
            
                                    </div>

                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>


            </div>

        </div>

        <!-- footer -->
        <div class="row">
            <div class="col-12">
                <!--<center><img src="public/images/Footer.png" class="img-fluid"></center>-->
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        
        function checkSubmit(e) {
            if(e && e.keyCode == 13) {
                checkLoginSubmit();
            }
        }
        
        function checkLoginSubmit() {
            if($("#user_name").val() == '' || $("#password").val() == '') {
                alert('Please fill in username & password');
            }
            else {
                //ajax process starts here
                $.ajax({
                    type: "post",
                    url: "{{url('checkLoginPassword')}}",
                    headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data:
                    {
                        password : $("#password").val(),
                        user_name : $("#user_name").val(),
                    },
                    success: function(data)
                    {
                        result = JSON.parse(data);
                        status = result['status'];
                        if(status == 0) {
                            // Redirect to a new URL
                            window.location.href = "/home";

                            // document.getElementById("login-form").submit();
                        }
                        else
                        {
                            alert(result['message']);
                        }
                    }
                });
            }
        }
        
        //register function
        function hideregisterform() {
            document.getElementById("submit-register-button").disabled = false;
            $.ajax({
                type: "post",
                url: "{{url('hideregisterform')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:
                {
                    user_name : $("#reg-user-name").val(),
                    phone_number : $("#phone-number").val(),
                    password : $("#reg-password").val(),
                    password2 : $("#password-confirm").val(),
                    full_name : $("#full-name").val(),
                    email : $("#email-address").val(),
                    ref_id : $("#referral-id").val(),
                },
                beforeSend: function()
                {
                    $("#hideregister-loader").show();
                },
                success: function(data)
                {
                    result = JSON.parse(data);
                    status = result['status'];
                    
                    if(status == 0)
                    {
                        //check if password is the same or not
                        $("#register-form").hide();
                        $("#verify-form").fadeIn();
                    }
                    else
                    {
                        alert(result['message']);
                        $("#hideregister-loader").hide();
                        document.getElementById("submit-register-button").disabled = false;
                    }
                }
            });
        }
        
        //registration validations
        
        function checkRefId() {
            $.ajax({
                type: "post",
                url: "{{url('checkReferralId')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:
                {
                    referral_id : $("#referral-id").val(),
                },
                success: function(data)
                {
                    if(data == 1)
                    {
                        $("#referral-ok").hide();
                        $("#referral-error").show();
                        //$("#submit-button").hide();
                    }
                    else
                    {
                        $("#referral-error").hide();
                        $("#referral-ok").show();
                        //$("#submit-button").show();
                    }
                }
            });
        }
        
        function checkphoneregister() {
            $.ajax({
                type: "post",
                url: "{{url('checkphoneregister')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:
                {
                    phone_number : $("#phone-number").val(),
                },
                success: function(data)
                {
                    result = JSON.parse(data);
                    status = result['status'];
                    message = result['message'];

                    if(status == 0)
                    {
                        $("#phone-button").show();
                        $("#phone-error").html("");
                    }
                    else
                    {
                        $("#phone-button").hide();
                        $("#phone-error").html(message);
                    }
                }
            });
        }
        
        function checkpasswordregister() {
            $.ajax({
                type: "post",
                url: "{{url('checkpasswordregister')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:
                {
                    password : $("#reg-password").val(),
                    cpassword : $("#password-confirm").val(),
                },
                success: function(data)
                {
                    result = JSON.parse(data);
                    status = result['status'];
                    message = result['message'];

                    if(status == 0)
                    {
                        $("#password-error").html("");
                    }
                    else
                    {
                        $("#password-error").html(message);
                    }
                }
            });
        }
                
        function checkusernameregister() {
            $.ajax({
                type: "post",
                url: "{{url('checkusernameregister')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:
                {
                    user_name : $("#reg-user-name").val(),
                },
                success: function(data)
                {
                    result = JSON.parse(data);
                    status = result['status'];
                    message = result['message'];

                    if(status == 0)
                    {
                        $("#username-error").html("");
                    }
                    else
                    {
                        $("#username-error").html(message);
                    }
                }
            });
        }
                
        function checknameregister() {
            $.ajax({
                type: "post",
                url: "{{url('checknameregister')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:
                {
                    full_name : $("#full-name").val(),
                },
                success: function(data)
                {
                    result = JSON.parse(data);
                    status = result['status'];
                    message = result['message'];

                    if(status == 0)
                    {
                        $("#name-error").html("");
                    }
                    else
                    {
                        $("#name-error").html(message);
                    }
                }
            });
        }
        
        function checkemailregister() {
            $.ajax({
                type: "post",
                url: "{{url('checkemailregister')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:
                {
                    email : $("#email-address").val(),
                },
                success: function(data)
                {
                    result = JSON.parse(data);
                    status = result['status'];
                    message = result['message'];

                    if(status == 0)
                    {
                        $("#email-error").html("");
                    }
                    else
                    {
                        $("#email-error").html(message);
                    }
                }
            });
        }
        
        function submit_register() {
            document.getElementById("submit-otp").disabled = true;
            
            var otp1 = $("#otp-1").val();
            var otp2 = $("#otp-2").val();
            var otp3 = $("#otp-3").val();
            var otp4 = $("#otp-4").val();
            var otp5 = $("#otp-5").val();
            var otp6 = $("#otp-6").val();
            
            $.ajax({
                type: "post",
                url: "{{url('newRegisterProcess')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:
                {
                    otp : otp1+otp2+otp3+otp4+otp5+otp6,
                    user_name : $("#reg-user-name").val(),
                    phone_number : $("#phone-number").val(),
                    password : $("#reg-password").val(),
                    password2 : $("#password-confirm").val(),
                    full_name : $("#full-name").val(),
                    email : $("#email-address").val(),
                    ref_id : $("#referral-id").val(),
                },
                beforeSend: function()
                {
                    $("#otp-loader").show();
                },
                success: function(data)
                {
                    result = JSON.parse(data);
                    status = result['status'];
                    
                    if(status == 0)
                    {
                        alert(result['message']);
                        $("#otp-loader").hide();
                        window.location.href = "/home";
                        return false;
                    }
                    else
                    {
                        alert(result['message']);
                        $("#otp-loader").hide();
                        document.getElementById("submit-otp").disabled = false;
                    }
                }
            });
        }

    </script>
</body>

</html>