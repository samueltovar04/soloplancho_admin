<?php
class UsuarioOrden extends AppModel {
	var $name = 'UsuarioOrden';
        var $useTable = 'usuario_ordenes';
	var $primaryKey = '';
	//var $displayField = 'recepcion';
        var $belongsTo =array(
            'Usuario'=> array(
                    'className' => 'Usuario',
                    'foreignKey' => 'id_usuario'
            ),
            'OrdenServicio'=> array(
                    'className' => 'OrdenServicio',
                    'foreignKey' => 'id_orden'
            ),
                );
	var $validate = array(
		'id_usuario' => array(
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
			),
		),
		'id_orden' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'Deben ser letras y Números'
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);
}

