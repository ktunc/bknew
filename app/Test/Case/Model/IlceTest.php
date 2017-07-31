<?php
App::uses('Ilce', 'Model');

/**
 * Ilce Test Case
 */
class IlceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ilce',
		'app.sehir',
		'app.semt',
		'app.mahalle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ilce = ClassRegistry::init('Ilce');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ilce);

		parent::tearDown();
	}

}
