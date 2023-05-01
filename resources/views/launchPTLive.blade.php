<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Code for Game Launching</title>
</head>

<body onload="login()">
    <!-- We do not support testing games via localhost -->
    <!-- Please host this html file on your server and assign one domain with it,
    remeber that domain needs to be whitelisted otherwise you will get error code 6 -->
    <!-- You can try testing games with fun mode.it doesnot require login.-->
    <div>
        <input type="text" id="username" name="username" value="{{ $username }}" style="display:none"><br><br>
        <input type="text" id="password" name="password" value="{{ $password }}" style="display:none"><br><br>
        <input type="text" id="lang" name="lang" value="en" style="display:none"><br><br>
        <input type="text" id="client" name="client" value="live_desk" style="display:none"><br><br>
        <input type="text" id="mode" name="mode" value="real" style="display:none"><br><br>
        <input type="text" id="game" name="game" value="" style="display:none"><br><br>
        <button onclick="login()" style="display:none">Login and Launch</button>
    </div>
    <script>
    login();
    function login() {
        // Get variables
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;
        let lang = document.getElementById("lang").value;
        let mode = document.getElementById("mode").value;
        if (mode == 'real') {
            iapiSetClientType('casino');
            iapiSetClientPlatform('web');
            iapiLogin(username, password, 1, lang);
        } else {
            // mode is offline, which does not require login. NOTE: only supports client with ngm_desktop and ngm_mobile
            launchGameWithFunMode()
        }
    }
    function launchGame() {
        // Get variables
        let client = document.getElementById("client").value;
        let mode = document.getElementById("mode").value;
        let game = document.getElementById("game").value;
        let lang = document.getElementById("lang").value;
        let real = (mode == 'real') ? 1 : 0;
        // Optional Variables
        let lobbyUrl = '';
        let logoutUrl = '';
        let supportUrl = '';
        let depositUrl = '';
        // Slots,Table Games and other non-live games
        if (client == 'ngm_desktop' || client == 'ngm_mobile') {
            iapiSetClientParams(client, 'language=' + lang + '&real=' + real + '&lobby=' + lobbyUrl + '&logout=' +
            logoutUrl + '&deposit=' + depositUrl + '&support=' + supportUrl + '&backurl=' + lobbyUrl);
            iapiLaunchClient(client, game, mode, '_self');
        }
        // Live Games
        if (client == 'live_desk' || client == 'live_mob') {
            iapiSetClientParams(client, '&launch_alias=' + game + '&language=' + lang + '&real=' + real + '&lobby='
            + lobbyUrl + '&logout=' + logoutUrl + '&deposit=' + depositUrl + '&support=' + supportUrl);
            iapiLaunchClient(client, null, mode, '_self');
        }
    }
    function launchGameWithFunMode() {
        // Get variables
        let client = document.getElementById("client").value;
        let game = document.getElementById("game").value;
        let lang = document.getElementById("lang").value;
        let mode = document.getElementById("mode").value;

        if (client == 'ngm_desktop' || client == 'ngm_mobile') {
            iapiSetClientParams(client, 'language=' + lang + '&real=0');

            iapiLaunchClient(client, game, mode, '_self');
        }
    }
    function calloutLogin(response) {
        if (response.errorCode) {
            // Login failed
            if (response.errorCode == 48) {
                alert('Login failed, error: ' + response.errorCode + ' playerMessage: ' +
                response.actions.PlayerActionShowMessage[0].message);
            } else {
                alert('Login failed, error: ' + response.errorCode + ' playerMessage: ' + response.playerMessage);
            }
        } else {
            // Login success
            launchGame();
        }
    }
    </script>
    <script>
    // Load JS file
    let script = document.createElement('script');
    script.setAttribute('src', 'https://login-am.htsp123.com/jswrapper/hotspin88am/integration.js');
    document.head.appendChild(script);

    // Set up callback after JS file is loaded
    script.onload = () => {
        iapiSetCallout('Login', calloutLogin);


        // iapiConf.clientUrl_ngm_desktop = 'https://cachedownload-am.cat87666.com/ngmdesktop/casinoclient.html';
        // iapiConf.clientUrl_ngm_mobile = 'https://games-am.cat87666.com/casinomobile/casinoclient.html';
        // iapiConf.clientUrl_live_desk = 'https://cachedownload-am.cat87666.com/live/html5/desktop/';
        // iapiConf.clientUrl_live_mob = 'https://cachedownload-am.cat87666.com/live/html5/mobile/';
        
        iapiConf.clientUrl_ngm_desktop = 'https://cachedownload-am.htsp123.com/ngmdesktop/casinoclient.html';
        iapiConf.clientUrl_ngm_mobile = 'https://games-am.htsp123.com/casinomobile/casinoclient.html';
        iapiConf.clientUrl_live_desk = 'https://cachedownload-am.htsp123.com/live/html5/desktop/';
        iapiConf.clientUrl_live_mob = 'https://cachedownload-am.htsp123.com/live/html5/mobile/';



    }
    </script>
</body>
</html>
