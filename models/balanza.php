<?php
class Balanza extends AppModel {
	var $name = 'Balanza';
        var $useTable = 'balanzas';
	var $primaryKey = 'id_balanza';
	var $displayField = 'codigo';
        var $belongsTo =array('Usuario'=> array(
'className' => 'Usuario',
            'fields'=>'id_usuario,fullname,id_empresa',
'foreignKey' => 'id_usuario'
));
	/*var $validate = array(
		'codigo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);*/
}

