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
		<h4><i class="fa fa-dollar"></i>&nbsp;&nbsp;Pago </h4>
		<hr />
		<br />
	</div>
	<div class="col-md-12 col-sm-12">
		<div class='col-md-4'></div>
		<div class='col-md-4'>
			<form action="https://www3.optar.ec/webmpi/vpos" class="require-validation" id="id_payment_form" name="payment_form" method="post">
				<input type="hidden" name="TRANSACCIONID" value=""/>
				<input type="hidden" name="XMLREQUEST" value="DWeSDmpHbf2QKYS2FPKg%2Bd5fcCKSXewRMlhGufiJNbFT%2BzNL5ePDIXjz%2F0shFpy7KVSC6tcnyVfgtZZnJ%2FA8SRRyA9nMDqSdpB4Arh4HEIXNZbKOg6DuobbC%2BVW%2BocnucVBpl9py%2Bs8Q7jmOn35itBhCot%2FwkEV1faPw4EPkLRYrHM%2BXvEj1Z2w3ZHALI3E7NloBt8aAf9xPSCrVhApEdCE0hfUMnAd2CET6ypFaDSKFBStKzlo7%2BzY8OZCA6HVB"/>
				<input type="hidden" name="XMLDIGITALSIGN" value="ZPjeqjFBZQcfoTDs0BFchDKyTVcNa13I1SN%2BejwEF2F3JyolYTTzrBRo9bkWWIo5J7MTwr3cqY%2FYoa7qv2okO4EORyB8sOWH%2FWJTqwQSWbhQiNL9f%2Fi%2FhhQi9xE%2FxIrtdg6h6vm7IKqd5EvHiVHeDULU2yH6DMwUVSlYru0IhCM%3D"/>
				<input type="hidden" name="XMLACQUIRERID" value="{{ URL::route('compra_pago') }}"/>
				<input type="hidden" name="XMLMERCHANTID" value="0992792949001"/>
				<input type="hidden" name="XMLGENERATEKEY" value="a%2BCEg9i56%2FjGgsH5XvZfKxL%2F3oRsTn3jUZrRtnwJiFemReM6iWJyfCC8c89rlbRXp1CLSbLF3lSCyO6pPIiJ%2BEnRpvliyaCXcDAzLNMIepgEngGkVpyn%2BzqytDlJF4cG6euECsYsF8rxzq7fXg%2FXZZKPDQYWfmivzALz8%2Bn5lEg%3D"/>
				
				<div class='form-row'>
					<div class='col-xs-12 form-group'>
						<label class='control-label'>Nombre en la Tarjeta</label>
						<input class='form-control' size='4' type='text' required>
					</div>
				</div>
				<div class='form-row'>
					<div class='col-xs-12 form-group card'>
						<label class='control-label'>N&uacute;mero de Tarjeta</label>
						<input autocomplete='off' class='form-control card-number' size='20' type='text' required>
					</div>
				</div>
				<div class='form-row'>
					<div class='col-xs-4 form-group cvc required'>
						<label class='control-label'>CVC&nbsp;&nbsp;<i id="popover-card" data-trigger="hover" data-placement="top" class="fa fa-question-circle"></i></label>
						<input autocomplete='off' class='form-control card-cvc' placeholder='' size='4' type='text' required>
					</div>
					<div class='col-xs-4 form-group expiration required'>
						<label class='control-label'>Expiraci&oacute;n</label>
						<input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' required>
					</div>
					<div class='col-xs-4 form-group expiration required'>
						<label class='control-label'> </label>
						<input class='form-control card-expiry-year' placeholder='YY' size='2' type='text' required>
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
						<button id="btn-realizar-pago" class='form-control btn btn-primary submit-button' type='submit'>
							Pagar <i class="fa fa-angle-double-right"></i>
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class='col-md-4'></div>
	</div>
	<div class="col-sm-12">
		<a href="{{ URL::route('compra_resumen') }}?direccion_id={{$direccion->id}}" class="btn btn-default btn-sm"> <i class="fa fa-chevron-circle-left"></i>&nbsp;
		Anterior </a>
		{{--
		<form class="pull-right" method="get" action="{{ URL::route('compra_resumen') }}">
			<input type="hidden" id="id_direccion_id" name="direccion_id" value="" />
			<button id="btn-siguiente" class="btn btn-primary btn-sm">
				Siguiente&nbsp;
				<i class="fa fa-chevron-circle-right"></i>
			</button>
		</form>
		--}}
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
			html : true,
			content : $('#card-hover').html()
		});

		//para el boton de realizar pago
		$('#btn-realizar-pago').click(function(e) {
			e.preventDefault();
			var html_ant = $(this).html();
			var html_new = '<i class="fa fa-refresh fa-spin"></i>&nbsp;Realizando Pago';

			$(this).html(html_new);
			$(this).attr('disabled', true);
			
			document.forms.payment_form.submit();
		});
	}); 
</script>
@endsection
