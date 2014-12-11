@extends('layouts.pago')

@section('css-header')
<style type="text/css">
	.text-mini {
		font-size: 12px;
	}
	.espacio-arriba {
		padding-top: 10px;
	}
	.gran-total {
		font-size: 15px;
	}
	.submit-button {
		margin-top: 10px;
	}
</style>
@endsection

@section('sidebar-right')
	
@endsection

@section('content')
<div class="bg-white">
	<div class="col-md-12">
		<h4>
			<i class="fa fa-dollar"></i>&nbsp;&nbsp;Pago
		</h4>
		<hr />
		<br />
	</div>
	<div class="col-md-12 col-sm-12">
		<div class='col-md-4'></div>
        <div class='col-md-4'>
          <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
          <form accept-charset="UTF-8" action="/" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_bQQaTxnaZlzv4FnnuZ28LFHccVSaj" id="payment-form" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓" /><input name="_method" type="hidden" value="PUT" /><input name="authenticity_token" type="hidden" value="qLZ9cScer7ZxqulsUWazw4x3cSEzv899SP/7ThPCOV8=" /></div>
            <div class='form-row'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Nombre en la Tarjeta</label>
                <input class='form-control' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-xs-12 form-group card required'>
                <label class='control-label'>N&uacute;mero de Tarjeta</label>
                <input autocomplete='off' class='form-control card-number' size='20' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-xs-4 form-group cvc required'>
                <label class='control-label'>CVC&nbsp;&nbsp;<i id="popover-card" data-trigger="hover" data-placement="top" class="fa fa-question-circle"></i></label>
                <input autocomplete='off' class='form-control card-cvc' placeholder='' size='4' type='text'>
              </div>
              <div class='col-xs-4 form-group expiration required'>
                <label class='control-label'>Expiraci&oacute;n</label>
                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
              </div>
              <div class='col-xs-4 form-group expiration required'>
                <label class='control-label'> </label>
                <input class='form-control card-expiry-year' placeholder='YY' size='2' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12'>
                <div class='form-control total btn btn-info'>
                  Total:
                  <span class='amount'>${{ number_format($gran_total, 2) }}</span>
                </div>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 form-group'>
                <button class='form-control btn btn-primary submit-button' type='submit'>Pagar <i class="fa fa-angle-double-right"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class='col-md-4'></div>
	</div>
	<div class="col-sm-12">
		<a href="{{ URL::route('compra_resumen') }}?direccion_id={{$direccion->id}}" class="btn btn-default btn-sm">
			<i class="fa fa-chevron-circle-left"></i>&nbsp;
			Anterior
		</a>
		{{--<form class="pull-right" method="get" action="{{ URL::route('compra_resumen') }}">
			<input type="hidden" id="id_direccion_id" name="direccion_id" value="" />
			<button id="btn-siguiente" class="btn btn-primary btn-sm">
				Siguiente&nbsp;
				<i class="fa fa-chevron-circle-right"></i>
			</button>
		</form>--}}
	</div>
	<div class="clearfix">
		<br />
	</div>
</div>
<div id="card-hover" style="display:none;">
	<img src="{{ URL::asset('img/CreditCardBack.jpg') }}" width="100" />
</div>
@endsection

@section('js-footer')
{{ HTML::script('js/bootbox.min.js') }}
<script type="text/javascript">
	$(function() {
		$('#popover-card').popover({
			html: true,
			content: $('#card-hover').html()
		});
	}); 
</script>
@endsection
