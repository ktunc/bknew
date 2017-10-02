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
 * @property Danisman $Danisman
 * @property DanismanIletisim $DanismanIletisim
 * @property Haber $Haber
 * @property HaberResim $HaberResim
 * @property Proje $Proje
 * @property ProjeResim $ProjeResim
 * @property TeknikAnaliz $TeknikAnaliz
 * @property TeknikAnalizResim $TeknikAnalizResim
 * @property User $User
 */
class YoneticisController extends AppController {

    var $layout = 'yonetici';
    var $uses = array('Ilan','IlanKonut','IlanArsa','IlanIsyeri', 'IlanResim', 'Sehir', 'Ilce', 'Semt', 'Mahalle', 'Danisman', 'DanismanIletisim','Haber','HaberResim','User','Proje','ProjeResim','TeknikAnaliz','TeknikAnalizResim');
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
        $danismanlar = $this->Danisman->find('all',array('order'=>array('isim'=>'ASC')));
        $this->set('danismanlar',$danismanlar);
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
        $danismanlar = $this->Danisman->find('all',array('order'=>array('isim'=>'ASC')));
        $this->set('danismanlar',$danismanlar);

        $step = 0;
        if(array_key_exists('step',$named)){
            $step = $named['step'];
        }
        $this->set('step',$step);
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
                $saved = array('baslik'=>$data['baslik'],'icerik'=>$data['icerik'],'turu'=>$data['turu'],'fiyat'=>$data['fiyat'],'satkir'=>$data['satkir'], 'mkare'=>$data['mkare'], 'danisman_id'=>$data['danisman']);
                $this->Ilan->id = $data['ilanId'];
                if(!$this->Ilan->save($saved)){
                    echo json_encode($return);
                    exit();
                }

