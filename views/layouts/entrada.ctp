<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo $title_for_layout;  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<?php
echo $this->Html->meta('favicon');
echo $this->Html->css('justified-nav');
echo $this->Html->css('bootstrap');
echo $this->Html->css('styles');

echo $javascript->link('jquery.min')."\n";
echo $javascript->link('bootstrap.min')."\n";
echo $javascript->link('bootstrapValidator.min')."\n";
echo $javascript->link('functions')."\n";

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container" class="container">

		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
            <div id="footer"> <div class="form-links"><h2>
                        <a href="http://www.soloplancho.com" target='_blank'>
                            www.soloplancho.com</a></h2>
                            </div>
		</div>
	</div>
    <div id="modal_recuperarclave" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Recuperar  Clave</h4>
      </div>
      <div class="modal-body">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
</body>
</html>
