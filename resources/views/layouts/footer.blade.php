<div class="row" style="background-color:#17011f">
    <div class="col-12">
        <center><img src="public/images/Footer.png" class="img-fluid"></center>
    </div>
</div>

    <script type="text/javascript">
        get4dBalance();
        getJokerBalance();
        getEvoBalance();
        getMegaBal();
        getPlaytechBalance();
        getSexyBalance3571();
        getAGBalance3571();
        getPussyBal();
        get918Bal();
        getAllbetBal();
        getSpadeBal();
        getM8Bal();
        getPragmaticBal();
        getIBCBal3571();
        getMicroBal();
        
        function getIBCBal3571() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/ibc')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#ibc-loader-image1").show();
                },
                success: function(data)
                {
                    $("#ibc-loader-image1").hide();
                    $("#ibc-balance-div").html(data);
                }
            });
        }
        
        function getPragmaticBal() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/pragmatic')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#pragmatic-loader-image1").show();
                },
                success: function(data)
                {
                    $("#pragmatic-loader-image1").hide();
                    $("#pragmatic-balance").html(data);
                }
            });
        }
        
        function getSpadeBal() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/spade')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#spadegaming-loader-image1").show();
                },
                success: function(data)
                {
                    $("#spadegaming-loader-image1").hide();
                    $("#spadegaming-balance").html(data);
                }
            });
        }
        
        function getM8Bal() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/m8Sports')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#m8Sports-loader-image1").show();
                },
                success: function(data)
                {
                    //console.log("m8 balance" + data);
                    $("#m8Sports-loader-image1").hide();
                    $("#m8Sports2-balance").html(data);
                }
            });
        }
        
        function getAllbetBal() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/allbet')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#allbet-loader-image1").show();
                },
                success: function(data)
                {
                    //console.log("allbet balance" + data);
                    $("#allbet-loader-image1").hide();
                    $("#allbet2-balance").html(data);
                }
            });
        }

        function getPussyBal() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/pussy888')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#pussy-loader-image1").show();
                },
                success: function(data)
                {
                    $("#pussy-loader-image1").hide();
                    $("#pussy-balance").html(data);
                }
            });
        }
        
        function get918Bal() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/nineoneeight')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#918-loader-image1").show();
                },
                success: function(data)
                {
                    $("#918-loader-image1").hide();
                    $("#918-balance").html(data);
                }
            });
        }
        
        function getAGBalance3571() {
            $.ajax({
                type: "post",
                url: "{{url('/ag/getbalance')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#ag-loader-image1").show();
                },
                success: function(data)
                {
                    $("#ag-loader-image1").hide();
                    $("#ag-balance-div").html(data);
                }
            });
        }
        
        function get4dBalance() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/4d')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#fourdee-loader-image1").show();
                },
                success: function(data)
                {
                    $("#fourdee-loader-image1").hide();
                    $("#fourdee-balance-div").html(data);
                }
            });
        }
        
        function getJokerBalance() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/joker')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#joker-loader-image1").show();
                },
                success: function(data)
                {
                    $("#joker-balance-div").html(data);
                    $("#joker-loader-image1").hide();
                }
            });
        }
        
        function getEvoBalance() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/evo')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#evo-loader-image1").show();
                },
                success: function(data)
                {
                    $("#evo-balance-div").html(data);
                    $("#evo-loader-image1").hide();
                }
            });
        }
        
        function getMegaBal() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/mega')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#mega-loader-image1").show();
                },
                success: function(data)
                {
                    $("#mega-balance-div").html(data);
                    $("#mega-loader-image1").hide();
                }
            });
        }
        
        function getPlaytechBalance() {
            $.ajax({
                type: "post",
                url: "{{url('playtechGetBalance')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#playtech-loader-image1").show();
                },
                success: function(data)
                {
                    $("#playtech-balance-div").html(data);
                    $("#playtech-loader-image1").hide();
                }
            });
        }
        
        function getSexyBalance3571() {
            $.ajax({
                type: "post",
                url: "{{url('/sexy/getBalance')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function()
                {
                    $("#sexy-loader-image1").show();
                },
                success: function(data)
                {
                    $("#sexy-balance-div").html(data);
                    $("#sexy-loader-image1").hide();
                }
            });
        }
        
        function getMicroBal() {
            $.ajax({
                type: "post",
                url: "{{url('/balance/microgaming')}}",
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data)
                {
                    $("#micro-balance").html(data);
                }
            });
        }
        
        function transferGame() {
            
            var from = $("#game-transfer-from").val();
            var to = $("#game-transfer-to").val();
            var promotion = $("#dep-promo").val();
            var amount = $("#dep-pg-amount").val();

            if(from == to) {
                $("#error-text").html('Cannot transfer to the same source');
                $('#errorModal').fadeIn();
            }
            else {
                $("#transfer-game-button").hide();
                $.ajax({
                    type: "post",
                    url: "{{url('transferGameProcess')}}",
                    headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data:
                    {
                        from : from,
                        to : to,
                        promotion : promotion,
                        amount : amount
                    },
                    beforeSend: function()
                    {
                        $("#transfer-loader").show();
                    },
                    success: function(data)
                    {
                        result = JSON.parse(data);
                        status = result['status'];

                        if(status == 0)
                        {
                            $("#success-text").html(result['message']);
                            $('#successModal').fadeIn();
                            $("#loader-transfer-game").hide();
                            $("#transfer-game-button").show();
                        }
                        else
                        {
                            $("#error-text").html(result['message']);
                            $('#errorModal').fadeIn();
                            $("#transfer-loader").hide();
                            $("#transfer-game-button").show();
                        }
                        
                        //refresh balance
                        get4dBalance();
                        getJokerBalance();
                        getEvoBalance();
                        getMegaBal();
                        getPlaytechBalance();
                        getSexyBalance3571();
                        getAGBalance3571();
                        getPussyBal();
                        get918Bal();
                        getAllbetBal();
                        getSpadeBal();
                        getM8Bal();
                        getPragmaticBal();
                        getIBCBal3571();
                        getMicroBal();
                    }
                });
            }
        }
    </script>

