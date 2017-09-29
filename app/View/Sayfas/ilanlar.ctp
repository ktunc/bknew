<?php
$pagg = $this->passedArgs;
$this->Paginator->options(array('url' => $pagg));
?>
<div class="container-fluid bg-white">
    <div class="row">
        <?php
        foreach($ilanlar as $row){
            echo '<div class="col-xs-12 col-sm-3">';
            echo '<a class="thumbnail" href="'.$this->Html->url('/').'ilan/ilan:'.$row['Ilan']['id'].'">';
            if(!empty($row['IlanResim'])){
                echo '<img src="'.$this->webroot.$row['IlanResim'][0]['paththumb'].'" width="100%"/>';
                echo '<p class="IlanHeader2">'.$row['Ilan']['baslik'].'</p>';
            }else{
                echo '<img src="'.$this->Html->url('/').'img/logo-xxs.png" width="100%"/>';
                echo '<p class="IlanHeader2">'.$row['Ilan']['baslik'].'</p>';
            }
            echo '<p class="IlanAdres3">'.(!empty($row['Mahalle']['id'])?$row['Mahalle']['mahalle_adi'].' / ':'').(!empty($row['Semt']['id'])?$row['Semt']['semt_adi'].' / ':'').(!empty($row['Ilce']['id'])?$row['Ilce']['ilce_adi'].' / ':'').(!empty($row['Sehir']['id'])?$row['Sehir']['sehir_adi']:'').'</p>';
            $ilanturu = $satkir = "";
            if($row['Ilan']['satkir'] == 1){
                $satkir = "Satılık";
            }else{
                $satkir = "Kiralık";
            }

            if($row['Ilan']['turu'] == 1){
                $ilanturu = "Konut";
            }else if($row['Ilan']['turu'] == 2){
                $ilanturu = "İş Yeri";
            }else{
                $ilanturu = "Arsa";
            }
            echo '<p class="IlanAdres2">'.$satkir.' '.$ilanturu.'</p>';
            echo '</a>';
            echo '</div>';
        }
        ?>
    </div>

<?php
echo '<ul class="pagination" style="display:table; margin:0 auto;">';

echo $this->Paginator->prev( '<<', array( 'class' => '', 'tag' => 'li','escape' => false), null, array( 'class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a','escape' => false) );
echo $this->Paginator->numbers( array( 'tag' => 'li', 'separator' => '', 'currentClass' => 'active', 'currentTag'=>'a' ) );
echo $this->Paginator->next( '>>', array( 'class' => '', 'tag' => 'li','escape' => false ), null, array( 'class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a','escape' => false) );

echo '</ul>';
?>
</div>


