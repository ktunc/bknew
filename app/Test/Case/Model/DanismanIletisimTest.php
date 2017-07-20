<?php
App::uses('DanismanIletisim', 'Model');

/**
 * DanismanIletisim Test Case
 */
class DanismanIletisimTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.danisman_iletisim',
		'app.danisman'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DanismanIletisim = ClassRegistry::init('DanismanIletisim');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DanismanIletisim);

		parent::tearDown();
	}

}
