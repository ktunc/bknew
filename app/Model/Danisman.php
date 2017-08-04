<?php
App::uses('AppModel', 'Model');
/**
 * Danisman Model
 *
 * @property Ilan $Ilan
 */
class Danisman extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'danisman';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Ilan' => array(
			'className' => 'Ilan',
			'joinTable' => 'ilan_danisman',
			'foreignKey' => 'danisman_id',
			'associationForeignKey' => 'ilan_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

    public $hasMany = array(
        'DanismanIletisim'=>array(
            'className' => 'DanismanIletisim',
            'foreignKey' => 'danisman_id',
            'dependent' => true
        )
    );

}
