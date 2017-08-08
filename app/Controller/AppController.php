<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('String', 'Utility');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');
App::uses('PhpReader', 'Configure');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 * @property AuthComponent $Auth
 * @property AclComponent $Acl
 * @property CookieComponent $Cookie
 * @property EmailComponent $Email
 * @property RequestHandlerComponent $RequestHandler
 * @property SecurityComponent $Security
 * @property SessionComponent $Session
 */
class AppController extends Controller {
    public $components = array('Cookie','Session','Paginator','Flash');
    public $helpers = array('Html','Form','Js','JqueryEngine','GoogleMap');

    public function beforeFilter(){
        parent::beforeFilter();

        $controller = $this->request->controller;
        $action = $this->request->action;

        $ismobile = $this->isMobile();
        if($ismobile){
            $this->Session->write('Mobile','1');
        }

        if(!$this->Session->check('UserLogin')){

            switch ($controller) {



                default:
                    break;
            }
        }
    }

    public function isMobile(){
        return (bool)preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

    // İlk Karakterleri Büyültme
    function ucwords_tr($gelen){

        $sonuc='';
        $kelimeler=explode(" ", $gelen);

        foreach ($kelimeler as $kelime_duz){

            $kelime_uzunluk=strlen($kelime_duz);
            $ilk_karakter=mb_substr($kelime_duz,0,1,'UTF-8');

            if($ilk_karakter=='Ç' or $ilk_karakter=='ç'){
                $ilk_karakter='Ç';
            }elseif ($ilk_karakter=='Ğ' or $ilk_karakter=='ğ') {
                $ilk_karakter='Ğ';
            }elseif($ilk_karakter=='I' or $ilk_karakter=='ı'){
                $ilk_karakter='I';
            }elseif ($ilk_karakter=='İ' or $ilk_karakter=='i'){
                $ilk_karakter='İ';
            }elseif ($ilk_karakter=='Ö' or $ilk_karakter=='ö'){
                $ilk_karakter='Ö';
            }elseif ($ilk_karakter=='Ş' or $ilk_karakter=='ş'){
                $ilk_karakter='Ş';
            }elseif ($ilk_karakter=='Ü' or $ilk_karakter=='ü'){
                $ilk_karakter='Ü';
            }else{
                $ilk_karakter=strtoupper($ilk_karakter);
            }

            $digerleri=mb_substr($kelime_duz,1,$kelime_uzunluk,'UTF-8');
            $sonuc.=$ilk_karakter.kucuk_yap($digerleri).' ';

        }

        $son=trim(str_replace('  ', ' ', $sonuc));
        return $son;

    }

    function kucuk_yap($gelen){

        $gelen=str_replace('Ç', 'ç', $gelen);
        $gelen=str_replace('Ğ', 'ğ', $gelen);
        $gelen=str_replace('I', 'ı', $gelen);
        $gelen=str_replace('İ', 'i', $gelen);
        $gelen=str_replace('Ö', 'ö', $gelen);
        $gelen=str_replace('Ş', 'ş', $gelen);
        $gelen=str_replace('Ü', 'ü', $gelen);
        $gelen=strtolower($gelen);

        return $gelen;
    }
}
