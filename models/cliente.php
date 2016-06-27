<?php
class Cliente extends AppModel {
	var $name = 'Cliente';
        var $useTable = 'clientes';
	var $primaryKey = 'reg_id';
	var $displayField = 'fullname';
      /*  var $belongsTo =array('Balanza'=> array(
'className' => 'Balanza',
'foreignKey' => 'id_balanza'
));*/
        var $hasOne =array('DireccionCliente'=> array(
'className' => 'DireccionCliente',
'foreignKey' => 'id_cliente'
));
	var $validate = array(
		'cedula' => array(  'isUnique' => array(
            'rule' => 'isUnique',
            'message' => 'El Cédula Existe',
            'on' => 'create'
        ),
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
		),'fullname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)),
                'sexo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)),
                'movil' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)),
                 'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			)),
                    'email' => array(
                        'isUnique' => array(
                        'rule' => 'isUnique',
                        'message' => 'El correo Existe',
                        'on' => 'create'
                        ),
                        'email' => array(
                            //'rule' => array('email', true),//boolean true as second parameter verifies that the host for the address is valid -- to be uncommented once website is uploaded
                            'rule' => array('email'),
                            'message' => 'Correo Invalido'
                        ),
                        'notEmpty' => array(
                            'rule' => 'notEmpty',
                            'message' => 'Correo Obligatorio'
                        )
                    )
	);
}

