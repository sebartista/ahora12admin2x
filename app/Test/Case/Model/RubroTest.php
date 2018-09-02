<?php
App::uses('Rubro', 'Model');

/**
 * Rubro Test Case
 */
class RubroTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.rubro'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Rubro = ClassRegistry::init('Rubro');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rubro);

		parent::tearDown();
	}

}
