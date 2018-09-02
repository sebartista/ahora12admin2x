<?php
App::uses('Provincia', 'Model');

/**
 * Provincia Test Case
 */
class ProvinciaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.provincia',
		'app.ciudade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Provincia = ClassRegistry::init('Provincia');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Provincia);

		parent::tearDown();
	}

}
