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

    public function ilansayilar(){
        $this->autoRender = false;
        $return=array();
        $return['konut'] = $this->Ilan->find('count',array('conditions'=>array('turu'=>1,'durum'=>1)));
        $return['isyeri'] = $this->Ilan->find('count',array('conditions'=>array('turu'=>2,'durum'=>1)));
        $return['arsa'] = $this->Ilan->find('count',array('conditions'=>array('turu'=>3,'durum'=>1)));

        return $return;
    }

    public function ilanlar(){
        $named = $this->request->params["named"];
        $tur = array_key_exists("tur",$named)?$named["tur"]:0;
        $tur = in_array($tur,array(1,2,3))?$tur:0;

        if($this->request->is('post')){
            $data = $this->request->data;
            $this->passedArgs = $data;
        }else{
            $data = $this->passedArgs;
        }
        $limit = 20;

        $Con = array();
        if($tur != 0){
            $Con['Ilan.tur'] = $tur;
        }

        if(array_key_exists('aramatext',$data)){
            $aramatext = $data["aramatext"];
            $Con['OR'] = array(
                "Ilan.baslik LIKE '%$aramatext%'",
                "Ilan.icerik LIKE '%$aramatext%'",
                "Ilan.adres LIKE '%$aramatext%'",
                "Sehir.sehir_adi LIKE '%$aramatext%'",
                "Ilce.ilce_adi LIKE '%$aramatext%'",
                "Semt.semt_adi LIKE '%$aramatext%'",
                "Mahalle.mahalle_adi LIKE '%$aramatext%'",
                "Danisman.isim LIKE '%$aramatext%'",
                "Danisman.hakkinda LIKE '%$aramatext%'"
            );
        }

        if(array_key_exists('fiy1',$data) && is_numeric($data['fiy1'])){
            $Con[] = 'Ilan.fiyat >= '.$data['fiy1'];
        }
        if(array_key_exists('fiy2',$data) && is_numeric($data['fiy2'])){
            $Con[] = 'Ilan.fiyat >= '.$data['fiy2'];
        }
        if(array_key_exists('m1',$data) && is_numeric($data['m1'])){
            $Con[] = 'Ilan.fiyat >= '.$data['m1'];
        }
        if(array_key_exists('m2',$data) && is_numeric($data['m2'])){
            $Con[] = 'Ilan.fiyat >= '.$data['m2'];
        }

        if(array_key_exists('tarih', $data)){
            if($data['tarih']=='desc'){
                $Order['Ilan.tarih'] = 'DESC';
            }else if($data['tarih']=='asc'){
                $Order['Ilan.tarih'] = 'ASC';
            }
        }else if(array_key_exists('fiyat', $data)){
            if($data['fiyat']=='desc'){
                $Order['Ilan.fiyat'] = 'DESC';
            }else if($data['fiyat']=='asc'){
                $Order['Ilan.fiyat'] = 'DESC';
            }
        }else{
            $Order['Ilan.tarih'] = 'DESC';
        }

        $this->paginate = array(
            'fields'=>array('*'),
            'conditions'=>$Con,
            'limit'=>$limit,
            'order'=>$Order
        );

        $ilanlar = $this->paginate('Ilan');
        $this->set('ilanlar',$ilanlar);
    }

    public function sehirler(){
        $this->autoRender = false;
        return $this->Sehir->find('all',array('order'=>array('sehir_adi'=>'ASC')));
    }

    public function ilceler(){
        $this->autoRender = false;
        $return['hata'] = true;
        if($this->request->is('post')){
            $sehir_id = $this->request->data('sehir_id');
            $ilceler = $this->Ilce->find('all',array('conditions'=>array('sehir_id'=>$sehir_id),'order'=>array('ilce_adi'=>'ASC')));

            if($ilceler){
                $return['hata'] = false;
                $return['ilceselect'] = '<option value="0">Hepsi</option>';
                foreach ($ilceler as $row){
                    $return['ilceselect'] .= '<option value="'.$row['Ilce']['id'].'">'.$row['Ilce']['ilce_adi'].'</option>';
                }
            }
        }

        echo json_encode($return);
        exit();
    }

    public function semtler(){
        $this->autoRender = false;
        $return['hata'] = true;
        if($this->request->is('post')){
            $ilce_id = $this->request->data('ilce_id');
            $semtler = $this->Semt->find('all',array('conditions'=>array('ilce_id'=>$ilce_id),'order'=>array('semt_adi'=>'ASC')));

            if($semtler){
                $return['hata'] = false;
                $return['semtselect'] = '<option value="0">Hepsi</option>';
                foreach ($semtler as $row){
                    $return['semtselect'] .= '<option value="'.$row['Semt']['id'].'">'.$row['Semt']['semt_adi'].'</option>';
                }
            }
        }

        echo json_encode($return);
        exit();
    }

    public function mahalleler(){
        $this->autoRender = false;
        $return['hata'] = true;
        if($this->request->is('post')){
            $semt_id = $this->request->data('semt_id');
            $mahalleler = $this->Mahalle->find('all',array('conditions'=>array('semt_id'=>$semt_id),'order'=>array('mahalle_adi'=>'ASC')));

            if($mahalleler){
                $return['hata'] = false;
                $return['mahalleselect'] = '<option value="0">Hepsi</option>';
                foreach ($mahalleler as $row){
                    $return['mahalleselect'] .= '<option value="'.$row['Mahalle']['id'].'">'.$row['Mahalle']['mahalle_adi'].'</option>';
                }
            }
        }

        echo json_encode($return);
        exit();
    }
}