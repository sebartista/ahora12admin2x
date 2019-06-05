<?php 
class AppSchema extends CakeSchema {

	public $file = 'schema_1.php';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $ciudades = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'provincia_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $comercios = array(
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

	public $provincias = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $rubro_comercios = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'comercio_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'rubro_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $rubros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'programa' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $tarjetas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50),
		'password' => array('type' => 'string', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'tipo_usuario' => array('type' => 'decimal', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

}
