<?php
App::uses('IlanDanisman', 'Model');

/**
 * IlanDanisman Test Case
 */
class IlanDanismanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ilan_danisman',
		'app.ilan',
		'app.user',
		'app.danisman'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->IlanDanisman = ClassRegistry::init('IlanDanisman');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IlanDanisman);

		parent::tearDown();
	}

}
