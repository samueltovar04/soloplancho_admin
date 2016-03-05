<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo $title_for_layout;  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<?php
echo $this->Html->meta('favicon');
echo $this->Html->css('bootstrap.min');
echo $this->Html->css('justified-nav');
echo $this->Html->css('font-awesome.min.css');
echo $this->Html->css('animate.css');
echo $this->Html->css('responsive.css');
echo $this->Html->css('style');

echo $javascript->link('jquery.min')."\n";
echo $javascript->link('jquery-ui.min')."\n";
echo $javascript->link('bootstrap.min')."\n";
echo $javascript->link('jquery.knob.min')."\n";
echo $javascript->link('moment')."\n";
echo $javascript->link('chart.min')."\n";
echo $javascript->link('functions')."\n";
echo $javascript->link('bootstrapValidator.min')."\n";

		echo $scripts_for_layout;
?>
</head>

 <body class="wall-3">

<!-- menu -->
<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
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
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">

        <!-- usuario -->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">   <i class="fa fa-user"></i>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
        <!-- usuario -->

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="fa fa-power-off"></i>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>

      <ul  class="nav navbar-nav navbar-right">
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
       <i data-parent="1"  class="fa fa-users fa-5x"></i>
       <p>Clientes</p>
   </div>

  <div class="col-md-2 app">
       <i data-parent="2"  class="fa fa-bicycle fa-5x"></i>
       <p>Delivery</p>
   </div>

   <div class="col-md-2 app">
       <i data-parent="3"  class="fa fa-search fa-5x"></i>
       <p>Busqueda Ordenes</p>
   </div>

   <div class="col-md-2 app">
       <i data-parent="4"  class="fa fa-money fa-5x"></i>
       <p>Ordenes Canceladas</p>
   </div>

  <div class="col-md-2 app" >
       <i data-parent="5" class="fa fa-wrench fa-5x"></i>
       <p>Asignar Operador</p>
   </div>  

   <div class="col-md-2 app" >
       <i data-parent="6" class="fa fa-pencil fa-5x"></i>
       <p>Altas</p>
   </div>

               

   <div class="col-md-2 app" >
       <i data-parent="7" class="fa fa-cog fa-5x"></i>
       <p>Config</p>
   </div>
<!-- /apps -->
<div id="content-windows">	
			<?php echo $content_for_layout; ?>
    </div>
    </section>
    <footer>
<!-- bottom bar -->
<nav class="navbar navbar-default navbar-fixed-bottom">
  <div class="container" id="app-active">
      
      
  </div>
</nav>
<!-- /bottom bat -->
    </footer>
</body>
</html>

