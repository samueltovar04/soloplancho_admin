<?php
class CodbarraArticulo extends AppModel {
	var $name = 'CodbarraArticulo';
        var $useTable = 'codbarra_articulos';
	var $primaryKey = '';
	//var $displayField = 'recepcion';
        var $belongsTo =array('Articulo'=> array(
'className' => 'Articulo',
'foreignKey' => 'id_articulo'
));

}

