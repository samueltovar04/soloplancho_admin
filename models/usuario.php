<?php


class Usuario extends AppModel {
	var $name = 'Usuario';
        var $useTable = 'usuarios';
	var $primaryKey = 'id_usuario';
	var $displayField = 'fullname';
        var $belongsTo =array('Empresa'=> array(
                        'className' => 'Empresa',
                        'foreignKey' => 'id_empresa'
                        ));
        var $hasMany =array('UsuarioOrden'=> array(
                    'className' => 'UsuarioOrden',
                    'foreignKey' => 'id_usuario'
            )
            );
	var $validate = array(
		'cedula' => array(
                      'isUnique' => array(
            'rule' => 'isUnique',
            'message' => 'La Cédula Existe',
            'on' => 'create',
                          'on' => 'update'
        ),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                         'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo Números'
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)),
            'fullname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)),
            'tipo' => array(
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
             'clave' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			)),
            'movil' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                         'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo Números'
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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
