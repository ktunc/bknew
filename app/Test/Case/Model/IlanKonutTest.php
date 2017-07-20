<?php
App::uses('IlanKonut', 'Model');

/**
 * IlanKonut Test Case
 */
class IlanKonutTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ilan_konut',
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
		$this->IlanKonut = ClassRegistry::init('IlanKonut');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IlanKonut);

		parent::tearDown();
	}

}
