<div class="col-4">
    <!-- search bar -->
    <div class="input-group search-bar-css rounded-pill">
        <input class="form-control border rounded-pill search-bar-css-input" style="background-color: transparent;" type="search" placeholder="Find Your Game" id="search-games" oninput="searchgames()">
    </div>
</div>

<div class="col-4 top-header-name">
    <div class="top-header-name-content">
        <div class="top-wallet-balance" style="background-color: transparent;">
            <span style="position: absolute;color: gray;top: 0px;">Welcome {{Auth::User()->name}}!</span>
            <br>
            <span style="position: absolute;color: gray;top: 20px;">Wallet Balance : <span id="main-wallet-balance">Loading...</span></span>
        </div>
    </div>

</div>

<script type="text/javascript">
    mainwallet();

    function mainwallet() {
        $.ajax({
            type: "post",
            url: "mainwallet",
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data)
            {
                $("#main-wallet-balance").html(data);
            }
        });
    }
</script>

