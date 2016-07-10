<div class="panel panel-info">
  <div id="aqui2" class="row">
    <div class="col-xs-8">
        <div class="input-group input-group-lg">
            <?php echo $form->create('entrada', array('action' => 'recuperarclave','role'=>'login'));?>
            <span class="input-group-addon">	  		
                <span class="glyphicon glyphicon-envelope"></span>
            </span>
            <?php echo $form->input('recuperarclave',array('label'=>false,'div'=>false,'id'=>"recuperarclave",'placeholder'=>"Correo Existente",'class'=>"form-control"));?>
            <span class="input-group-btn">
                 <?php echo $form->submit(__('Entrar', true),array('class'=>"btn btn-defaul"));?>
            </span>
             <?php echo $form->end(); ?> 
        </div>
    </div> 
 </div>     
</div>
                      