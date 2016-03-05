
  <!-- configuration panel -->
<div id="config" class="panel panel-default windows">
  <div class="panel-heading">
  <i class="fa fa-cog"></i> Configuración
     <a data-target="#config" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#config" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    <!-- content -->
      <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
          <li role="presentation"><a href="#pantalla" aria-controls="pantalla" role="tab" data-toggle="tab">Pantalla</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="general">
            <!-- generales -->
            <div class="col-md-3">
              <div class="panel panel-info">
               <span class="title-window-panel">
                 <i class="fa fa-clock-o"></i> Horas / Minutos / Segundos
               </span>
                <div class="panel-body">
                 <input class="knob h" >
                 <input class="knob m" >
                 <input class="knob s" >
               </div>
              </div>
            </div>
            <!-- /generales -->
            <!-- perfil -->
            <div class="col-md-9">
              <div class="panel panel-info">
                <span class="title-window-panel"> 
                  <i class="fa fa-database"></i> Estadisticas del Software
                </span>
                <div class="panel-body">
                    <!-- Charts -->
<div class="col-md-12">
      <div class="progress">
        <div class="one primary-color"></div><div class="two primary-color"></div><div class="three no-color"></div>
        <div class="progress-bar" style="width: 70%;"></div>
    </div>
        <hr />
    <div class="progress">
        <div class="one success-color"></div><div class="two success-color"></div><div class="three success-color"></div>
        <div class="progress-bar progress-bar-success" style="width: 100%"></div>
    </div>
        <hr />
    <div class="progress">
        <div class="one danger-color"></div><div class="two no-color"></div><div class="three no-color"></div>
        <div class="progress-bar progress-bar-danger" style="width: 30%"></div>
    </div>
        <hr />
    <div class="progress">
        <div class="one warning-color"></div><div class="two warning-color"></div><div class="three no-color"></div>
        <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
    </div>
        <hr />
    <div class="progress">
        <div class="one info-color"></div><div class="two no-color"></div><div class="three no-color"></div>
        <div class="progress-bar progress-bar-info" style="width: 35%"></div>
    </div>
  </div>
                    <!-- /Charts -->
                </div>
              </div>
            </div>
            <!-- /perfil -->

          </div>
          <div role="tabpanel" class="tab-pane" id="pantalla">
           <!-- fondo de pantalla -->        
           <div class="panel panel-default">
                <span class="title-window-panel"> 
                  <i class="fa fa-database"></i> Fondo de pantalla
                </span>
             <div class="panel-body wallpapers">
               <!-- imagenes -->
                 <a data-id="1" href="#"><?= $this->Html->image('wallpapers/wall-1.jpg', ['width' => '200'])?></a>
                 <a data-id="2" href="#"><?= $this->Html->image('wallpapers/wall-2.jpg', ['width' => '200'])?></a>
                 <a data-id="3" href="#"><?= $this->Html->image('wallpapers/wall-3.jpg', ['width' => '200'])?></a>
                 <a data-id="4" href="#"><?= $this->Html->image('wallpapers/wall-4.jpg', ['width' => '200'])?></a>
               <!-- /imagenes -->
             </div>
           </div>
           <!-- fondo de pantalla -->
          </div>
        </div>
      </div>    
    <!-- /content -->
  </div>
</div>
  <!-- /configuration panel -->





<!-- panel -->
<div id="client" class="panel panel-default windows">
  <div class="panel-heading">
         <i class="fa fa-user-plus"></i> Altas de Usuarios
     <a data-target="#client" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#client" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    <!-- table -->
      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr >
            <th class="text-center">
              #
            </th>
            <th class="text-center">
              Nombre
            </th>
            <th class="text-center">
              Correo Electronico
            </th>
            <th class="text-center">
              Numero de Celular / Movil
            </th>
          </tr>
        </thead>
        <tbody>
          <tr id='addr0'>
            <td>
            1
            </td>
            <td>
            <input type="text" name='name0'  placeholder='Name' class="form-control"/>
            </td>
            <td>
            <input type="text" name='mail0' placeholder='Mail' class="form-control"/>
            </td>
            <td>
            <input type="text" name='mobile0' placeholder='Mobile' class="form-control"/>
            </td>
          </tr>
                    <tr id='addr1'></tr>
        </tbody>
      </table>
  <a id="add_row" class="btn btn-default pull-left">Add Row</a><a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
</div>
    <!-- /table -->
  </div>

<!-- panel -->
<div id="cliente" class="panel panel-default windows">
  <div class="panel-heading">
         <i class="fa fa-user-plus"></i> Clientes
     <a data-target="#cliente" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#cliente" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>

<div id="clienteadd" class="panel panel-default windows">
  <div class="panel-heading">
         <i class="fa fa-user-plus"></i> Nuevo Cliente
     <a data-target="#clienteadd" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#clienteadd" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>

<!-- panel -->
<div id="vercliente" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Cliente                <i class="info"></i>
     <a data-target="#vercliente" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#vercliente" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>
<!-- panel -->
<div id="buscarorden" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Buscar Ordenes de Servicio                <i class="info"></i>
     <a data-target="#buscarorden" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#buscarorden" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>

<!-- panel -->
<div id="verdelivery" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Asignar Delivery                <i class="info"></i>
     <a data-target="#verdelivery" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#verdelivery" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>

<!-- panel -->
<div id="deliverydatos" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Datos  Orden de Servicio              <i class="info"></i>
     <a data-target="#deliverydatos" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#deliverydatos" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>


<!-- panel -->
<div id="recibeorden" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Recibir Ordenes de Servicio                <i class="info"></i>
     <a data-target="#recibeorden" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#recibeorden" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>


<!-- panel -->
<div id="ordenarticulo" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Verificar Artculos               <i class="info"></i>
     <a data-target="#ordenarticulo" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#ordenarticulo" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>


<!-- panel -->
<div id="verificarorden" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Verificar Ordenes           <i class="info"></i>
     <a data-target="#verificarorden" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#verificarorden" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>

<!-- panel -->
<div id="verificararti" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Artículos Ordenes           <i class="info"></i>
     <a data-target="#verificararti" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#verificararti" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>


<!-- panel -->
<div id="pendientepago" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Ordenes Pendiente por Pagar             <i class="info"></i>
     <a data-target="#pendientepago" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#pendientepago" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>



<!-- panel -->
<div id="pendientepagop" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Cancelar Orden de Servicio  <i class="info"></i>
     <a data-target="#pendientepagop" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#pendientepagop" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>


<!-- panel -->
<div id="ordencancelar" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Ordenes Canceladas     <i class="info"></i>
     <a data-target="#ordencancelar" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#ordencancelar" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>


<!-- panel -->
<div id="ordencancelarv" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Datos Ordenes     <i class="info"></i>
     <a data-target="#ordencancelarv" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#ordencancelarv" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>


<!-- panel -->
<div id="empleados" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Administrar Empleados             <i class="info"></i>
     <a data-target="#empleados" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#empleados" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>

<!-- panel -->
<div id="usuarioadd" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Registro Empleado            <i class="info"></i>
     <a data-target="#usuarioadd" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#usuarioadd" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>

<!-- panel -->
<div id="verusuario" class="panel panel-default windows">
  <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Datos Empleado            <i class="info"></i>
     <a data-target="#verusuario" class="close-window"><i class="fa fa-times pull-right"></i></a>
     <a data-target="#verusuario" class="minimize-window"><i class="fa fa-chevron-down pull-right"></i></a>
  </div>
  <div class="panel-body">
    </div>
    <!-- /table -->
  </div>

