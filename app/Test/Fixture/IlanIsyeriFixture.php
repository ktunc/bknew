<?php
/**
 * IlanIsyeri Fixture
 */
class IlanIsyeriFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'ilan_isyeri';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'ilan_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false),
		'oda' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'kat' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'bina_kat' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mkare' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'oda' => 'Lorem ipsum dolor sit amet',
			'kat' => 'Lorem ipsum dolor sit amet',
			'bina_kat' => 'Lorem ipsum dolor sit amet',
			'mkare' => 1,
			'islem_tarihi' => '2017-07-20 16:37:08'
		),
	);

}
