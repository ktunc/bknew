<div class="container-fluid bg-white">
    <div class="row">
        <?php
        foreach($teknik_analizler as $row){
            echo '<div class="col-xs-12 col-sm-3">';
            echo '<a class="thumbnail" href="'.$this->Html->url('/').'sayfas/teknik_analiz/taId:'.$row['TeknikAnaliz']['id'].'">';
            if(!empty($row['TeknikAnalizResim'])){
                echo '<img src="'.$this->webroot.$row['TeknikAnalizResim'][0]['paththumb'].'" width="100%"/>';
            }else{
                echo '<img src="'.$this->Html->url('/').'img/logo-xxs.png" width="100%"/>';
            }
            echo '<p class="IlanHeader2">'.$row['TeknikAnaliz']['baslik'].'</p>';
            echo '<p class="IlanAdres3">'.$row['TeknikAnaliz']['islem_tarihi'].'</p>';
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


