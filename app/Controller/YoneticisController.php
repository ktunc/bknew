<?php
App::uses('AppController', 'Controller');
/**
 * Yoneticis Controller
 */
class YoneticisController extends AppController {

    var $layout = 'yonetici';
/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public function index(){}

	public function yeniilan(){
	    $ilanHeader = array(1=>'Yeni Konut İlanı', 2=>'Yeni İşyeri İlanı', 3=>'Yeni Arsa İlanı');
	    $named=$this->request->param('named');
	    $tur = array_key_exists('tur',$named)?$named['tur']:1;
	    if(!array_key_exists($tur,$ilanHeader)){
	        $this->redirect(array('controller'=>'yoneticis','action'=>'yeniilan','tur'=>1));
        }
	    $this->set('tur',$tur);
	    $this->set('ilanHeader',$ilanHeader[$tur]);
    }

	public function ilanlar(){}

	public function test(){
	    pr($this->request->data['aciklama']);
	    pr($_FILES);
	    exit();
    }

}
