<?php
class TeknikAnaliz extends AppModel{
    public $useTable = "teknik_analiz";

    public $hasMany = array(
        'TeknikAnalizResim'=>array(
            'className' => 'TeknikAnalizResim',
            'foreignKey' => 'teknik_analiz_id',
            'dependent' => true,
            'order'=>'TeknikAnalizResim.sira ASC'
        )
    );
}