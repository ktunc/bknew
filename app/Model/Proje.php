<?php
class Proje extends AppModel{
    public $useTable = "proje";

    public $hasMany = array(
        'ProjeResim'=>array(
            'className' => 'ProjeResim',
            'foreignKey' => 'proje_id',
            'dependent' => true,
            'order'=>'ProjeResim.sira ASC'
        )
    );
}