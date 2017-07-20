<?php
App::uses('AppModel', 'Model');
/**
 * IlanLocation Model
 *
 * @property Ilan $Ilan
 */
class IlanLocation extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'ilan_location';


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
