<?php
App::uses('IlanLocation', 'Model');

/**
 * IlanLocation Test Case
 */
class IlanLocationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ilan_location',
		'app.ilan',
		'app.user',
		'app.danisman',
		'app.ilan_danisman'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->IlanLocation = ClassRegistry::init('IlanLocation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IlanLocation);

		parent::tearDown();
	}

}
