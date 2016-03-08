<?php
if(isset($Exito)){echo $cargar->msj_exito($Exito);}
 if(isset($Error)){echo $cargar->msj_error($Error);}
?>      
<div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
        <section class="login-form">
           <?php echo $form->create('entrada', array('action' => 'login','role'=>'login'));?>
           <img src="img/soloplancho.png" class="img-responsive img-rounded" alt="Solo Plancho" width="70" height="66" />
		<fieldset class="boxBody">
	  	    <label>Usuario</label>
		    <div class="input-group input-group-lg">
                        <span class="input-group-addon">	  		
                            <span class="glyphicon glyphicon-envelope"></span>
                        </span>
                      <?php echo $form->input('login',array('label'=>false,'div'=>false,'id'=>"login",'placeholder'=>"Correo",'class'=>"form-control"));?>
			 </div> <div class="input-group input-group-lg">
                        <span class="input-group-addon">	  		
                            <span class="glyphicon glyphicon-lock"></span>
                        </span>
                      <?php echo $form->input('clave',array('label'=>false,'div'=>false,'type'=>'password','id'=>"clave" ,'tabindex'=>"2" ,'placeholder'=>"Contraseña",'class'=>"form-control"));?>

                    </div> 
		</fieldset>
	<div><div class="pwstrength_viewport_progress"></div>
             <a href="#recuperar_clave" class="recuperar_clave">Recuperar Clave</a>
        </div>
	<footer>
             <?php echo $form->submit(__('Entrar', true),array('class'=>"btn btn-lg btn-primary btn-block"));?>
	</footer>
        <?php echo $form->end(); ?> 
       
    </section>  
   </div>
     <div class="col-md-4"></div>
</div>