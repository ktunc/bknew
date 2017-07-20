<?php
App::uses('IlanIsyeri', 'Model');

/**
 * IlanIsyeri Test Case
 */
class IlanIsyeriTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ilan_isyeri',
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
		$this->IlanIsyeri = ClassRegistry::init('IlanIsyeri');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IlanIsyeri);

		parent::tearDown();
	}

}
