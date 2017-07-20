<?php
/**
 * Ilan Fixture
 */
class IlanFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'ilan';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'baslik' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'icerik' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'turu' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1, 'unsigned' => false, 'comment' => '1 => Konut # 
2 => Isyeri # 
3 => Arsa #'),
		'fiyat' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'durum' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 1, 'unsigned' => false, 'comment' => '0 => Taslak # 
1 => Yayinda # 
-1 => Yayindan Kaldırıldı #'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2, 'unsigned' => false),
		'eklenme_tarihi' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'duzenlenme_tarihi' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'baslik' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'icerik' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'turu' => 1,
			'fiyat' => 1,
			'durum' => 1,
			'user_id' => 1,
			'eklenme_tarihi' => '2017-07-20 16:35:55',
			'duzenlenme_tarihi' => '2017-07-20 16:35:55'
		),
	);

}
