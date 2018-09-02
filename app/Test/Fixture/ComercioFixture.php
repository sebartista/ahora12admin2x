<?php
/**
 * Comercio Fixture
 */
class ComercioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'razonsocial' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200),
		'cuit' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 13),
		'direccion' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200),
		'codigopostal' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20),
		'ciudad_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'sitioweb' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'nombrefantasia' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'activo' => array('type' => 'boolean', 'null' => true, 'default' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'razonsocial' => 'Lorem ipsum dolor sit amet',
			'cuit' => 'Lorem ipsum',
			'direccion' => 'Lorem ipsum dolor sit amet',
			'codigopostal' => 'Lorem ipsum dolor ',
			'ciudad_id' => 1,
			'sitioweb' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'telefono' => 'Lorem ipsum dolor sit amet',
			'created' => '2018-06-30 00:53:56',
			'updated' => '2018-06-30 00:53:56',
			'nombrefantasia' => 'Lorem ipsum dolor sit amet',
			'activo' => 1
		),
	);

}
