var colegios = null;
var cursos = null;

function format(item) { return item.nombre; }

$(function(){
	$("#btn-seleccionar-colegio").click(function(){
		var img_p = $("#img-principal");
		var img_button = $(this).find('i.fa');
		if(img_p.hasClass('hide')){
			img_p.removeClass('hide');
			img_button.removeClass('fa-angle-down');
			img_button.addClass('fa-angle-up');
		}else{
			img_p.addClass('hide');
			img_button.removeClass('fa-angle-up');
			img_button.addClass('fa-angle-down');
		}
	});
	
	$("#btn-curso-agregar-todos").click(function(e){
		e.preventDefault();
		location.href = $(this).attr('data-href');
	});
	
	$('.tiene-hijos').click(function(e){
		if($(this).find('span.fa').hasClass('fa-angle-down')){
			$(this).find('span.fa').removeClass('fa-angle-down').addClass('fa-angle-up');				
		}else{
			$(this).find('span.fa').removeClass('fa-angle-up').addClass('fa-angle-down');
		}
	});
	
	$('a[href="#'+$('.item-desplegado').attr('data-padre')+'"]').trigger('click');
	
	//se cierran las demas categorias
	$('a.tiene-hijos').click(function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		$('a.tiene-hijos[data-id!='+id+']').find('span.icon-padre').removeClass('fa-angle-up').addClass('fa-angle-down');
		$('a.tiene-hijos[data-id!='+id+']').next('div.hijo-tiene-hijos').removeClass('in');
	});
	
	//para los filtros de precio y nombre
	$('#select-filtros').change(function(){
		document.forms.form_filtros.submit()
	});
});