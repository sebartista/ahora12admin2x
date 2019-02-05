<?php
App::uses('Comercio', 'Model');

/**
 * Comercio Test Case
 */
class ComercioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comercio',
		'app.ciudade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comercio = ClassRegistry::init('Comercio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comercio);

		parent::tearDown();
	}
        
        public function testUpdateComerceFromCsv(){
            $result = $this->Comercio->updateComerceFromCsv();
            $expected = false;
            $this->assertEquals($expected, $result);
        }

}
