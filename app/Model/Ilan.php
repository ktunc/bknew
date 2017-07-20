<?php
App::uses('AppModel', 'Model');
/**
 * Ilan Model
 *
 * @property User $User
 * @property Danisman $Danisman
 */
class Ilan extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'ilan';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Danisman' => array(
			'className' => 'Danisman',
			'joinTable' => 'ilan_danisman',
			'foreignKey' => 'ilan_id',
			'associationForeignKey' => 'danisman_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
