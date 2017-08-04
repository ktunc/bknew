<?php
App::uses('AppModel', 'Model');
/**
 * IlanDanisman Model
 *
 * @property Ilan $Ilan
 * @property Danisman $Danisman
 */
class IlanDanisman extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'ilan_danisman';


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
		),
		'Danisman' => array(
			'className' => 'Danisman',
			'foreignKey' => 'danisman_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    public $hasMany = array(
        'IlanResim'=>array(
            'className' => 'IlanResim',
            'foreignKey' => 'ilan_id',
            'dependent' => true
        )
    );
}
