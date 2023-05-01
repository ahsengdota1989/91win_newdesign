<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
@include('layouts.head')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css"
    integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<style>
    body {
        background: url(images/background.jpg);
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
    }

    #exTab1 .tab-content {
        color: white;
        background-color: #428bca;
        padding: 5px 15px;
    }

    #exTab2 h3 {
        color: white;
        background-color: #428bca;
        padding: 5px 15px;
    }

    #exTab1 .nav-pills>li>a {
        border-radius: 0;
    }

    #exTab3 .nav-pills>li>a {
        border-radius: 4px 4px 0 0;
    }

    #exTab3 .tab-content {
        color: white;
        background-color: #428bca;
        padding: 5px 15px;
    }

    .bottompadding {
        padding-bottom: 30px;
    }

    .slot-title {
        width: 100%;
        text-align: center;
        background: rgb(255,237,171);
        background: linear-gradient(180deg, rgba(255,237,171,1) 0%, rgba(255,254,199,1) 17%, rgba(255,236,167,1) 49%, rgba(240,204,130,1) 74%, rgba(254,251,183,1) 100%);
        margin-bottom: 10px;
        height: 4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 12px;
        color: #513107;
        font-weight: bold;
    }

    .image {
        transition: transform .5s ease;
        cursor: pointer;
        padding-bottom:5px;
    }

    .image:hover {
        transform: scale(1.2);
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }

    .nav-tabs{
        border-bottom: 3px solid #ffedab;
    }

    .nav-tabs>li {
        background-color: white;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover,
    .nav-tabs>li>a:hover {
        color: #513107;
        background: rgb(255,237,171);
        background: linear-gradient(180deg, rgba(255,237,171,1) 0%, rgba(255,254,199,1) 17%, rgba(255,236,167,1) 49%, rgba(240,204,130,1) 74%, rgba(254,251,183,1) 100%);
    }
    .nav-tabs>li>a {
        color: #513107;
    }

    .p-0 {
        padding: 0;
    }
</style>
<body>
    <div id="mainContent"></div>

    <div class="main-wrapper">

        @include('layouts.left-right-button')

        @include('layouts.header')

        @include('layouts.header-dropdown')

        <div class="content-padding seo">
            <div class="wrapper">

                <div class="main-section-wrap clearfix">

                    <div class="col-md-12" style="padding: 0;">

                        <div class="container" style="padding: 0;">

                            <!-- <img src="images/banner.png" width="100%"> -->

                            <div id="exTab2" class="container">
                                <ul class="nav nav-tabs" style="padding:20px;">
                                    <li class="active">
                                        <a href="#1" data-toggle="tab">All Games</a>
                                    </li>
                                    <li><a href="#2" data-toggle="tab">Top Games</a></li>
                                    <!--<li><a href="#3" data-toggle="tab">Table Games</a></li>-->
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="1" style="padding-top:20px;">
                                        <div class="row bottompadding">
                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs5aztecgems.png"
                                                    onclick='window.open("{{url('launchSG')}}/A-DB05", "SpadeGaming")' />
                                                <div class="slot-title">Aztec Gems</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs5joker.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs5joker", "Pragmatic")' />
                                                <div class="slot-title">Joker's Jewels</div>
                                            </div>

                							<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs20bonzgold.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20bonzgold", "Pragmatic")' />
                                                <div class="slot-title">Bonanza Gold</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs40wildwest.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs40wildwest", "Pragmatic")' />
                                                <div class="slot-title">Wild West Gold</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2  ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs20fruitsw.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20fruitsw", "Pragmatic")' />
                                                <div class="slot-title">Sweet Bonanza</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs9aztecgemsdx.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs9aztecgemsdx", "Pragmatic")' />
                                                <div class="slot-title">Aztec Gems Deluxe</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2  ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs10firestrike.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs10firestrike", "Pragmatic")' />
                                                <div class="slot-title">Fire Strike</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs10cowgold.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs10cowgold", "Pragmatic")' />
                                                <div class="slot-title">Cowboys Gold</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs20xmascarol.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20xmascarol", "Pragmatic")' />
                                                <div class="slot-title">Christmas Carol Megaways</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs10bbbonanza.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs10bbbonanza", "Pragmatic")' />
                                                <div class="slot-title">Big Bass Bonanza</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs20rhino.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20rhino", "Pragmatic")' />
                                                <div class="slot-title">Great Rhino</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs15diamond.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs15diamond", "Pragmatic")' />
                                                <div class="slot-title">Diamond Strike</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs20doghouse.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20doghouse", "Pragmatic")' />
                                                <div class="slot-title">The Dog House</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2  ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs20vegasmagic.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20vegasmagic", "Pragmatic")' />
                                                <div class="slot-title">Vegas Magic</div>
                                            </div>

                                            



                                        </div>
                                    </div>
                                    <div class="tab-pane" id="2" style="padding-top:20px;">
                                        <div class="row bottompadding">
                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs5aztecgems.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs5aztecgems", "Pragmatic")' />
                                                <div class="slot-title">Aztec Gems</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs5joker.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs5joker", "Pragmatic")' />
                                                <div class="slot-title">Joker's Jewels</div>
                                            </div>

                							<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs20bonzgold.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20bonzgold", "Pragmatic")' />
                                                <div class="slot-title">Bonanza Gold</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs40wildwest.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs40wildwest", "Pragmatic")' />
                                                <div class="slot-title">Wild West Gold</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2  ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs20fruitsw.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20fruitsw", "Pragmatic")' />
                                                <div class="slot-title">Sweet Bonanza</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs9aztecgemsdx.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs9aztecgemsdx", "Pragmatic")' />
                                                <div class="slot-title">Aztec Gems Deluxe</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2  ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs10firestrike.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs10firestrike", "Pragmatic")' />
                                                <div class="slot-title">Fire Strike</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs10cowgold.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs10cowgold", "Pragmatic")' />
                                                <div class="slot-title">Cowboys Gold</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs20xmascarol.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20xmascarol", "Pragmatic")' />
                                                <div class="slot-title">Christmas Carol Megaways</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs10bbbonanza.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs10bbbonanza", "Pragmatic")' />
                                                <div class="slot-title">Big Bass Bonanza</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs20rhino.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20rhino", "Pragmatic")' />
                                                <div class="slot-title">Great Rhino</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs15diamond.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs15diamond", "Pragmatic")' />
                                                <div class="slot-title">Diamond Strike</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs20doghouse.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20doghouse", "Pragmatic")' />
                                                <div class="slot-title">The Dog House</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2  ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs20vegasmagic.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20vegasmagic", "Pragmatic")' />
                                                <div class="slot-title">Vegas Magic</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs10mayangods.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs10mayangods", "Pragmatic")' />
                                                <div class="slot-title">John Hunter And The Mayan Gods</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vswaysrhino.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vswaysrhino", "Pragmatic")' />
                                                <div class="slot-title">Great Rhino Megaways</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs1dragon8.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs1dragon8", "Pragmatic")' />
                                                <div class="slot-title">888 Dragons</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vs20sbxmas.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs20sbxmas", "Pragmatic")' />
                                                <div class="slot-title">Sweet Bonanza Xmas</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image"
                                                    src="https://api.prerelease-env.biz/game_pic/rec/160/vs40spartaking.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vs40spartaking", "Pragmatic")' />
                                                <div class="slot-title">Spartan King</div>
                                            </div>

                                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 ">
                                                <img width="100%" class="image" src="https://api.prerelease-env.biz/game_pic/rec/160/vswaysdogs.png"
                                                    onclick='window.open("/Handle/xwTransfer.ashx?method=Login3FGG&wallet=35&gameCode=vswaysdogs", "Pragmatic")' />
                                                <div class="slot-title">The Dog House Megaways</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- @include('layouts.site-info') -->
            </div>

            @include('layouts.footer')
        </div>


        <script type="text/javascript">
            var _p = 'index';
            var lang = 'english';
            var country = 'MY'
            var currencyLbl = 'MYR';
            var imgPath = 'https://b34egw3q2.cdnasiaclub.com/e3v2/';
            var defImgPath = 'https://b89666d3f88.cdnasiaclub.com/';
        </script>

        <script defer>
            $(document).ready(function() {
                init();
            })
        </script>
    </div>
</body>
</html>
