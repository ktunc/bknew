<?php
App::uses('IlanResim', 'Model');

/**
 * IlanResim Test Case
 */
class IlanResimTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ilan_resim',
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
		$this->IlanResim = ClassRegistry::init('IlanResim');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IlanResim);

		parent::tearDown();
	}

}