                if($pata['Ilan']['turu'] == 1){
                    $tata = $this->IlanKonut->findByIlanId($data['ilanId']);
                    $this->IlanKonut->id = $tata['IlanKonut']['id'];
                    $saved = array('kat'=>$data['kat'], 'bina_kat'=>$data['bina_kat'], 'oda'=>$data['oda'],  'islem_tarihi'=>date('Y-m-d H:i:s'));
                    if($this->IlanKonut->save($saved)){
                        $return['hata'] = false;
                    }
                }else if($pata['Ilan']['turu'] == 2){
                    $tata = $this->IlanIsyeri->findByIlanId($data['ilanId']);
                    $this->IlanIsyeri->id = $tata['IlanIsyeri']['id'];
                    $saved = array('kat'=>$data['kat'], 'bina_kat'=>$data['bina_kat'], 'oda'=>$data['oda'],  'islem_tarihi'=>date('Y-m-d H:i:s'));
                    if($this->IlanIsyeri->save($saved)){
                        $return['hata'] = false;
                    }
                }else{
                    $tata = $this->IlanArsa->findByIlanId($data['ilanId']);
                    $this->IlanArsa->id = $tata['IlanArsa']['id'];
                    $saved = array('imar'=>$data['imar'], 'ada'=>$data['ada'], 'parsel'=>$data['parsel'],'tapu'=>$data['tapu'], 'islem_tarihi'=>date('Y-m-d H:i:s'));
                    if($this->IlanArsa->save($saved)){
                        $return['hata'] = false;
                    }
                }
            }else{
                if(array_key_exists('turu',$data) && array_key_exists($data['turu'],$this->ilanHeader)){
                    $saved = array('baslik'=>$data['baslik'],'icerik'=>$data['icerik'],'turu'=>$data['turu'],'fiyat'=>$data['fiyat'],'satkir'=>$data['satkir'], 'mkare'=>$data['mkare'], 'danisman_id'=>$data['danisman'],'eklenme_tarihi'=>date('Y-m-d H:i:s'));
                    $this->Ilan->create();
                    if(!$this->Ilan->save($saved)){
                        echo json_encode($return);
                        exit();
                    }
                    $ilanId = $this->Ilan->getLastInsertID();
                    $return['ilanId'] = $ilanId;
                    if($data['turu'] == 1){
                        $saved = array('ilan_id'=>$ilanId, 'kat'=>$data['kat'], 'bina_kat'=>$data['bina_kat'], 'oda'=>$data['oda'],  'islem_tarihi'=>date('Y-m-d H:i:s'));
                        $this->IlanKonut->create();
                        if($this->IlanKonut->save($saved)){
                            $return['hata'] = false;
                        }
                    }else if($data['turu'] == 2){
                        $this->IlanIsyeri->create();
                        $saved = array('ilan_id'=>$ilanId, 'kat'=>$data['kat'], 'bina_kat'=>$data['bina_kat'], 'oda'=>$data['oda'],  'islem_tarihi'=>date('Y-m-d H:i:s'));
                        if($this->IlanIsyeri->save($saved)){
                            $return['hata'] = false;
                        }
                    }else{
                        $this->IlanArsa->create();
                        $saved = array('ilan_id'=>$ilanId, 'imar'=>$data['imar'], 'ada'=>$data['ada'], 'parsel'=>$data['parsel'], 'tapu'=>$data['tapu'], 'islem_tarihi'=>date('Y-m-d H:i:s'));
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
                $sira = $this->IlanResim->find('count',array('conditions'=>array('ilan_id'=>$ilanId)));
                foreach($yuklenenfile as $value){
                    $sira++;
                    $asilpath = WWW_ROOT.'img/gecici/'.$value;
                    if(!is_file($asilpath)){
                        continue;
                    }

                    if(file_exists($asilpath)){
                        $fileType = pathinfo($value, PATHINFO_EXTENSION);
                        $resName = time().rand(1,1000).'.'.$fileType;
                        $path = 'img/ilan/'.$ilanId.'/'.$resName;
                        $path8 = 'img/ilan/'.$ilanId.'/800-'.$resName;
                        $pathThumb = 'img/ilan/'.$ilanId.'/thumb'.$resName;
//                        $pathRes = WWW_ROOT.'img/ilan/'.$ilanId.'/'.$resName;
//                        $pathResThumb = WWW_ROOT.'img/ilan/'.$ilanId.'/thumb'.$resName;

                        //image Resize
                        $manipulator = new ImageManipulator($asilpath);
                        $manipulator->resample(1024, 1024);
                        if($manipulator->save($path)){
                            $manipulator = new ImageManipulator($path);
                            $manipulator->resample(800, 800);
                            $manipulator->save($path8);
                            $manipulator = new ImageManipulator($path);
                            $manipulator->resample(200, 200);
                            $manipulator->save($pathThumb);
                            $this->IlanResim->create();
                            $this->IlanResim->save(array('ilan_id'=>$ilanId,'res'=>$value,'path'=>$path,'path8'=>$path8,'paththumb'=>$pathThumb, 'sira'=>$sira, 'islem_tarihi'=>date('Y-m-d H:i:s')));
                            if(file_exists($asilpath)){
                                unlink($asilpath);
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
                $latitude = $data['latitude'];
                $longitude = $data['longitude'];
                $adres = $data['adres'];
                $saved = array('sehir_id'=>$sehir, 'ilce_id'=>$ilce, 'semt_id'=>$semt, 'mahalle_id'=>$mahalle, 'adres'=>$adres, 'latitude'=>$latitude, 'longitude'=>$longitude);

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

    public function ajaxilansil(){
        $this->autoRender = false;
        $this->autoLayout = false;
//        pr('ttt');
//        exit();
        $return['hata'] = true;
        if($this->request->is('post')){
            $ilanId = $this->request->data('ilanId');

            $ilanresim = $this->IlanResim->findAllByIlanId($ilanId);
            foreach ($ilanresim as $row) {
                $fileRes = new File($row['IlanResim']['path']);
                $fileRes->delete();
                $fileResThumb = new File($row['IlanResim']['paththumb']);
                $fileResThumb->delete();
                $fileResThumb = new File($row['IlanResim']['path8']);
                $fileResThumb->delete();
                $this->IlanResim->deleteAll(array('IlanResim.id'=>$row['IlanResim']['id']));
            }

            $this->Ilan->deleteAll(array('Ilan.id'=>$ilanId));
            $this->IlanKonut->deleteAll(array('IlanKonut.ilan_id'=>$ilanId));
            $this->IlanIsyeri->deleteAll(array('IlanIsyeri.ilan_id'=>$ilanId));
            $this->IlanArsa->deleteAll(array('IlanArsa.ilan_id'=>$ilanId));
            $return['hata'] = false;
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
                $fileRes = new File($res['IlanResim']['path8']);
                $fileRes->delete();
                $fileRes = new File($res['IlanResim']['paththumb']);
                $fileRes->delete();

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

    public function yenidanisman(){}

    public function danismankaydet(){
        $this->autoLayout = false;
        $this->autoRender = false;
        $return = array('hata'=>true,'mesaj'=>'Bir hata meydana geldi. Lütfen tekrar deneyin.','resim'=>false, 'danismanId'=>false);
        if($this->request->is('post')){
            $data = $this->request->data;
            $files = $this->request->param('form');

            if(array_key_exists('danismanId',$data) && $data['danismanId'] != 0){
                $pata = $this->Danisman->findById($data['danismanId']);
                if($pata){
                    $saved = array('isim'=>$data['isim'],'hakkinda'=>$data['hakkinda'],'islem_tarihi'=>date('Y-m-d H:i:s'));
                    $this->Danisman->id = $data['danismanId'];
                    if($this->Danisman->save($saved)){
                        $lastId = $data['danismanId'];
                        $return['hata'] = false;

                        // Resim Ekle
                        if(array_key_exists('danismanresim',$files)){
                            // Eski resmi Sil
                            if(!empty($pata['Danisman']['resim'])){
                                $fileRes = new File($pata['Danisman']['resim']);
                                $fileRes->delete();
                            }
                            // Eski resmi Sil Son
                            $fileType = pathinfo($files['danismanresim']['name'], PATHINFO_EXTENSION);
                            $resName = time().rand(1,1000).'.'.$fileType;
                            $path = 'img/danisman/'.$lastId.'/'.$resName;
                            //image Resize
                            $manipulator = new ImageManipulator($files['danismanresim']['tmp_name']);
                            if($manipulator->getWidth() > 200){
                                $manipulator->resample(200, 200);
                            }

                            if($manipulator->save($path)){
                                $this->Danisman->id = $lastId;
                                $this->Danisman->save(array('resim'=>$path));
                            }
                        }
                        // Resim Ekle Son

                        // Iletisim Kaydet
                        $this->DanismanIletisim->deleteAll(array('danisman_id'=>$lastId),true);
                        foreach($data['iletisimturu'] as $key=>$val){
                            if(!empty($data['Iletisim'][$key])){
                                $saved = array('danisman_id'=>$lastId, 'Iletisim' =>$data['Iletisim'][$key], 'turu'=>$val, 'islem_tarihi'=>date('Y-m-d H:i:s'));
                                $this->DanismanIletisim->create();
                                $this->DanismanIletisim->save($saved);
                            }
                        }
                        // Iletisim Kaydet Son

                        $danisman = $this->Danisman->findById($lastId);
                        $return['resim'] = !empty($danisman['Danisman']['resim'])?(Router::url('/', true).$danisman['Danisman']['resim']):false;
                        $return['danismanId'] = $lastId;
                    }
                }
            }else{
                $saved = array('isim'=>$data['isim'],'hakkinda'=>$data['hakkinda'],'islem_tarihi'=>date('Y-m-d H:i:s'));
                $this->Danisman->create();
                if($this->Danisman->save($saved)){
                    $lastId = $this->Danisman->getLastInsertID();
                    $return['hata'] = false;

                    // Resim Ekle
                    if(array_key_exists('danismanresim',$files)){
                        $fileType = pathinfo($files['danismanresim']['name'], PATHINFO_EXTENSION);
                        $resName = time().rand(1,1000).'.'.$fileType;
                        $path = 'img/danisman/'.$lastId.'/'.$resName;
                        //image Resize
                        $manipulator = new ImageManipulator($files['danismanresim']['tmp_name']);
                        if($manipulator->getWidth() > 200){
                            $manipulator->resample(200, 200);
                        }

                        if($manipulator->save($path)){
                            $this->Danisman->id = $lastId;
                            $this->Danisman->save(array('resim'=>$path));
                        }
                    }
                    // Resim Ekle Son

                    // Iletisim Kaydet
                    foreach($data['iletisimturu'] as $key=>$val){
                        if(!empty($data['Iletisim'][$key])){
                            $saved = array('danisman_id'=>$lastId, 'Iletisim' =>$data['Iletisim'][$key], 'turu'=>$val, 'islem_tarihi'=>date('Y-m-d H:i:s'));
                            $this->DanismanIletisim->create();
                            $this->DanismanIletisim->save($saved);
                        }
                    }
                    // Iletisim Kaydet Son

                    $danisman = $this->Danisman->findById($lastId);
                    $return['resim'] = !empty($danisman['Danisman']['resim'])?(Router::url('/', true).$danisman['Danisman']['resim']):false;
                    $return['danismanId'] = $lastId;
                }
            }
        }

        echo json_encode($return);
        exit();
    }

    public function danismanedit(){
        $named = $this->request->params["named"];
        $danisman = $this->Danisman->findById($named['danisman']);
        if(!$danisman){
            $this->redirect(array('controller'=>'yoneticis'));
        }

        $this->set('danisman',$danisman);
    }

    public function danismanlar(){
        $danismanlar = $this->Danisman->find('all',array('order'=>array('isim'=>'ASC')));
        $this->set('danismanlar',$danismanlar);
    }

    public function danismanilan(){
        $named = $this->request->params["named"];
        $danisman = $this->Danisman->findById($named['danisman']);
        if(!$danisman){
            $this->redirect(array('controller'=>'yoneticis'));
        }

        foreach ($danisman['Ilan'] as $key=>$row) {
            $pp = $this->IlanResim->find('first',array('conditions'=>array('ilan_id'=>$row['id']),'order'=>array('sira'=>'ASC')));
            $danisman['Ilan'][$key]['path'] = false;
            $danisman['Ilan'][$key]['paththumb'] = false;
            if(!empty($pp)){
                $danisman['Ilan'][$key]['path'] = $pp['IlanResim']['path'];
                $danisman['Ilan'][$key]['paththumb'] = $pp['IlanResim']['paththumb'];
            }
        }
        $this->set('danisman',$danisman);
    }

	public function test(){
        $this->IlanResim->create();
        exit();
    }

    public function ilanresimsirala(){
	    $this->autoRender = false;
	    if($this->request->is('post')){
	        $resimler = $this->request->data('resimler');
	        $sira = 1;
            foreach($resimler as $row){
                $this->IlanResim->id = $row['resim-id'];
                $this->IlanResim->save(array('sira'=>$sira));
                $sira++;
            }
        }
        echo json_encode(false);
	    exit();
    }

    public function resimsil(){
        $this->autoRender = false;
        $return = array('hata'=>true);
        if($this->request->is('post')){
            $resId = $this->request->data('resId');
            $resim = $this->IlanResim->findById($resId);
            if($resim){
                $fileRes = new File($resim['IlanResim']['path']);
                $fileRes->delete();
                $fileRes = new File($resim['IlanResim']['path8']);
                $fileRes->delete();
                $fileResThumb = new File($resim['IlanResim']['paththumb']);
                $fileResThumb->delete();

                if($this->IlanResim->delete(array('id'=>$resId),false)){
                    $return['hata'] = false;
                    $return['resId'] = $resId;
                }
            }
        }
        echo json_encode($return);
    }

    public function giris(){
        if($this->Session->check('userCheck')){
            return $this->redirect(
                array('controller' => 'yoneticis', 'action' => 'index')
            );
        }else{
            $this->layout = 'giris';
        }
    }

    public function login(){
        $this->autoRender = false;
        if($this->request->is('post')){
            $username = $this->request->data('username');
            $pass = Security::hash($this->request->data('pass'),'sha1',true);

            $user = $this->User->findByUsernameAndPassAndAktif($username, $pass, 1);
            if($user){
                $this->Session->write('user',$user['User']['username']);
                $this->Session->write('userCheck',1);
                return $this->redirect(
                    array('controller' => 'yoneticis', 'action' => 'index')
                );
            }else{
                return $this->redirect(array('controller'=>'yoneticis','action'=>'giris'));
            }
        }else{
            return $this->redirect(array('controller'=>'yoneticis','action'=>'giris'));
        }
    }

    public function cikis(){
        $this->Session->destroy();
        return $this->redirect(
            array('controller' => 'sayfas', 'action' => 'index')
        );
    }

    public function yenihaber(){}

    public function haberkaydet(){
        $this->autoRender = false;
        $return['hata'] = true;
        if($this->request->is('post')){
            $data = $this->request->data;
            $yayinda = array_key_exists('yayinda',$data)?1:0;
            $saved = array('baslik'=>$data['baslik'],'icerik'=>$data['icerik'],'yayinda'=>$yayinda,'islem_tarihi'=>date('Y-m-d H:i:s'));

            if(array_key_exists('haberId',$data) && $data['haberId'] != 0){
                $pata = $this->Haber->findById($data['haberId']);
                if($pata){
                    $this->Haber->id = $data['haberId'];
                    if($this->Haber->save($saved)){
                        $lastId = $data['haberId'];
                        $return['hata'] = false;
                        $return['HaberId'] = $lastId;

                        // Haber Resim Kaydet
                        $yuklenenfile = array_key_exists('yuklenenfile',$data)?$data['yuklenenfile']:false;
                        $sira = $this->HaberResim->find('count',array('conditions'=>array('haber_id'=>$lastId)));
                        foreach($yuklenenfile as $value){
                            $sira++;
                            $asilpath = WWW_ROOT.'img/gecici/'.$value;
                            if(!is_file($asilpath)){
                                continue;
                            }

                            if(file_exists($asilpath)){
                                $fileType = pathinfo($value, PATHINFO_EXTENSION);
                                $resName = time().rand(1,1000).'.'.$fileType;
                                $path = 'img/haber/'.$lastId.'/'.$resName;
                                $pathThumb = 'img/haber/'.$lastId.'/thumb'.$resName;

                                //image Resize
                                $manipulator = new ImageManipulator($asilpath);
                                $manipulator->resample(1024, 1024);
                                if($manipulator->save($path)){
                                    $manipulator = new ImageManipulator($path);
                                    $manipulator->resample(200, 200);
                                    $manipulator->save($pathThumb);
                                    $this->HaberResim->create();
                                    $this->HaberResim->save(array('haber_id'=>$lastId,'res'=>$value,'path'=>$path,'paththumb'=>$pathThumb, 'sira'=>$sira, 'islem_tarihi'=>date('Y-m-d H:i:s')));
                                    if(file_exists($asilpath)){
                                        unlink($asilpath);
                                    }
                                }
                            }
                        }
                    }
                }
            }else{
                $this->Haber->create();
                if($this->Haber->save($saved)){
                    $lastId = $this->Haber->getLastInsertID();
                    $return['hata'] = false;
                    $return['HaberId'] = $lastId;

                    // Haber Resim Kaydet
                    $yuklenenfile = array_key_exists('yuklenenfile',$data)?$data['yuklenenfile']:false;
                    $sira = $this->HaberResim->find('count',array('conditions'=>array('haber_id'=>$lastId)));
                    foreach($yuklenenfile as $value){
                        $sira++;
                        $asilpath = WWW_ROOT.'img/gecici/'.$value;
                        if(!is_file($asilpath)){
                            continue;
                        }

                        if(file_exists($asilpath)){
                            $fileType = pathinfo($value, PATHINFO_EXTENSION);
                            $resName = time().rand(1,1000).'.'.$fileType;
                            $path = 'img/haber/'.$lastId.'/'.$resName;
                            $pathThumb = 'img/haber/'.$lastId.'/thumb'.$resName;

                            //image Resize
                            $manipulator = new ImageManipulator($asilpath);
                            $manipulator->resample(1024, 1024);
                            if($manipulator->save($path)){
                                $manipulator = new ImageManipulator($path);
                                $manipulator->resample(200, 200);
                                $manipulator->save($pathThumb);
                                $this->HaberResim->create();
                                $this->HaberResim->save(array('haber_id'=>$lastId,'res'=>$value,'path'=>$path,'paththumb'=>$pathThumb, 'sira'=>$sira, 'islem_tarihi'=>date('Y-m-d H:i:s')));
                                if(file_exists($asilpath)){
                                    unlink($asilpath);
                                }
                            }
                        }
                    }
                }
            }
        }

        echo json_encode($return);
        exit();
    }

    public function haberedit(){
        $named = $this->request->params["named"];
        $haber = $this->Haber->findById($named['hId']);
        if(!$haber){
            $this->redirect(array('controller'=>'yoneticis'));
        }

        $this->set('haber',$haber);
    }

    public function habersil(){
        $this->autoRender = false;
        $return['hata'] = true;
        if($this->request->is('post')){
            $hId = $this->request->data('hId');
            if($this->Haber->deleteAll(array('id'=>$hId))){
                $resimler = $this->HaberResim->findByHaberId($hId);
                foreach ($resimler as $row){
                    $fileRes = new File($row['HaberResim']['path']);
                    $fileRes->delete();
                    $fileResThumb = new File($row['HaberResim']['paththumb']);
                    $fileResThumb->delete();
                    $this->HaberResim->delete(array('id'=>$row['HaberResim']['id']),false);
                }
                $return['hata'] = false;
            }
        }
        echo json_encode($return);
        exit();
    }

    public function haberler(){
        $data = $this->Haber->find('all',array('order'=>array('islem_tarihi'=>'DESC')));
        $this->set('haberler',$data);
    }

    public function haberresimsirala(){
        $this->autoRender = false;
        if($this->request->is('post')){
            $resimler = $this->request->data('resimler');
            $sira = 1;
            foreach($resimler as $row){
                $this->HaberResim->id = $row['resim-id'];
                $this->HaberResim->save(array('sira'=>$sira));
                $sira++;
            }
        }
        echo json_encode(false);
        exit();
    }

    public function haberresimsil(){
        $this->autoRender = false;
        $return = array('hata'=>true);
        if($this->request->is('post')){
            $resId = $this->request->data('resId');
            $resim = $this->HaberResim->findById($resId);
            if($resim){
                $fileRes = new File($resim['HaberResim']['path']);
                $fileRes->delete();
                $fileResThumb = new File($resim['HaberResim']['paththumb']);
                $fileResThumb->delete();

                if($this->HaberResim->delete(array('id'=>$resId),false)){
                    $return['hata'] = false;
                    $return['resId'] = $resId;
                }
            }
        }
        echo json_encode($return);
    }

    public function yeniproje(){}

    public function projekaydet(){
        $this->autoRender = false;
        $return['hata'] = true;
        if($this->request->is('post')){
            $data = $this->request->data;
            $yayinda = array_key_exists('yayinda',$data)?1:0;
            $saved = array('baslik'=>$data['baslik'],'icerik'=>$data['icerik'],'yayinda'=>$yayinda,'islem_tarihi'=>date('Y-m-d H:i:s'));

            if(array_key_exists('projeId',$data) && $data['projeId'] != 0){
                $pata = $this->Proje->findById($data['projeId']);
                if($pata){
                    $this->Proje->id = $data['projeId'];
                    if($this->Proje->save($saved)){
                        $lastId = $data['projeId'];
                        $return['hata'] = false;
                        $return['ProjeId'] = $lastId;

                        // Proje Resim Kaydet
                        $yuklenenfile = array_key_exists('yuklenenfile',$data)?$data['yuklenenfile']:false;
                        $sira = $this->ProjeResim->find('count',array('conditions'=>array('proje_id'=>$lastId)));
                        foreach($yuklenenfile as $value){
                            $sira++;
                            $asilpath = WWW_ROOT.'img/gecici/'.$value;
                            if(!is_file($asilpath)){
                                continue;
                            }

                            if(file_exists($asilpath)){
                                $fileType = pathinfo($value, PATHINFO_EXTENSION);
                                $resName = time().rand(1,1000).'.'.$fileType;
                                $path = 'img/proje/'.$lastId.'/'.$resName;
                                $pathThumb = 'img/proje/'.$lastId.'/thumb'.$resName;

                                //image Resize
                                $manipulator = new ImageManipulator($asilpath);
                                $manipulator->resample(1024, 1024);
                                if($manipulator->save($path)){
                                    $manipulator = new ImageManipulator($path);
                                    $manipulator->resample(200, 200);
                                    $manipulator->save($pathThumb);
                                    $this->ProjeResim->create();
                                    $this->ProjeResim->save(array('proje_id'=>$lastId,'res'=>$value,'path'=>$path,'paththumb'=>$pathThumb, 'sira'=>$sira, 'islem_tarihi'=>date('Y-m-d H:i:s')));
                                    if(file_exists($asilpath)){
                                        unlink($asilpath);
                                    }
                                }
                            }
                        }
                    }
                }
            }else{
                $this->Proje->create();
                if($this->Proje->save($saved)){
                    $lastId = $this->Proje->getLastInsertID();
                    $return['hata'] = false;
                    $return['ProjeId'] = $lastId;

                    // Proje Resim Kaydet
                    $yuklenenfile = array_key_exists('yuklenenfile',$data)?$data['yuklenenfile']:false;
                    $sira = $this->ProjeResim->find('count',array('conditions'=>array('proje_id'=>$lastId)));
                    foreach($yuklenenfile as $value){
                        $sira++;
                        $asilpath = WWW_ROOT.'img/gecici/'.$value;
                        if(!is_file($asilpath)){
                            continue;
                        }

                        if(file_exists($asilpath)){
                            $fileType = pathinfo($value, PATHINFO_EXTENSION);
                            $resName = time().rand(1,1000).'.'.$fileType;
                            $path = 'img/proje/'.$lastId.'/'.$resName;
                            $pathThumb = 'img/proje/'.$lastId.'/thumb'.$resName;

                            //image Resize
                            $manipulator = new ImageManipulator($asilpath);
                            $manipulator->resample(1024, 1024);
                            if($manipulator->save($path)){
                                $manipulator = new ImageManipulator($path);
                                $manipulator->resample(200, 200);
                                $manipulator->save($pathThumb);
                                $this->ProjeResim->create();
                                $this->ProjeResim->save(array('proje_id'=>$lastId,'res'=>$value,'path'=>$path,'paththumb'=>$pathThumb, 'sira'=>$sira, 'islem_tarihi'=>date('Y-m-d H:i:s')));
                                if(file_exists($asilpath)){
                                    unlink($asilpath);
                                }
                            }
                        }
                    }
                }
            }
        }

        echo json_encode($return);
        exit();
    }

    public function projeedit(){
        $named = $this->request->params["named"];
        $proje = $this->Proje->findById($named['pId']);
        if(!$proje){
            $this->redirect(array('controller'=>'yoneticis'));
        }

        $this->set('proje',$proje);
    }

    public function projesil(){
        $this->autoRender = false;
        $return['hata'] = true;
        if($this->request->is('post')){
            $pId = $this->request->data('pId');
            if($this->Proje->deleteAll(array('id'=>$pId))){
                $resimler = $this->ProjeResim->findByProjeId($pId);
                foreach ($resimler as $row){
                    $fileRes = new File($row['ProjeResim']['path']);
                    $fileRes->delete();
                    $fileResThumb = new File($row['ProjeResim']['paththumb']);
                    $fileResThumb->delete();
                    $this->ProjeResim->delete(array('id'=>$row['ProjeResim']['id']),false);
                }
                $return['hata'] = false;
            }
        }
        echo json_encode($return);
        exit();
    }

    public function projeler(){
        $data = $this->Proje->find('all',array('order'=>array('islem_tarihi'=>'DESC')));
        $this->set('projeler',$data);
    }

    public function projeresimsirala(){
        $this->autoRender = false;
        if($this->request->is('post')){
            $resimler = $this->request->data('resimler');
            $sira = 1;
            foreach($resimler as $row){
                $this->ProjeResim->id = $row['resim-id'];
                $this->ProjeResim->save(array('sira'=>$sira));
                $sira++;
            }
        }
        echo json_encode(false);
        exit();
    }

    public function projeresimsil(){
        $this->autoRender = false;
        $return = array('hata'=>true);
        if($this->request->is('post')){
            $resId = $this->request->data('resId');
            $resim = $this->ProjeResim->findById($resId);
            if($resim){
                $fileRes = new File($resim['ProjeResim']['path']);
                $fileRes->delete();
                $fileResThumb = new File($resim['ProjeResim']['paththumb']);
                $fileResThumb->delete();

                if($this->ProjeResim->delete(array('id'=>$resId),false)){
                    $return['hata'] = false;
                    $return['resId'] = $resId;
                }
            }
        }
        echo json_encode($return);
    }

    public function yeni_teknik_analiz(){}

    public function teknikanalizkaydet(){
        $this->autoRender = false;
        $return['hata'] = true;
        if($this->request->is('post')){
            $data = $this->request->data;
            $yayinda = array_key_exists('yayinda',$data)?1:0;
            $saved = array('baslik'=>$data['baslik'],'icerik'=>$data['icerik'],'yayinda'=>$yayinda,'islem_tarihi'=>date('Y-m-d H:i:s'));

            if(array_key_exists('taId',$data) && $data['taId'] != 0){
                $pata = $this->TeknikAnaliz->findById($data['taId']);
                if($pata){
                    $this->TeknikAnaliz->id = $data['taId'];
                    if($this->TeknikAnaliz->save($saved)){
                        $lastId = $data['taId'];
                        $return['hata'] = false;
                        $return['taId'] = $lastId;

                        // Teknik Analiz Resim Kaydet
                        $yuklenenfile = array_key_exists('yuklenenfile',$data)?$data['yuklenenfile']:false;
                        $sira = $this->TeknikAnalizResim->find('count',array('conditions'=>array('teknik_analiz_id'=>$lastId)));
                        foreach($yuklenenfile as $value){
                            $sira++;
                            $asilpath = WWW_ROOT.'img/gecici/'.$value;
                            if(!is_file($asilpath)){
                                continue;
                            }

                            if(file_exists($asilpath)){
                                $fileType = pathinfo($value, PATHINFO_EXTENSION);
                                $resName = time().rand(1,1000).'.'.$fileType;
                                $path = 'img/teknik_analiz/'.$lastId.'/'.$resName;
                                $pathThumb = 'img/teknik_analiz/'.$lastId.'/thumb'.$resName;

                                //image Resize
                                $manipulator = new ImageManipulator($asilpath);
                                $manipulator->resample(1024, 1024);
                                if($manipulator->save($path)){
                                    $manipulator = new ImageManipulator($path);
                                    $manipulator->resample(200, 200);
                                    $manipulator->save($pathThumb);
                                    $this->TeknikAnalizResim->create();
                                    $this->TeknikAnalizResim->save(array('teknik_analiz_id'=>$lastId,'res'=>$value,'path'=>$path,'paththumb'=>$pathThumb, 'sira'=>$sira, 'islem_tarihi'=>date('Y-m-d H:i:s')));
                                    if(file_exists($asilpath)){
                                        unlink($asilpath);
                                    }
                                }
                            }
                        }
                    }
                }
            }else{
                $this->TeknikAnaliz->create();
                if($this->TeknikAnaliz->save($saved)){
                    $lastId = $this->TeknikAnaliz->getLastInsertID();
                    $return['hata'] = false;
                    $return['taId'] = $lastId;

                    // Teknik Analiz Resim Kaydet
                    $yuklenenfile = array_key_exists('yuklenenfile',$data)?$data['yuklenenfile']:false;
                    $sira = $this->TeknikAnalizResim->find('count',array('conditions'=>array('teknik_analiz_id'=>$lastId)));
                    foreach($yuklenenfile as $value){
                        $sira++;
                        $asilpath = WWW_ROOT.'img/gecici/'.$value;
                        if(!is_file($asilpath)){
                            continue;
                        }

                        if(file_exists($asilpath)){
                            $fileType = pathinfo($value, PATHINFO_EXTENSION);
                            $resName = time().rand(1,1000).'.'.$fileType;
                            $path = 'img/teknik_analiz/'.$lastId.'/'.$resName;
                            $pathThumb = 'img/teknik_analiz/'.$lastId.'/thumb'.$resName;

                            //image Resize
                            $manipulator = new ImageManipulator($asilpath);
                            $manipulator->resample(1024, 1024);
                            if($manipulator->save($path)){
                                $manipulator = new ImageManipulator($path);
                                $manipulator->resample(200, 200);
                                $manipulator->save($pathThumb);
                                $this->TeknikAnalizResim->create();
                                $this->TeknikAnalizResim->save(array('teknik_analiz_id'=>$lastId,'res'=>$value,'path'=>$path,'paththumb'=>$pathThumb, 'sira'=>$sira, 'islem_tarihi'=>date('Y-m-d H:i:s')));
                                if(file_exists($asilpath)){
                                    unlink($asilpath);
                                }
                            }
                        }
                    }
                }
            }
        }

        echo json_encode($return);
        exit();
    }

    public function teknikanalizedit(){
        $named = $this->request->params["named"];
        $teknik_analiz = $this->TeknikAnaliz->findById($named['taId']);
        if(!$teknik_analiz){
            $this->redirect(array('controller'=>'yoneticis'));
        }

        $this->set('teknik_analiz',$teknik_analiz);
    }

    public function teknikanalizsil(){
        $this->autoRender = false;
        $return['hata'] = true;
        if($this->request->is('post')){
            $taId = $this->request->data('taId');
            if($this->TeknikAnaliz->deleteAll(array('id'=>$taId))){
                $resimler = $this->TeknikAnalizResim->findByTeknikAnalizId($taId);
                foreach ($resimler as $row){
                    $fileRes = new File($row['TeknikAnalizResim']['path']);
                    $fileRes->delete();
                    $fileResThumb = new File($row['TeknikAnalizResim']['paththumb']);
                    $fileResThumb->delete();
                    $this->TeknikAnalizResim->delete(array('id'=>$row['TeknikAnalizResim']['id']),false);
                }
                $return['hata'] = false;
            }
        }
        echo json_encode($return);
        exit();
    }

    public function teknik_analizler(){
        $data = $this->TeknikAnaliz->find('all',array('order'=>array('islem_tarihi'=>'DESC')));
        $this->set('teknik_analizler',$data);
    }

    public function teknikanalizresimsirala(){
        $this->autoRender = false;
        if($this->request->is('post')){
            $resimler = $this->request->data('resimler');
            $sira = 1;
            foreach($resimler as $row){
                $this->TeknikAnalizResim->id = $row['resim-id'];
                $this->TeknikAnalizResim->save(array('sira'=>$sira));
                $sira++;
            }
        }
        echo json_encode(false);
        exit();
    }
}
