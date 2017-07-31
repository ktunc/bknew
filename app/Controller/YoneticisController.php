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
 * @property IlanResim $IlanResim
 * @property Sehir $Sehir
 * $property Ilce $Ilce
 * $property Semt $Semt
 * @property Mahalle $Mahalle
 * @property IlanLocation $IlanLocation
 */
class YoneticisController extends AppController {

    var $layout = 'yonetici';
    var $uses = array('Ilan','IlanKonut','IlanArsa','IlanIsyeri', 'IlanResim', 'Sehir', 'Ilce', 'Semt', 'Mahalle', 'IlanLocation');
/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public $ilanHeader = array(1=>'Yeni Konut İlanı', 2=>'Yeni İşyeri İlanı', 3=>'Yeni Arsa İlanı');

	public function index(){

    }

	public function yeniilan(){
	    $named=$this->request->param('named');
	    $tur = array_key_exists('tur',$named)?$named['tur']:1;
	    if(!array_key_exists($tur,$this->ilanHeader)){
	        $this->redirect(array('controller'=>'yoneticis','action'=>'yeniilan','tur'=>1));
        }
	    $this->set('tur',$tur);
	    $this->set('ilanHeader',$this->ilanHeader[$tur]);
	    $sehir = $this->Sehir->find('all',array('order'=>array('sehir_adi'=>'ASC')));
	    $this->set('sehir', $sehir);
    }

	public function ilanlar(){
        $data = $this->Ilan->find('all',array('order'=>array('Ilan.id' => 'DESC')));
        $this->set('ilanlar',$data);
    }

    public function ilanedit(){
	    $named = $this->request->params["named"];
        $ilan = $this->Ilan->findById($named['ilan']);
        if(!$ilan){
            $this->redirect(array('controller'=>'yoneticis'));
        }

        if(!array_key_exists($ilan['Ilan']['turu'],$this->ilanHeader)){
            $this->redirect(array('controller'=>'yoneticis','action'=>'yeniilan','tur'=>1));
        }
        $this->set('tur',$ilan['Ilan']['turu']);
        $this->set('ilanHeader',$this->ilanHeader[$ilan['Ilan']['turu']]);
        $sehir = $ilce = $semt = $mahalle = false;
        $sehir = $this->Sehir->find('all',array('order'=>array('sehir_adi'=>'ASC')));
        $this->set('sehir', $sehir);

        if(!empty($ilan['Ilan']['sehir_id'])){
            $ilce = $this->Ilce->find('all',array('conditions'=>array('sehir_id'=>$ilan['Ilan']['sehir_id']), 'order'=>array('ilce_adi'=>'ASC')));
        }
        if(!empty($ilan['Ilan']['ilce_id'])){
            $semt = $this->Semt->find('all',array('conditions'=>array('ilce_id'=>$ilan['Ilan']['ilce_id']), 'order'=>array('semt_adi'=>'ASC')));
        }
        if(!empty($ilan['Ilan']['semt_id'])){
            $mahalle = $this->Mahalle->find('all',array('conditions'=>array('semt_id'=>$ilan['Ilan']['semt_id']), 'order'=>array('mahalle_adi'=>'ASC')));
        }
        $this->set('ilce',$ilce);
        $this->set('semt',$semt);
        $this->set('mahalle',$mahalle);

        $this->set('ilan',$ilan);
//        pr($ilan['Ilan']['sehir_id']);exit();
    }

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
                $saved = array('baslik'=>$data['baslik'],'icerik'=>$data['icerik'],'turu'=>$data['turu'],'fiyat'=>$data['fiyat'],'satkir'=>$data['satkir']);
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
                    $saved = array('baslik'=>$data['baslik'],'icerik'=>$data['icerik'],'turu'=>$data['turu'],'fiyat'=>$data['fiyat'],'satkir'=>$data['satkir'],'eklenme_tarihi'=>date('Y-m-d H:i:s'));
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

    public function ilanresimkaydet(){
	    $this->autoLayout = false;
	    $this->autoRender = false;
        $return = array('hata'=>true, 'mesaj'=>'Bir hata meydana geldi. Lütfen tekrar deneyin.');
        if($this->request->is('post')){
            $data = $this->request->data;
            if(array_key_exists('ilanId',$data) && $data['ilanId'] != 0){
                $ilanId = $data['ilanId'];
                $yuklenenfile = array_key_exists('yuklenenfile',$data)?$data['yuklenenfile']:false;

                $hata = 0;
                foreach($yuklenenfile as $value){
                    $asilpath = WWW_ROOT.'img/gecici/'.$value;
                    if(!is_file($asilpath)){
                        continue;
                    }

                    if(file_exists($asilpath)){
                        $fileType = pathinfo($value, PATHINFO_EXTENSION);
                        $resName = time().rand(1,1000).'.'.$fileType;
                        $path = 'img/ilan/'.$ilanId.'/'.$resName;
                        $pathThumb = 'img/ilan/'.$ilanId.'/thumb'.$resName;
//                        $pathRes = WWW_ROOT.'img/ilan/'.$ilanId.'/'.$resName;
//                        $pathResThumb = WWW_ROOT.'img/ilan/'.$ilanId.'/thumb'.$resName;

                        //image Resize
                        $manipulator = new ImageManipulator($asilpath);
                        $newImage = $manipulator->resample(800, 800);
                        if($manipulator->save($path)){
                            $manipulator = new ImageManipulator($path);
                            $newImage = $manipulator->resample(200, 200);
                            if($manipulator->save($pathThumb)){
                                $this->IlanResim->create();
                                $this->IlanResim->save(array('ilan_id'=>$ilanId,'res'=>$value,'path'=>$path,'paththumb'=>$pathThumb, 'islem_tarihi'=>date('Y-m-d H:i:s')));
                                if(file_exists($asilpath)){
                                    unlink($asilpath);
                                }
                            }
                        }else{
                            $hata++;
                        }
                    }else{
                        $hata++;
                    }
                }

                if($hata == 0){
                    $return['hata'] = false;
                    $return['mesaj'] = 'İlan resimleri başarıyla kaydedildi.';
                }
            }
        }
        echo json_encode($return);
        exit();
    }

