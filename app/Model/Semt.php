<?php
App::uses('AppModel', 'Model');
/**
 * Semt Model
 *
 * @property Ilce $Ilce
 * @property Mahalle $Mahalle
 */
class Semt extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'semt';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Ilce' => array(
			'className' => 'Ilce',
			'foreignKey' => 'ilce_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Mahalle' => array(
			'className' => 'Mahalle',
			'foreignKey' => 'semt_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
