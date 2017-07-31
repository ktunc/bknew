<?php
App::uses('Mahalle', 'Model');

/**
 * Mahalle Test Case
 */
class MahalleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mahalle',
		'app.semt'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mahalle = ClassRegistry::init('Mahalle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mahalle);

		parent::tearDown();
	}

}
