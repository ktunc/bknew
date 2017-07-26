<?php
App::uses('AppModel', 'Model');
/**
 * Mahalle Model
 *
 * @property Semt $Semt
 */
class Mahalle extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'mahalle';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'semt_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mahalle_adi' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
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
		'Semt' => array(
			'className' => 'Semt',
			'foreignKey' => 'semt_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
