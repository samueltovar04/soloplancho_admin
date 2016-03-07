$(document).ready(function() {


	$("#registro").click(function(){
		$("#modal_registro").modal('show');
	});

	$(".cambioclave").click(function(e){
		e.preventDefault();
		$("#modal_cambioclave").modal('show');
	});

	$("#login").click(function(){
		$("#modal_login").modal('show');
	});

	$("#entrar").click(function(){
		$("#registro_mision").modal('show');
	});
	

	$("#formentrar").bootstrapValidator({
		message: "Error en los campos",
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glypicon glyphicon-remove',
			validating: 'glypicon glyphicon-refresh',
		},
		fields: {
			login: {
				message: 'Usuario Incorrecto',
			validators: {
				notEmpty: {
					message: "El campo no puede estar vacío",
					},
				stringLength: {
					min: 4,
					max: 20,
					message: 'El usuario debe contener de (4) a (20) caracteres'
					},
				regexp: {
					regexp: /^[a-zA-Z0-9_]*$/,
					message: "No se permiten espacios",
					},
				      } 
				},
			clave: {
				message: 'Campo Invalido',
			validators: {
				notEmpty: {
					message: "El campo no puede estar vacío",
					},
				stringLength: {
					min: 4,
					max: 20,
					message: 'La Clave debe contener de (2) a (20) caracteres'
					},
				regexp: {
					regexp: /^[a-zA-Z0-9_]*$/,
					message: "No se permiten espacios",
					},
				      } 
				}
			}
});


$("#formulario_cambioclave").bootstrapValidator({
		message: "Error en los campos",
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glypicon glyphicon-remove',
			validating: 'glypicon glyphicon-refresh',
		},
		fields: {
			passwd2: {
				message: 'Usuario Incorrecto',
			validators: {
				notEmpty: {
					message: "El campo no puede estar vacío",
					},
				stringLength: {
					min: 4,
					max: 20,
					message: 'La Clave debe contener de (4) a (20) caracteres'
					},
				regexp: {
					regexp: /^[a-zA-Z0-9_]*$/,
					message: "No se permiten espacios",
					},
				      } 
				},
			repasswd: {
				message: 'Campo Invalido',
			validators: {
				notEmpty: {
					message: "El campo no puede estar vacío repita la clave",
					},
				stringLength: {
					min: 4,
					max: 20,
					message: 'La Clave debe contener de (4) a (20) caracteres'
					},
				regexp: {
					regexp: /^[a-zA-Z0-9_]*$/,
					message: "No se permiten espacios",
					},
				      } 
				}
			}
});



	$("#formulario_registro").bootstrapValidator({
		message: "Error en los campos",
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glypicon glyphicon-remove',
			validating: 'glypicon glyphicon-refresh',
		},
		fields: {
			login: {
				message: 'Usuario Incorrecto',
			validators: {
				notEmpty: {
					message: "El campo no puede estar vacío",
				},
				stringLength: {
					min: 4,
					max: 20,
					message: 'El usuario debe contener de (4) a (20) caracteres'
				},
				regexp: {
					regexp: /^[a-zA-Z0-9_]*$/,
					message: "No se permiten espacios",
				},
				} 
			},
			nombre: {
				message:"Nombre Invalido",
			validators: {
				notEmpty: {
					message: "El campo no puede estar vacío",
				},
				stringLength: {
					min: 2,
					max: 10,
					message: 'El nombre solo debe contener de (2) a (10) caracteres'
				},
				regexp: {
					regexp: /[a-zA-Z\s]+$/,
					message: "No se permiten numeros, ni caracteres especiales",
				},
				} 
			},
			cedula: {
				message:"Cédula Invalida",
			validators: {
				notEmpty: {
					message: "El campo no puede estar vacío",
				},
				stringLength: {
					min: 2,
					max: 10,
					message: 'La cédula solo debe contener de (8) caracteres sin puntos ni comas'
				},
				regexp: {
					regexp: /^[0-9]*$/,
					message: "No se permiten letras ni caracteres especiales",
				},
				} 
			},
			apellido: {
				message:"Apellido Invalido",
			validators: {
				notEmpty: {
					message: "El campo no puede estar vacío",
				},
				stringLength: {
					min: 2,
					max: 10,
					message: 'El apellido solo debe contener de (3) a (10) caracteres'
				},
				regexp: {
					regexp: /[a-zA-Z\s]+$/,
					message: "No se permiten numeros, ni caracteres especiales",
				},
				} 
			},
			email: {
				message: "Email Incorrecto",
				validators: {
					notEmpty: {
						message: "El email no puede ir vacío",
					},
					emailAddress: {
						message: "El email no es válido"
					},
				}
			},
		 }
	});



