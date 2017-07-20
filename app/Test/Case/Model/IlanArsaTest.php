<?php
App::uses('IlanArsa', 'Model');

/**
 * IlanArsa Test Case
 */
class IlanArsaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ilan_arsa',
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
		$this->IlanArsa = ClassRegistry::init('IlanArsa');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IlanArsa);

		parent::tearDown();
	}

}
