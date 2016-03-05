<?php
class OrdenServicio extends AppModel {
	var $name = 'OrdenServicio';
        var $useTable = 'orden_servicios';
	var $primaryKey = 'id_orden';
	//var $displayField = 'recepcion';
        var $belongsTo =array('Empresa'=> array(
            'className' => 'Empresa',
            'foreignKey' => 'id_empresa'
            ),
            'Cliente'=> array(
                'className' => 'Cliente',
                'foreignKey' => 'id_cliente'
            ));
       /* var $hasOne =array('UsuarioOrden'=> array(
            'className' => 'UsuarioOrden',
            'coditions'=>array('UsuarioOrden.status'=>'1'),
            'foreignKey' => 'id_orden'
            ));*/
        var $hasMany =array('OrdenArticulo'=> array(
                    'className' => 'OrdenArticulo',
                    'foreignKey' => 'id_orden'
            ),
            'CodbarraArticulo'=> array(
                    'className' => 'CodbarraArticulo',
                'conditions' => array('CodbarraArticulo.status' => '1'),
                    'foreignKey' => 'id_orden'
            )
            );
	var $validate = array(
		'peso_libras' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),'recepcion' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)),
                 'precio_orden' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)),
            'cantidad_piezas' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' =>'Campo Obligatorio',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)),
		'id_empresa' => array(
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
				'message' => 'Deben ser letras y Números',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);
}

