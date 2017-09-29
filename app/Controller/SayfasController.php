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

    public function beforeFilter(){
        $detect = new Mobile_Detect;
        if($detect->isMobile() || $detect->isTablet()){
            $this->layout = 'mobile';
        }
    }

    public function index(){
        $named = $this->request->params['named'];
        $sqlEk = ' 1 = 1 ';
        if(array_key_exists('tur',$named)){
            $sqlEk .= ' AND Ilan.turu = '.$named['tur'];
        }
        $ilanlar = array();
        $data = $this->Ilan->find('all',array('conditions'=>array('Ilan.latitude IS NOT NULL', 'Ilan.longitude IS NOT NULL', $sqlEk)));
        foreach ($data as $row){
            $ilanlar[] = $row['Ilan'];
        }
        $this->set('ilanlar',json_encode($ilanlar));
    }

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

    public function AjaxGetMapIlanInfo(){
        $this->autoRender = false;
        $return = array('hata'=>true);
        if($this->request->is('post')){
            $ilanId = $this->request->data('ilanId');
            $ilan = $this->Ilan->findById($ilanId);
            if($ilan){
                $return['hata'] = false;
                $return['ilan'] = $ilan;
            }
        }

        echo json_encode($return);
    }
}