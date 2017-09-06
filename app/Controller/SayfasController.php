<?php
App::uses('AppController', 'Controller');

/**
 * Yoneticis Controller
 * @property Ilan $Ilan
 * @property IlanKonut $IlanKonut
 * @property IlanArsa $IlanArsa
 * @property IlanIsyeri $IlanIsyeri
 * @property IlanResim $IlanResim
 * @property Sehir $Sehir
 * $property Ilce $Ilce
 * $property Semt $Semt
 * @property Mahalle $Mahalle
 * @property Danisman $Danisman
 * @property DanismanIletisim $DanismanIletisim
 */

class SayfasController extends AppController{
    var $uses = array('Ilan','IlanKonut','IlanArsa','IlanIsyeri', 'IlanResim', 'Sehir', 'Ilce', 'Semt', 'Mahalle', 'Danisman', 'DanismanIletisim');

    public function index(){}

    public function ilan(){
        $named=$this->request->param('named');
        if(array_key_exists('ilan',$named)){
            $ilan = $this->Ilan->findById($named['ilan']);
            if($ilan){
                $this->set('ilan',$ilan);
                $ilanlar = $this->Ilan->find('all',array('conditions'=>array('Ilan.id != '.$named['ilan']),'limit'=>10, 'order'=>array('eklenme_tarihi'=>'desc')));
                $this->set('ilanlar',$ilanlar);
            }else{
                // Hata
            }
        }else{
            // Hata
        }

    }

    public function danisman(){
        $named=$this->request->param('named');
        if(array_key_exists('dId',$named)){
            $danisman = $this->Danisman->findById($named['dId']);
            if($danisman){
                $this->set('danisman',$danisman);
                $danismanlar = $this->Danisman->find('all',array('conditions'=>array('Danisman.id != '.$named['dId']), 'order'=>array('isim'=>'asc')));
                $this->set('danismanlar',$danismanlar);
            }else{
                // Hata
            }
        }else{
            // Hata
        }
    }
}