//Butonizar el boton submit y asignamos el evento click      
       $('.cambiarclave').click(function(e){//Evento click
       e.preventDefault();
       /**
       Mediante la funcion serialize() de JQuery
       recolectamos los valores del formulario
       */
       var formdata=$('#formulario_cambioclave').serialize();
        var p=$('#passwd2').val();
	var rep=$('#repasswd').val();
	if(p=='')
	{       $('#msg_clave').addClass('alert');
		$('#msg_clave').addClass('alert-danger');
        	$('#msg_clave').html("los campos no pueden estar vacios");
		$('#passwd2').parent().addClass('has-error');
		$('#repasswd').parent().addClass('has-error');
        	$('#msg').fadeIn().delay(1000).fadeOut();
	}else
	if(p==rep){
		
       //Capturamos el atributo action del formulario
       /**var url=$('#formulario_cambioclave').attr('action');
        alert(url);
       
       Hacemos un request asincrono
       utilizando la funcion post()
       de JQuery y pasamos como parametros
       el url y los datos del formulario
       */
       $.post("cambioclave.php", formdata, function(data){
        //mostrar mensaje
	$('#msg_clave').addClass('alert');
	$('#msg_clave').removeClass('alert-danger');
	$('#msg_clave').addClass('alert-info');
        $('#msg_clave').html(data);
         
        //Lo mostramos por unos 10 segundos y lo desaparecemos
        $('#msg_clave').fadeIn().delay(1000).fadeOut();
       });  

	}else
	{       $('#msg_clave').addClass('alert-danger');
		$('#passwd2').parent().addClass('has-error');
		$('#repasswd').parent().addClass('has-error');
		$('#msg_clave').html('Claves no son iguales');
        	$('#msg_clave').fadeIn().delay(1500).fadeOut();
		//console.log(rep);console.log(p);
		
	}
       //Evitamos que el boton siga su curso normal
       return false;
      });
       

$("ul.nav > li a.articulo").click(function(e){
	e.preventDefault();
	$('#content').load('articulos/index.php');
	$('.active').removeClass('active');
	$(this).parent().addClass('active');
	
}); 


$("ul.nav > li a.cliente").click(function(e){
	e.preventDefault();
	$('#content').load('clientes/index.php');
	$('.active').removeClass('active');
	$(this).parent().addClass('active');
	
});

$("ul.nav > li a.orden").click(function(e){
	e.preventDefault();
	$('#content').load('ordens/index.php');
	$('.active').removeClass('active');
	$(this).parent().addClass('active');
	
});


$("ul.nav > li a.usuario").click(function(e){
	e.preventDefault();
	$('#content').load('empleados/index.php');
	$('.active').removeClass('active');
	$(this).parent().addClass('active');
	
});

$("ul.nav > li a.confi").click(function(e){
	e.preventDefault();
	$('#content').load('configuracion/index.php');
	$('.active').removeClass('active');
	$(this).parent().addClass('active');
	
});

$("ul.nav > li a.confi-empresa").click(function(e){
	e.preventDefault();
	$('#content').load('configuracion/sololistar.php');
	$('.active').removeClass('active');
	$(this).parent().addClass('active');
	
});

$("ul.nav > li a.empresa").click(function(e){
	e.preventDefault();
	$('#content').load('empresas/index.php');
	$('.active').removeClass('active');
	$(this).parent().addClass('active');
	
});

$("ul.nav > li a.clausula").click(function(e){
	e.preventDefault();
	$('#content').load('clausulas/index.php');
	$('.active').removeClass('active');
	$(this).parent().addClass('active');
	
});

});

function mensaje_exito()
{
 
 var hijo=$('#exito');

 hijo.remove();
};

function mensaje_error()
{
 var hijo=$('#error');

 hijo.remove();
 
};

function cerrar_ventana(id_cargar){
         $(id_cargar).remove();

};

