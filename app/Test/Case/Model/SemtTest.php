<?php
App::uses('Semt', 'Model');

/**
 * Semt Test Case
 */
class SemtTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.semt',
		'app.ilce',
		'app.mahalle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Semt = ClassRegistry::init('Semt');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Semt);

		parent::tearDown();
	}

}
