

// Menu 
$(document).ready(function(){
$(".appcliente").on( "click", function(event) {
event.preventDefault();

        $("#mini_loading").show();
        $("#cliente").removeClass("animated zoomOut");
        $("#cliente").fadeIn(500); 
        $.ajax({
                url: 'Clientes/vista_clientes/',
                data: {"data": '1'},
                type: 'post'
        }).done(function(data) {
               $("#mini_loading").hide();
               $("#cliente .panel-body").html(data);
        }).error(function(data){ $("#mini_loading").hide();});

});

$(".apporden").on( "click", function(event) {
event.preventDefault();

        $("#mini_loading").show();
        $("#buscarorden").removeClass("animated zoomOut");
        $("#buscarorden").fadeIn(500); 
        $.ajax({
                url: 'Ordenes/buscar_ordenes/',
                data: {"data": '1'},
                type: 'post'
        }).done(function(data) {
               $("#mini_loading").hide();
               $("#buscarorden .panel-body").html(data);
        }).error(function(data){ $("#mini_loading").hide();});

});


$(".appusuario").on( "click", function(event) {
event.preventDefault();

        $("#mini_loading").show();
        $("#empleados").removeClass("animated zoomOut");
        $("#empleados").fadeIn(500); 
        $.ajax({
                url: 'Usuarios/index/',
                data: {"data": '1'},
                type: 'post'
        }).done(function(data) {
               $("#mini_loading").hide();
               $("#empleados .panel-body").html(data);
        }).error(function(data){ $("#mini_loading").hide();});

});

$(".recuperar_clave").on( "click", function() {
    $('#modal_recuperarclave').modal('show');
     $.ajax({
                url: 'Entradas/recuperarclave/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#modal_recuperarclave .modal-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
});

$(".cambioclave").on( "click", function() {
    $('#modal_cambioclave').modal('show');
     $.ajax({
                url: 'Usuarios/cambio_clave/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#modal_cambioclave .modal-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
});

$(".perfil").on( "click", function() {
    $('#miperfil').modal('show');
       $.ajax({
                url: 'Usuarios/miperfil/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#miperfil .modal-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
});

 $(".col-md-2 i").on( "click", function() {
  var target = $(this).attr("data-parent"); 
  if (target == 1){
    
     $("#mini_loading").show();

     $("#cliente").removeClass("animated zoomOut");
     $("#cliente").fadeIn(500); 
     $.ajax({
                url: 'Clientes/vista_clientes/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#cliente .panel-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
  }else
    if (target == 2){
    
     $("#mini_loading").show();

     $("#verdelivery").removeClass("animated zoomOut");
     $("#verdelivery").fadeIn(500); 
     $("#verdelivery .panel-body").show();
     $.ajax({
                url: 'Ordenes/asignar_delivery/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#verdelivery .panel-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
  }else
      if (target == 3){
    
     $("#mini_loading").show();

     $("#recibeorden").removeClass("animated zoomOut");
     $("#recibeorden").fadeIn(500);        
     $.ajax({
                url: 'Ordenes/recibir_ordenes/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#recibeorden .panel-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
  }else
    if (target == 4){
    
     $("#mini_loading").show();

     $("#buscarorden").removeClass("animated zoomOut");
     $("#buscarorden").fadeIn(500);        
     $.ajax({
                url: 'Ordenes/buscar_ordenes/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#buscarorden .panel-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
  }else
  if (target == 7){
     $("#config").removeClass("animated zoomOut");
     $("#config").fadeIn(500);
     $("#mini_loading").hide();
  }
  else if (target == 6){
     $("#pendientepago").removeClass("animated zoomOut");
     $("#pendientepago").fadeIn(500);
     $.ajax({
                url: 'Ordenes/pendiente_pagos/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#pendientepago .panel-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
  }else if (target == 8){
     $("#verificarorden").removeClass("animated zoomOut");
     $("#verificarorden").fadeIn(500);
        $.ajax({
                url: 'Ordenes/verificar_ordenes/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#verificarorden .panel-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
  }
  else if (target == 5){
     $("#ordencancelar").removeClass("animated zoomOut");
     $("#ordencancelar").fadeIn(500);
     $.ajax({
        url: 'Ordenes/ordenes_canceladas/',
        data: {"data": '1'},
        type: 'post'
     }).done(function(data) {
        $("#mini_loading").hide();
        $("#ordencancelar .panel-body").html(data);
     }).error(function(data){ $("#mini_loading").hide();});
     
  }else if (target == 9){
     $("#empleados").removeClass("animated zoomOut");
     $("#empleados").fadeIn(500);
      $.ajax({
                url: 'Usuarios/index/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#empleados .panel-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
  }
     else{
   $("#mini_loading").hide();
  }



 });
});
// Fecha
var datetime = null,date = null;
var update = function () {
    date = moment(new Date())
    datetime.html(date.format('h:mm:ss a'));
};

$(document).ready(function(){
    datetime = $('.clock')
    update();
    setInterval(update, 1000);
});


$(document).ready(function(){
   
$("a.minimize-window").on( "click", function() {
  var target = $(this).attr("data-target");
  var title = $(target).find(".panel-heading").text();
  $(target).addClass("animated zoomOutDown");
  $('<a class="active-window animated flipInY" data-target="'+target+'"><i class="fa fa-cube"></i>'+title+'</a>').appendTo("#app-active");    

$("a.active-window").on( "click", function(event) {
  event.preventDefault();
  var target = $(this).attr("data-target");
    $(target).removeClass("animated zoomOutDown").delay(1000);
    $(target).addClass("animated zoomInUp");
    $(this).removeClass("animated flipInY").delay(1000);
    $(this).addClass('animated flipOutX');
    $(this).hide(1000);
  });
});

$("a.close-window").on( "click", function() {
    
  var target = $(this).attr("data-target");
    $(target).addClass("animated zoomOut");
    if(target!=='#config'){
     $(target).find('.panel-body').children().remove();
    }
    $(target).hide(1000);
   
});

$(".wallpapers a").on( "click", function() {
  var target = $(this).attr("data-id");
  var bodytag = $("body");
  var bodywall = bodytag.attr('class');
    
    if (target == 1){
      bodytag.removeClass(bodywall);
      bodytag.addClass("wall-1");


    }else if (target == 2){
      bodytag.removeClass(bodywall);
      bodytag.addClass("wall-2");


    }else if (target == 3){
      bodytag.removeClass(bodywall);
      bodytag.addClass("wall-3");


    }else if (target == 4){
      bodytag.removeClass(bodywall);
      bodytag.addClass("wall-4");


    }else{
      return;
    }

});


//////////////////////
/* Knob Value Data */
////////////////////
var d = new Date(),
    s = d.getSeconds(),
    m = d.getMinutes(),
    h = d.getHours();

$('.h').data('targetValue', h);
$('.m').data('targetValue', m);
$('.s').data('targetValue', s);
//basic setup
$('.knob').knob({
    value: 0,
        'readOnly': true,
        'width': 100,
        'height': 100,
        'dynamicDraw': true,
        'thickness': 0.2,
        'tickColorizeValues': true,
        'skin': 'tron'
});
$.when(
$('.knob').animate({
    value: 100
}, {
    duration: 1800,
    easing: 'swing',
    progress: function () {
    $(this).val(Math.round(this.value/100*$(this).data('targetValue'))).trigger('change')
    }
})
).then(function () {
    myDelay();
});

function myDelay() {
    var d = new Date(),
        s = d.getSeconds(),
        m = d.getMinutes(),
        h = d.getHours();
    $('.h').val(h).trigger("change");
    $('.m').val(m).trigger("change");
    $('.s').val(s).trigger("change");
    setTimeout(myDelay, 1000)
}



$(".panel-heading").on( "click", function(e) {
     $(this).parent().draggable();
});


$(".panel-heading").mouseup(function() {
    $(this).parent().draggable();
  })
  .mousedown(function() {
    $(this).parent().draggable();
  });



$("#formcodbarra").bootstrapValidator({
		message: "Error en los campos",
		fields: {
			formcodbarra: {
				message: 'Usuario Incorrecto',
			validators: {
				notEmpty: {
					message: "El campo no puede estar vacío",
					},
				stringLength: {
					min: 4,
					max: 10,
					message: 'El campo debe contener de (4) a (10) caracteres'
					},
				regexp: {
					regexp: /^[0-9]*$/,
					message: "No se permiten espacios",
					},
				      } 
				}
			}
});


});

$(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='mail"+i+"' type='text' placeholder='Mail'  class='form-control input-md'></td><td><input  name='mobile"+i+"' type='text' placeholder='Mobile'  class='form-control input-md'></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
         if(i>1){
         $("#addr"+(i-1)).html('');
         i--;
         }
     });
  


});


        
    function cantidad(valor){
            var cant = 0;$("#cantidadorden").val();
            var v;
            cant = parseInt($("#cantidadorden").val());
            v=parseInt(valor);
            
            $("#cantidadorden").val(cant+v);
             console.log(cant+" "+v);
        }


  function mensaje_exito()
{
 
 var hijo=$('#exito');

 hijo.remove();
}

function mensaje_error()
{
 var hijo=$('#error');

 hijo.remove();
 
}

function cerrar_ventana(id_cargar){
         $(id_cargar).remove();

}
function vacio_buscar(k)
{
	if(k == null || k.length == 0 || /^\s+$/.test(k)) return 0;
	else return k;

}

function vacio_buscar_via(k)
{
	if(k == null || k.length == 0 || /^\s+$/.test(k)) return k;
	else return k;

}

function letras_sin(letra) { 
    tecla = (document.all) ? letra.keyCode : letra.which; 
    if (tecla==0 || tecla==8) return true; 
    patron =/[A-Za-z@]/;
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
}

function letras_con(letra) { 
    tecla = (document.all) ? letra.keyCode : letra.which; 
    if (tecla==0 || tecla==8) return true; 
    patron =/[A-Za-z@ .]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
}


function letras(letra) { 
    tecla = (document.all) ? letra.keyCode : letra.which;
    if (tecla==0 || tecla==8) return true; 
    patron =/[A-Za-z0-9 @]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
}

function letras_guion(letra) { 
    tecla = (document.all) ? letra.keyCode : letra.which; 
    if (tecla==0 || tecla==8) return true; 
        patron =/[A-Za-z0-9 @\-]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
}
function costo2(peso){
    var costo = document.getElementById('costo').value;
   
    document.getElementById('precio_orden').value=(costo*peso);
}

function numeros_punto(numero) { 
    tecla = (document.all) ? numero.keyCode : numero.which; 
   if (tecla==0 || tecla==8) return true; 
   
    patron = /[0-9\.]/;
    
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}

function numeros(numero) { 
    tecla = (document.all) ? numero.keyCode : numero.which; 
   if (tecla==0 || tecla==8) return true; 
   
    patron = /\d/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}


function muestraReloj() {
   fechaHora = new Date();
   horas = fechaHora.getHours();
   minutos = fechaHora.getMinutes();
   segundos = fechaHora.getSeconds();
 
  if(horas < 10) {horas = '0' + horas;}
  if(minutos < 10) {minutos = '0' + minutos;}
  if(segundos < 10) {segundos = '0' + segundos;}
 
  document.getElementById("reloj").innerHTML = horas+':'+minutos+':'+segundos;
 
}

function modificar_boxes(id,cantidad){
    var chequear;
    if(id.checked){
        chequear=true;
        
    }else
        chequear=false;
    
    for (i=0; i <= cantidad ; i++ ){
        if (chequear){
            document.getElementById('chk'+i).checked = true; 
        }else{
            document.getElementById('chk'+i).checked = false; 
        } 
    }
}

function chequear_todos(id,cantidad,nombre){
    var chequear;
    if(id.checked){
        chequear=true;
        
    }else
        chequear=false;
    
    for (i=0; i <= cantidad ; i++ ){
        if (chequear){
            if(document.getElementById(nombre+i).disabled!==true)
            document.getElementById(nombre+i).checked = true; 
        }else{
            if(document.getElementById(nombre+i).disabled!==true)
            document.getElementById(nombre+i).checked = false; 
        } 
    }
}

function coloca_guion(obj,letra){
    var tam;
    tam=obj.value.length;
   tecla = (document.all) ? letra.keyCode : letra.which;
   if(tam==2 && tecla==8){
       obj.value=obj.value;
   }else if(tam==2 && tecla!=8){
        obj.value=obj.value+'-';
        
    }
}





