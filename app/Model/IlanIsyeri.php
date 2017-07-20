<?php
App::uses('AppModel', 'Model');
/**
 * IlanIsyeri Model
 *
 * @property Ilan $Ilan
 */
class IlanIsyeri extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'ilan_isyeri';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Ilan' => array(
			'className' => 'Ilan',
			'foreignKey' => 'ilan_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
