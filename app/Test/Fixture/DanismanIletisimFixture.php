<?php
/**
 * DanismanIletisim Fixture
 */
class DanismanIletisimFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'danisman_iletisim';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'danisman_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'Iletisim' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'turu' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '1 => Telefon # 
2 => Mail # '),
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
			'danisman_id' => 1,
			'Iletisim' => 'Lorem ipsum dolor sit amet',
			'turu' => 1,
			'islem_tarihi' => '2017-07-20 16:38:02'
		),
	);

}
