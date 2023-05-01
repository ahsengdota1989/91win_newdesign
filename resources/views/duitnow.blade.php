Loading...

<form id="surepay-form" method="post" action="https://pgw3.surepay88.com/fundtransfer">
    <input type="hidden" name="merchant" value="SPRMRR2006">
    <input type="hidden" name="amount" value="{{$amount}}">
    <input type="hidden" name="refid" value="{{$refId}}">
    <input type="hidden" name="token" value="{{$token}}">
    <input type="hidden" name="customer" value="{{$customer}}">
    <input type="hidden" name="currency" value="MYR">
    <input type="hidden" name="contractname" value="SPRMRR2006QR">
    <input type="hidden" name="bankcode" value="10010343">
    <input type="hidden" name="language" value="en">
    <input type="hidden" name="clientip" value="192.168.1.1">
    <input type="hidden" name="post_url" value="https://91win999.com/sites/gameApi/public/surepaycallback">
    <input type="hidden" name="failed_return_url" value="https://91win88.com/newDepositPage">
    <input type="hidden" name="return_url" value="https://91win88.com/newDepositPage">
    <!--<button type="submit">submit</button>-->
</form>

<script>
    document.getElementById('surepay-form').submit();
</script>