<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo $title_for_layout;  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<?php
echo $this->Html->meta('favicon.ico','img/soloplancho.png',array('type' => 'icon'));
echo $this->Html->css('bootstrap.min');
echo $this->Html->css('bootstrap-switch.min');
echo $this->Html->css('jquery-ui');
//echo $this->Html->css('dataTables.bootstrap.min');
echo $this->Html->css('bootstrapValidator.min');

echo $this->Html->css('font-awesome.min.css');
echo $this->Html->css('animate.css');
echo $this->Html->css('responsive.css');
echo $this->Html->css('style');

echo $javascript->link('jquery.min')."\n";
echo $javascript->link('jquery-ui.min')."\n";
echo $javascript->link('bootstrap.min')."\n";
//echo $javascript->link('dataTables.bootstrap.min')."\n";
echo $javascript->link('bootstrap-switch.min')."\n";
echo $javascript->link('jquery.knob.min')."\n";
echo $javascript->link('qrcodelib')."\n";
echo $javascript->link('WebCodeCam')."\n";
//echo $javascript->link('main')."\n";

echo $javascript->link('moment')."\n";
echo $javascript->link('chart.min')."\n";
echo $javascript->link('bootstrapValidator.min')."\n";


echo $javascript->link('functions')."\n";

		echo $scripts_for_layout;
?>
<script async defer
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBGHoFXvXLG_Pzwu9EjrQXhuN-y3mwz140&signed_in=true" type="text/javascript">
  
    </script>
</head>

 <body class="wall-3">

<!-- menu -->
<nav class="navbar navbar-default"> 
   
   <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
     <ul  class="nav navbar-nav col-xs-2">
            <li ><a class="brand"><?= $this->Html->image('ico_soloplancho.png', ['width'=>'40px','style'=>'padding:0px,margin:0px','class' => 'img-responsive img-rounded'])?></a></li>
        	    
            <li class="brand"><h4><strong>SoloPlancho</strong></h4></li>
                   
      </ul>
     <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Aplicaciones <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="" class="appcliente">Clientes</a></li>
            <li class="divider"></li>
            <li><a href="" class="apporden">Ordenes</a></li>
            <li class="divider"></li>
            <li><a href="" class="appusuario">Empleados</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        	          <!-- usuario -->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">   <i class="fa fa-user"></i>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#miperfil" class="perfil">Mi Perfil</a></li>
            <li class="divider"></li>
            <li><a href="#modal_cambioclave" class="cambioclave">Cambio de Clave</a></li>
          </ul>
        </li>
        <!-- usuario -->

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="fa fa-power-off"></i>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="Entradas/cerrar">Salir</a></li>
            <li class="divider"></li>
          </ul>
        </li>
      </ul>

      <ul  class="nav navbar-nav navbar-right">    
        	    <li><a class="navorden" href="">Nueva Orden<span class="badge pink"></span></a></li>
                     <li><a class="navordenc" href="">Ordenes Canceladas<span class="badge yellow"></span></a></li>

          <li><a class="clock"></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- menu -->
    <?php echo $this->Session->flash(); ?>
    <section id="container-apps" class="container">
<!-- apps -->
   <div class="col-md-2 app">
       <i data-parent="1"  class="fa fa-users fa-5x"><p>Clientes
       </p></i>
       
   </div>

   <div class="col-md-2 app">
       <i data-parent="4"  class="fa fa-search fa-5x"></i>
       <p>Busqueda Ordenes</p>
   </div>

  <div class="col-md-2 app">
       <i data-parent="2"  class="fa fa-bicycle fa-5x"></i>
       <p>Delivery</p>
   </div>

<div class="col-md-2 app" >
       <i data-parent="3" class="fa fa-wrench fa-5x"></i>
       <p>Recibir Ordenes</p>
   </div>  

 <div class="col-md-2 app" >
       <i data-parent="8" class="fa fa-gears fa-5x"></i>
       <p>Verificar Ordenes</p>
   </div>

   <div class="col-md-2 app" >
       <i data-parent="6" class="fa fa-pencil fa-5x"></i>
       <p>Ordenes Pendiente Pago</p>
   </div>

   <div class="col-md-2 app">
       <i data-parent="5"  class="fa fa-money fa-5x"></i>
       <p>Ordenes Canceladas</p>
   </div>          

   <div class="col-md-2 app" >
       <i data-parent="7" class="fa fa-cog fa-5x"></i>
       <p>Config</p>
   </div>


