<?php
class RechazaClausula extends AppModel {
	var $name = 'RechazaClausula';
        var $useTable = 'rechaza_clausula';
	var $primaryKey = 'id';
	var $displayField = 'comentarios';
	var $validate = array(
		'comentarios' => array(
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
			)),
            'id_cliente' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			))
	);
}

