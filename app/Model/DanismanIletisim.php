<?php
App::uses('AppModel', 'Model');
/**
 * DanismanIletisim Model
 *
 * @property Danisman $Danisman
 */
class DanismanIletisim extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'danisman_iletisim';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'danisman_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Danisman' => array(
			'className' => 'Danisman',
			'foreignKey' => 'danisman_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
