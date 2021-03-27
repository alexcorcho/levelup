<div class="row">
    <div class="col-md-12">
        <div class="panel no-border ">
            <div class="panel-title">
                <div class="panel-head font-size-20">Detalles de la transacción de pago de la factura</div>
            </div>
            <div class="panel-body">
                <table id="_payment" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Monto recibido</th>
                        <th>de</th>
                        <th>On</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach ($invoice->payment_details as $payment_detail)
                            <td>{{ $payment_detail->payment_amount }}</td>
                            <td>{{ Utilities::getPaymentMode ($payment_detail->mode) }}</td>
                            <td>{{ $payment_detail->created_at->toDayDateTimeString() }}</td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>