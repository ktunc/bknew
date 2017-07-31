<?php
/**
 * Mahalle Fixture
 */
class MahalleFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'mahalle';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 111, 'unsigned' => false, 'key' => 'primary'),
		'semt_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'mahalle_adi' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'semt_id' => 1,
			'mahalle_adi' => 'Lorem ipsum dolor sit amet'
		),
	);

}