<div class="col-md-2 app" >
       <i data-parent="9" class="fa fa-user fa-5x"></i>
       <p>Empleados</p>
   </div>

<div class="col-md-2 app" >
       <i data-parent="9" class="fa fa-file-pdf-o fa-5x"></i>
       <p>Reportes</p>
   </div>
<!-- /apps -->
<div id="content-windows">	
			<?php echo $content_for_layout; ?>
    </div>
    </section><div id="mini_loading" style=" display: none;"> </div>
    <footer>
<!-- bottom bar -->
<nav class="navbar navbar-default navbar-fixed-bottom">
  <div class="container" id="app-active">
      
      
  </div>
</nav>
<!-- /bottom bat -->
    </footer>
 <div id="miperfil" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Mis Datos Personales</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
    </div>
    
<div id="modal_cambioclave" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cambio de Clave</h4>
      </div>
      <div class="modal-body">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
</body> 
</html>
      <script type="text/javascript">
        //<![CDATA[
        
    function getbadge(){
       $.getJSON("Clientes/mostrarbadge", null, function(data){
		console.log(data);
		$(".navcliente .badge").html(data.cliente);
                if(data.cliente > 0){
			//$('<audio id="audio_cl"><source src="sonidos/glass.ogg" type="audio/ogg">, <source src="sonidos/glass.mp3" type="audio/mpeg"></audio>').appendTo("body");
			//$('#audio_cl')[0].play();
		}
		$(".navorden .badge").html(data.ordens);
		if(data.ordens > 0){
			$('<audio id="audio_fb"><source src="sonidos/button_tiny.ogg" type="audio/ogg">, <source src="sonidos/button_tiny.mp3" type="audio/mpeg"></audio>').appendTo("body");
			$('#audio_fb')[0].play();
		}
                $(".navordenc .badge").html(data.ordenc);
		if(data.ordenc > 0){
			$('<audio id="audio_fb"><source src="sonidos/button_tiny.ogg" type="audio/ogg">, <source src="sonidos/button_tiny.mp3" type="audio/mpeg"></audio>').appendTo("body");
			$('#audio_fb')[0].play();
                        
		}
        });
        $('#audio_fb').remove();
        $('#audio_cl').remove();
        $('#audio_fb').remove()
    }
    getbadge();
    setInterval(getbadge, 20000);
    
$(".navcliente").on( "click", function(event) {
event.preventDefault();
$.getJSON("Clientes/mostrarbadge", null, function(data){
    
    if(data.cliente > 0){
        $("#mini_loading").show();
        $("#cliente").removeClass("animated zoomOut");
        $("#cliente").fadeIn(500); 
        $.ajax({
                url: 'Clientes/vista_clientes_nuevos/',
                data: {"data": '1'},
                type: 'post'
        }).done(function(data) {
               $("#mini_loading").hide();
               $("#cliente .panel-body").html(data);
        }).error(function(data){ $("#mini_loading").hide();});
    }
    });
});

$(".navordenc").on( "click", function(event) {
    event.preventDefault();
    $.getJSON("Clientes/mostrarbadge", null, function(data){
        
        if(data.ordenc > 0){
            $("#mini_loading").show();
            $("#ordencancelar").removeClass("animated zoomOut");
            $("#ordencancelar").fadeIn(500); 
            $("#ordencancelar .panel-body").show();
            $.ajax({
                url: 'Ordenes/ordenes_canceladas/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#ordencancelar .panel-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
        }
      });  
});

$(".navorden").on( "click", function(event) {
    event.preventDefault();
    $.getJSON("Clientes/mostrarbadge", null, function(data){
        
        if(data.ordens > 0){
            $("#mini_loading").show();
            $("#verdelivery").removeClass("animated zoomOut");
            $("#verdelivery").fadeIn(500); 
            $("#verdelivery .panel-body").show();
            $.ajax({
                url: 'Ordenes/asignar_delivery_nuevo/',
                data: {"data": '1'},
                type: 'post'
            }).done(function(data) {
               $("#mini_loading").hide();
               $("#verdelivery .panel-body").html(data);
            }).error(function(data){ $("#mini_loading").hide();});
        }
      });  
});
//]]>
</script>

