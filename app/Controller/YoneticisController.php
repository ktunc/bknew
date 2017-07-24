<?php
App::uses('AppController', 'Controller');
App::uses('FilerUploader','Vendor');
App::uses('ImageManipulator','Vendor');

/**
 * Yoneticis Controller
 * @property Ilan $Ilan
 * @property IlanKonut $IlanKonut
 * @property IlanArsa $IlanArsa
 * @property IlanIsyeri $IlanIsyeri
 */
class YoneticisController extends AppController {

    var $layout = 'yonetici';
    var $uses = array('Ilan','IlanKonut','IlanArsa','IlanIsyeri');
/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public $ilanHeader = array(1=>'Yeni Konut İlanı', 2=>'Yeni İşyeri İlanı', 3=>'Yeni Arsa İlanı');

	public function index(){}

	public function yeniilan(){
	    $named=$this->request->param('named');
	    $tur = array_key_exists('tur',$named)?$named['tur']:1;
	    if(!array_key_exists($tur,$this->ilanHeader)){
	        $this->redirect(array('controller'=>'yoneticis','action'=>'yeniilan','tur'=>1));
        }
	    $this->set('tur',$tur);
	    $this->set('ilanHeader',$this->ilanHeader[$tur]);
    }

	public function ilanlar(){}

	public function ilankaydet(){
	    $this->autoLayout = false;
	    $this->autoRender = false;
	    $return = array('hata'=>true, 'mesaj'=>'Bir hata meydana geldi. Lütfen tekrar deneyin.');
	    if($this->request->is('post')){
	        $data = $this->request->data;

            if(array_key_exists('ilanId',$data) && $data['ilanId'] != 0){
                $pata = $this->Ilan->findById($data['ilanId']);
                if(!$pata){
                    echo json_encode($return);
                    exit();
                }
                $return['ilanId'] = $data['ilanId'];
                $saved = array('baslik'=>$data['baslik'],'icerik'=>$data['icerik'],'turu'=>$data['turu'],'fiyat'=>$data['fiyat'],'eklenme_tarihi'=>date('Y-m-d H:i:s'));
                $this->Ilan->id = $data['ilanId'];
                if(!$this->Ilan->save($saved)){
                    echo json_encode($return);
                    exit();
                }

                if($pata['turu'] == 1){
                    $tata = $this->IlanKonut->findByIlanId($data['ilanId']);
                    $this->IlanKonut->id = $tata['id'];
                    $saved = array('kat'=>$data['kat'], 'bina_kat'=>$data['bina_kat'], 'oda'=>$data['oda'], 'mkare'=>$data['mkare'], 'islem_tarihi'=>date('Y-m-d H:i:s'));
                    if($this->IlanKonut->save($saved)){
                        $return['hata'] = false;
                    }
                }else if($pata['turu'] == 2){
                    $tata = $this->IlanIsyeri->findByIlanId($data['ilanId']);
                    $this->IlanIsyeri->id = $tata['id'];
                    $saved = array('kat'=>$data['kat'], 'bina_kat'=>$data['bina_kat'], 'oda'=>$data['oda'], 'mkare'=>$data['mkare'], 'islem_tarihi'=>date('Y-m-d H:i:s'));
                    if($this->IlanIsyeri->save($saved)){
                        $return['hata'] = false;
                    }
                }else{
                    $tata = $this->IlanArsa->findByIlanId($data['ilanId']);
                    $this->IlanArsa->id = $tata['id'];
                    $saved = array('imar'=>$data['imar'], 'ada'=>$data['ada'], 'parsel'=>$data['parsel'], 'mkare'=>$data['mkare'], 'tapu'=>$data['tapu'], 'islem_tarihi'=>date('Y-m-d H:i:s'));
                    if($this->IlanArsa->save($saved)){
                        $return['hata'] = false;
                    }
                }
            }else{
                if(array_key_exists('turu',$data) && array_key_exists($data['turu'],$this->ilanHeader)){
                    $saved = array('baslik'=>$data['baslik'],'icerik'=>$data['icerik'],'turu'=>$data['turu'],'fiyat'=>$data['fiyat'],'eklenme_tarihi'=>date('Y-m-d H:i:s'));
                    $this->Ilan->create();
                    if(!$this->Ilan->save($saved)){
                        echo json_encode($return);
                        exit();
                    }
                    $ilanId = $this->Ilan->getLastInsertID();
                    $return['ilanId'] = $ilanId;
                    if($data['turu'] == 1){
                        $saved = array('ilan_id'=>$ilanId, 'kat'=>$data['kat'], 'bina_kat'=>$data['bina_kat'], 'oda'=>$data['oda'], 'mkare'=>$data['mkare'], 'islem_tarihi'=>date('Y-m-d H:i:s'));
                        $this->IlanKonut->create();
                        if($this->IlanKonut->save($saved)){
                            $return['hata'] = false;
                        }
                    }else if($data['turu'] == 2){
                        $this->IlanIsyeri->create();
                        $saved = array('ilan_id'=>$ilanId, 'kat'=>$data['kat'], 'bina_kat'=>$data['bina_kat'], 'oda'=>$data['oda'], 'mkare'=>$data['mkare'], 'islem_tarihi'=>date('Y-m-d H:i:s'));
                        if($this->IlanIsyeri->save($saved)){
                            $return['hata'] = false;
                        }
                    }else{
                        $this->IlanArsa->create();
                        $saved = array('ilan_id'=>$ilanId, 'imar'=>$data['imar'], 'ada'=>$data['ada'], 'parsel'=>$data['parsel'], 'mkare'=>$data['mkare'], 'tapu'=>$data['tapu'], 'islem_tarihi'=>date('Y-m-d H:i:s'));
                        if($this->IlanArsa->save($saved)){
                            $return['hata'] = false;
                        }
                    }
                }
            }
        }
        echo json_encode($return);
        exit();
    }

    public function uploadimage(){
        $this->autoRender = false;
        $uploader = new FilerUploader();
        $data = $uploader->upload($_FILES['files'], array(
            'limit' => 10, //Maximum Limit of files. {null, Number}
            'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
            'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
            'required' => false, //Minimum one file is required for upload {Boolean}
            'uploadDir' => 'img/gecici/', //Upload directory {String}
            'title' => array('randomVEtime'), //New file name {null, String, Array} *please read documentation in README.md
            'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
            'replace' => false, //Replace the file if it already exists  {Boolean}
            'perms' => null, //Uploaded file permisions {null, Number}
            'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
            'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
            'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
            'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
            'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
            'onRemove' => null //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
        ));

        if($data['isComplete']){
            $files = $data['data'];

            echo json_encode($files['metas'][0]['name']);
        }

        if($data['hasErrors']){
            $errors = $data['errors'];
            echo json_encode($errors);
        }
    }

    public function removeimage(){
        $this->autoRender = false;
        if(isset($_POST['file'])){
            $file = 'img/gecici/' . $_POST['file'];
            if(file_exists($file)){
                unlink($file);
            }
        }
        echo json_encode(true);
    }

	public function test(){
	    pr($this->request->data['aciklama']);
	    pr($_FILES);
	    exit();
    }

}
