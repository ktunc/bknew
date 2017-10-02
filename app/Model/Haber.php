<?php
class Haber extends AppModel{
    public $useTable = "haber";

    public $hasMany = array(
        'HaberResim'=>array(
            'className' => 'HaberResim',
            'foreignKey' => 'haber_id',
            'dependent' => true,
            'order'=>'HaberResim.sira ASC'
        )
    );
}