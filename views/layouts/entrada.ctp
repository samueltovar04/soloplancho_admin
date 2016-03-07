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
echo $javascript->link('funciones')."\n";

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container" class="container">

		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer"> <div class="form-links">
			<?php echo $this->Html->link(
					__('www.soloplancho.com'),
					'https://sites.google.com/site/soloplanchocolombia/precios',
					array('target' => '_blank', 'escape' => false)
				);
			?>
                            </div>
		</div>
	</div>
</body>
</html>
