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
		),
        'Sehir' => array(
            'className' => 'Sehir',
            'foreignKey' => 'sehir_id'
        ),
        'Ilce' => array(
            'className' => 'Ilce',
            'foreignKey' => 'ilce_id'
        ),
        'Semt' => array(
            'className' => 'Semt',
            'foreignKey' => 'semt_id'
        ),
        'Mahalle' => array(
            'className' => 'Mahalle',
            'foreignKey' => 'mahalle_id'
        ),
        'Danisman' => array(
            'className' => 'Danisman',
            'foreignKey' => 'danisman_id',
            'dependent' => true
        )
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
//	public $hasAndBelongsToMany = array(
//		'Danisman' => array(
//			'className' => 'Danisman',
//			'joinTable' => 'ilan_danisman',
//			'foreignKey' => 'ilan_id',
//			'associationForeignKey' => 'danisman_id',
//			'unique' => 'keepExisting',
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'finderQuery' => '',
//		)
//	);

	public $hasMany = array(
	    'IlanResim'=>array(
	        'className' => 'IlanResim',
            'foreignKey' => 'ilan_id',
            'dependent' => true,
            'order'=>'IlanResim.sira ASC'
        )
    );

	public $hasOne = array(
        'IlanKonut' => array(
            'className' => 'IlanKonut',
            'foreignKey' => 'ilan_id',
            'dependent' => true
        ),
        'IlanIsyeri' => array(
            'className' => 'IlanIsyeri',
            'foreignKey' => 'ilan_id',
            'dependent' => true
        ),
        'IlanArsa' => array(
            'className' => 'IlanArsa',
            'foreignKey' => 'ilan_id',
            'dependent' => true
        )
    );

}
