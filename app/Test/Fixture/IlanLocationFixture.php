<?php
/**
 * IlanLocation Fixture
 */
class IlanLocationFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'ilan_location';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'ilan_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false),
		'name' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'latitude' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'longitude' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'islem_tarihi' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'id' => '',
			'ilan_id' => '',
			'name' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'latitude' => 1,
			'longitude' => 1,
			'islem_tarihi' => '2017-07-20 16:37:49'
		),
	);

}
