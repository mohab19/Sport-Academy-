<form id="SearchInvoice">
    {!! csrf_field() !!}
    <div class="col-xs-12 text-center">
        <input type="text" name="invoice_id" placeholder="Enter Invoice Number">
        <label class="alert text-center" id="invoice_invoice_num"> </label>
    </div>
    <div class="clearfix"></div>
    <div class="alert text-center"></div>
    <div class="clearfix"></div>
</form>