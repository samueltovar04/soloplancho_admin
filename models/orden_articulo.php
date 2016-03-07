<?php
class OrdenArticulo extends AppModel {
	var $name = 'OrdenArticulo';
        var $useTable = 'orden_articulos';
	var $primaryKey = '';
	//var $displayField = 'recepcion';
        var $belongsTo =array('Articulo'=> array(
'className' => 'Articulo',
'foreignKey' => 'id_articulo'
));

}