    public function ilanlocationkaydet(){
        $this->autoLayout = false;
        $this->autoRender = false;
        $return = array('hata'=>true, 'mesaj'=>'Bir hata meydana geldi. Lütfen tekrar deneyin.');
        if($this->request->is('post')){
            $data = $this->request->data;
            if(array_key_exists('ilanId',$data) && $data['ilanId'] != 0){
                $ilanId = $data['ilanId'];
                $ilan = $this->Ilan->findById($ilanId);

                $sehir = array_key_exists('sehir',$data)?($data['sehir']==-1?null:$data['sehir']):null;
                $ilce = array_key_exists('ilce',$data)?($data['ilce']==-1?null:$data['ilce']):null;
                $semt = array_key_exists('semt',$data)?($data['semt']==-1?null:$data['semt']):null;
                $mahalle = array_key_exists('mahalle',$data)?($data['mahalle']==-1?null:$data['mahalle']):null;
                $adres = $data['adres'];
                $saved = array('sehir_id'=>$sehir, 'ilce_id'=>$ilce, 'semt_id'=>$semt, 'mahalle_id'=>$mahalle, 'adres'=>$adres);

                if($ilan){
                    $this->Ilan->id = $ilanId;
                    if($this->Ilan->save($saved)){
                        $return['hata'] = false;
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

            $res = $this->IlanResim->findByRes($_POST['file']);
            if($res){
                $fileRes = new File($res['IlanResim']['path']);
                $fileRes->delete();
                $fileResThumb = new File($res['IlanResim']['paththumb']);
                if($fileResThumb){
                    $fileResThumb->delete();
                }

                if($this->IlanResim->deleteAll(array('id'=>$res['IlanResim']['id']))){
                    echo json_encode(true);
                }else{
                    echo json_encode(false);
                }
            }
        }
        echo json_encode(true);
    }

    public function ajaxIlceBySehir(){
        $this->autoRender = false;
        $this->autoLayout = false;
        $return = array('hata'=>true, 'mesaj'=>'Bir hata meydana geldi. Lütfen tekrar deneyin.', 'select'=>false);
        if($this->request->is('post')){
            $sehir = $this->request->data('sehir');
            $ilce = $this->Ilce->find('all',array('conditions'=>array('sehir_id'=>$sehir),'order'=>array('ilce_adi'=>'ASC')));
            if($ilce){
                $selectilce = '<option value="-1">Seçiniz</option>';
                foreach ($ilce as $row) {
                    $selectilce .= '<option value="'.$row['Ilce']['id'].'">'.$row['Ilce']['ilce_adi'].'</option>';
                }
                $return['select'] = $selectilce;
            }
        }

        echo json_encode($return);
        exit();
    }

    public function ajaxSemtByIlce(){
        $this->autoRender = false;
        $this->autoLayout = false;
        $return = array('hata'=>true, 'mesaj'=>'Bir hata meydana geldi. Lütfen tekrar deneyin.', 'select'=>false);
        if($this->request->is('post')){
            $ilce = $this->request->data('ilce');
            $semt = $this->Semt->find('all',array('conditions'=>array('ilce_id'=>$ilce),'order'=>array('semt_adi'=>'ASC')));
            if($semt){
                $selectilce = '<option value="-1">Seçiniz</option>';
                foreach ($semt as $row) {
                    $selectilce .= '<option value="'.$row['Semt']['id'].'">'.$row['Semt']['semt_adi'].'</option>';
                }
                $return['select'] = $selectilce;
            }
        }

        echo json_encode($return);
        exit();
    }

    public function ajaxMahalleBySemt(){
        $this->autoRender = false;
        $this->autoLayout = false;
        $return = array('hata'=>true, 'mesaj'=>'Bir hata meydana geldi. Lütfen tekrar deneyin.', 'select'=>false);
        if($this->request->is('post')){
            $semt = $this->request->data('semt');
            $mahalle = $this->Mahalle->find('all',array('conditions'=>array('semt_id'=>$semt),'order'=>array('mahalle_adi'=>'ASC')));
            if($mahalle){
                $selectilce = '<option value="-1">Seçiniz</option>';
                foreach ($mahalle as $row) {
                    $selectilce .= '<option value="'.$row['Mahalle']['id'].'">'.$row['Mahalle']['mahalle_adi'].'</option>';
                }
                $return['select'] = $selectilce;
            }
        }

        echo json_encode($return);
        exit();
    }

	public function test(){
        $this->IlanResim->create();
        exit();
    }


}
