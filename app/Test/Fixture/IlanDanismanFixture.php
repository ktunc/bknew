<?php
/**
 * IlanDanisman Fixture
 */
class IlanDanismanFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'ilan_danisman';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'ilan_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false),
		'danisman_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'danisman_id' => 1,
			'islem_tarihi' => '2017-07-20 16:37:36'
		),
	);

}
