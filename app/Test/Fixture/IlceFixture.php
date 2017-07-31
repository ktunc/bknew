<?php
/**
 * Ilce Fixture
 */
class IlceFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'ilce';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 111, 'unsigned' => false, 'key' => 'primary'),
		'sehir_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'ilce_adi' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'sehir_id' => 1,
			'ilce_adi' => 'Lorem ipsum dolor sit amet'
		),
	);

}
