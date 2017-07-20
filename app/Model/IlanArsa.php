<?php
App::uses('AppModel', 'Model');
/**
 * IlanArsa Model
 *
 * @property Ilan $Ilan
 */
class IlanArsa extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'ilan_arsa';


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
