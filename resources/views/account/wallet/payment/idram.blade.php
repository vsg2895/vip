<form action="https://money.idram.am/payment.aspx" id="idram" method="POST">
    <input type="text" name="EDP_LANGUAGE" value="{{ app()->getLocale() }}">
    <input type="text" name="EDP_REC_ACCOUNT" value="{{ $payment_secure_data['payment_method']['client_id'] }}">
    <input type="text" name="EDP_DESCRIPTION" value="{{ $payment_secure_data['ordername'] }}">
    <input type="text" name="EDP_AMOUNT" value="{{ $payment_secure_data['amount'] }}">
    <input type="text" name="EDP_BILL_NO" value="{{ $payment_secure_data['order_id'] }}">
</form>
<script type="text/javascript"> document.getElementById("idram").submit(); </script>