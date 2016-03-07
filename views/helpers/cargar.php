<?php
class CargarHelper extends AppHelper 
{

        
        function msj_error ($msj) {
	if(!isset($msj) || empty($msj)){
		$msj="&nbsp;";
	}
	$return= '<div id="error" class="alert alert-danger" style="display:block;">'.$msj.'
<div style="float:right; text-align:right; width:55px;">
                        <img id=cierra_ventana onclick="cerrar_ventana(\'#error\')" class="close" title="Cerrar Ventana" src="img/cross.png" style=cursor:pointer;/>
                    </div>     
</div> <script type="text/javascript" language="javascript">
		 window.setTimeout("mensaje_error();",5000);
			  </script>';
	return $return;
}


function msj_exito ($msj) {
	if(!isset($msj) || empty($msj)){
		$msj="&nbsp;";
	}
	$return= '<div id="exito" class="alert alert-info" style="display:block;">'.$msj.'<div style="float:right; text-align:right; width:55px;">
                        <img id=cierra_ventana onclick="cerrar_ventana(\'#exito\')" class="close" title="Cerrar Ventana" src="img/cross.png" style=cursor:pointer;/>
                    </div>
      </div>
                  <script type="text/javascript" language="javascript">
		 window.setTimeout("mensaje_exito();",4000);
                 
			  </script>';
	return $return;
}

	function msj_error2 ($msj) 
	{
			if(!isset($msj) || empty($msj))
			{
					$msj="&nbsp;";
			}
			$return= '<script type="text/javascript" language="javascript">
				// <![CDATA[
					mensajeError("'.$msj.'");
				// ]]>
			  </script>';

			return $return;
}//msj error


function msj_exito2 ($msj) 
{
    if(!isset($msj) || empty($msj))
		{
				$msj="&nbsp;";
		}
		$return= '<script type="text/javascript" language="javascript">
				// <![CDATA[
					mensajeExito("'.$msj.'");
				// ]]>
			  </script>';
		return $return;
}//msj exito

	function ver_fecha($f=null)
	{
		return substr($f,8,2)."-".substr($f,5,2)."-".substr($f,0,4);
	}
	function miles($numero)
	{
		return number_format($numero,2,',','.');
	}
        
}
?>
