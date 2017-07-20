<?php
App::uses('Danisman', 'Model');

/**
 * Danisman Test Case
 */
class DanismanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.danisman',
		'app.ilan',
		'app.user',
		'app.ilan_danisman'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Danisman = ClassRegistry::init('Danisman');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Danisman);

		parent::tearDown();
	}

}
