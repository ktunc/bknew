<?php
App::uses('Sehir', 'Model');

/**
 * Sehir Test Case
 */
class SehirTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sehir',
		'app.ilce',
		'app.semt',
		'app.mahalle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sehir = ClassRegistry::init('Sehir');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sehir);

		parent::tearDown();
	}

}
